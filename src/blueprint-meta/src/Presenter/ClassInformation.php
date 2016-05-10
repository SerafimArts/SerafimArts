<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 2:59
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Presenter;

use Serafim\Blueprint\Mapping\Blueprint;
use Serafim\Blueprint\Metadata;
use Serafim\Properties\Getters;

/**
 * Class ClassInformation
 * @package Serafim\Blueprint\Presenter
 * @property-read Blueprint $info
 * @property-read int $fields
 * @property-read \Traversable|string[] $titles
 */
class ClassInformation
{
    use Getters;
    
    /**
     * @var Metadata
     */
    private $meta;

    /**
     * ClassInformation constructor.
     * @param Metadata $meta
     */
    public function __construct(Metadata $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return int
     */
    public function getFields()
    {
        return count($this->meta->properties);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->meta->class->title;
    }

    /**
     * @return Blueprint
     */
    public function getInfo()
    {
        return $this->meta->class;
    }

    /**
     * @return \Generator
     */
    public function getTitles()
    {
        foreach ($this->meta->properties as $property) {
            yield $property->title;
        }
    }
}