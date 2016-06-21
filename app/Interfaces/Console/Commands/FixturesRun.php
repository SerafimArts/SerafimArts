<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Console\Commands;

use Common\Fixtures\Persister;
use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Nelmio\Alice\Fixtures;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FixturesRun
 * @package Interfaces\Console\Commands
 */
class FixturesRun extends Command
{
    /**
     * @var string
     */
    protected $signature = 'db:fixtures';

    /**
     * @var string
     */
    protected $description = 'Run database fixtures';

    /**
     * @param Repository $config
     * @throws \InvalidArgumentException
     */
    public function handle(Repository $config)
    {
        $paths = $config->get('database.fixtures.paths');

        $files = iterator_to_array($this->find($paths));

        $fixtures = new Fixtures(app(Persister::class), [
            'providers' => array_map(function (string $class) {
                return app($class);
            }, $config->get('database.fixtures.extensions')),
        ]);

        $fixtures->loadFiles($files);
    }

    /**
     * @param array $paths
     * @return \Generator
     * @throws \InvalidArgumentException
     */
    private function find(array $paths = [])
    {
        $finder = (new Finder())
            ->files()
            ->in($paths)
            ->sort(function (SplFileInfo $a, SplFileInfo $b) {
                return substr($a->getFilename(), 0, 1) <=> substr($b->getFilename(), 0, 1);
            })
            ->name('*.yml')
        ;

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            yield $file->getRealPath();
        }
    }
}