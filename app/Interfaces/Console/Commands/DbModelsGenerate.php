<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class DbModelsGenerate
 * @package Interfaces\Console\Commands
 */
class DbModelsGenerate extends Command
{
    /**
     * @var string
     */
    protected $signature = 'db:generate:models';

    /**
     * @var string
     */
    protected $description = 'Generate base models';


    /**
     * @return void
     */
    public function handle(Repository $config)
    {
        $output     = $config->get('database.generator.model.output');

        if (!@mkdir($output, 0777, true) && !is_dir($output)) {
            throw new \InvalidArgumentException('Can not create output directory');
        }

        $namespace  = $config->get('database.generator.model.namespace');
        $prefix     = $config->get('database.generator.model.prefix');

        foreach ($this->getFiles($config->get('database.generator.schema.output')) as $node) {
            $className = $prefix . $this->attribute($node, '@model');
            $path      = $output . '/' . $className . '.php';


            $doc = [
                '=============================================',
                '  This is generated class. Do not touch it.',
                '=============================================',
                '',
                'For the full copyright and license information, please view the LICENSE',
                'file that was distributed with this source code.',
                '',
            ];

            $integerId = true;

            $timestamps = [];
            
            /** @var \SimpleXMLElement $child */
            foreach ($node->xpath('column') as $child) {
                list($name, $type) = [(string)$child, $this->attribute($child, '@type')];


                if (strtolower($name) === 'id') {
                    $integerId = ($type === 'int');
                }

                if (in_array($type, [
                    'timestamp', 'time', 'date',
                    '\DateTime', 'DateTime',
                    '\DateTimeImmutable', '\DateTimeImmutable',
                    '\Carbon\Carbon', 'Carbon\Carbon', 'Carbon'
                ], true)) {
                    $timestamps[] = $name;
                    $type = 'Carbon';
                }


                $doc[] = '@property ' . $type . ' $' . $name;
            }
            
            $doc[] = '';

            $code = new PhpNamespace($namespace);
            $code->addUse(Model::class);

            $class = $code->addClass($className);
            $class->setExtends(Model::class);
            $class->setAbstract(true);
            $class
                ->addProperty('table', $this->attribute($node, '@table'))
                ->addComment("Model table name\n" . '@var string')
                ->setVisibility('protected');

            if (!$integerId) {
                $class
                    ->addProperty('incrementing', false)
                    ->addComment("Disable auto increment primary key\n" . '@var bool');
            }


            $class->addProperty('timestamps', $timestamps === [] ? false : $timestamps)
                ->addComment("Additional timestamps\n" . '@var array|bool');
            if ($timestamps) {
                $code->addUse(Carbon::class);
            }

            /** @var \SimpleXMLElement $relation */
            foreach ((current($node->xpath('relations')) ?: []) as $relation) {
                $relationTypeName = Str::studly($relation->getName());
                $isMany = !in_array($relationTypeName, ['HasOne', 'BelongsTo', 'MorphOne'], true);

                $relationClassPath = $this->attribute($relation, '@model');
                $relationModelName = Arr::last(explode('\\', $relationClassPath),
                    function() { return true; }
                );
                $relationMethodName = Str::camel($relationModelName) . ($isMany ? 's' : '');

                $class
                    ->addMethod($relationMethodName)
                    ->addComment('@return ' . $relationTypeName . '|Relation')
                    ->addBody(
                        'return $this->' . Str::camel($relationTypeName) . '(' .
                                   $relationModelName                      . '::class, ' .
                            '\'' . $this->attribute($relation, '@foreign') . '\', ' .
                            '\'' . $this->attribute($relation, '@local')   . '\''   .
                        ');'
                    );


                if ($isMany) {
                    $code->addUse(Collection::class);
                    $doc[] = '@property-read ' . $relationModelName . '[]|Collection $' . $relationMethodName;
                } else {
                    $doc[] = '@property-read ' . $relationModelName . ' $' . $relationMethodName;
                }

                $code
                    ->addUse($relationClassPath)
                    ->addUse(Relation::class)
                    ->addUse('Illuminate\\Database\\Eloquent\\Relations\\' . $relationTypeName);
            }


            $doc[] = '';
            $class->addComment(implode("\n", $doc));

            $sources  = '<?php' . "\n";
            $sources .= str_replace("\t", '    ', (string)$code);

            file_put_contents($path, $sources);
        }
    }

    /**
     * @param \SimpleXMLElement $node
     * @param $name
     * @return string
     */
    private function attribute(\SimpleXMLElement $node, $name)
    {
        /** @var \SimpleXMLElement $attr */
        $attr = current($node->xpath($name));
        return (string)$attr;
    }

    /**
     * @param $path
     * @return \Generator|\SimpleXMLElement[]
     * @throws \InvalidArgumentException
     */
    private function getFiles($path) : \Generator
    {
        $finder = (new Finder())
            ->files()
            ->in($path)
            ->name('*.xml');
        
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            yield $file->getRealPath() => simplexml_load_string($file->getContents());
        }
    }
}