<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article\Observers;

use Domains\Article\Category;
use Common\Generators\ColorGenerator;

/**
 * Class ColorGeneratorObserver
 * @package Domains\Article\Observers
 */
class ColorGeneratorObserver
{
    /**
     * @var ColorGenerator
     */
    private $generator;

    /**
     * ColorGeneratorObserver constructor.
     */
    public function __construct()
    {
        $this->generator = app(ColorGenerator::class);
    }

    /**
     * @param Category $category
     */
    public function creating(Category $category)
    {
        if (!$category->color) {
            $category->changeColor();
        }
    }
}