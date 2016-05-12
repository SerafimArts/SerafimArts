<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 5:04
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Presenter;

use Illuminate\View\View;
use Serafim\Blueprint\Mapping\PrimaryKey;

/**
 * Class Property
 * @package Serafim\Blueprint\Presenter
 * @property-read string $name
 * @property-read mixed $value
 */
class PrimaryKeyProperty
{
    /**
     * @var PrimaryKey
     */
    private $annotation;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Property constructor.
     * @param PrimaryKey $property
     * @param $value
     */
    public function __construct(PrimaryKey $property, $value)
    {
        $this->value        = $value;
        $this->annotation   = $property;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case 'value':
                return $this->value;
        }

        return $this->annotation->{$name};
    }
}
