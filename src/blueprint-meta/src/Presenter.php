<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 2:46
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint;

use Illuminate\Contracts\Pagination\Paginator;
use Serafim\Blueprint\Presenter\ClassInformation;
use Serafim\Blueprint\Presenter\Record;
use Serafim\Properties\Getters;

/**
 * Class Presenter
 * @package Serafim\Blueprint
 * @property-read ClassInformation $class
 * @property-read \Traversable|Record[] $items
 * @property-read Paginator $paginator
 */
class Presenter
{
    use Getters;

    /**
     * @var ClassInformation
     */
    protected $class = null;

    /**
     * @var Metadata
     */
    private $meta;

    /**
     * @var Paginator
     */
    private $items;

    /**
     * Presenter constructor.
     * @param Metadata $metadata
     * @param Paginator $items
     * @throws \LogicException
     */
    public function __construct(Metadata $metadata, Paginator $items)
    {
        $this->meta = $metadata;
        $this->items = $items;
        $this->class = new ClassInformation($this->meta);
    }

    /**
     * @return Paginator
     */
    public function getItems()
    {
        foreach ($this->items as $item) {
            yield new Record($this->meta, $item);
        }
    }

    /**
     * @return Presenter\Record[]|\Traversable
     */
    public function getPaginator()
    {
        return $this->items;
    }
}