<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 3:31
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Interfaces\Console\Commands;

use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Nelmio\Alice\Fixtures;
use Fixtures\AdditionalFunctions;
use Fixtures\Persister;
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
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        $paths = [
            base_path('database/fixtures')
        ];

        $files = iterator_to_array($this->find($paths));

        $fixtures = new Fixtures(app(Persister::class), [
            'providers' => [
                new AdditionalFunctions()
            ]
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
            ->name('*.yml');

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            yield $file->getRealPath();
        }
    }
}