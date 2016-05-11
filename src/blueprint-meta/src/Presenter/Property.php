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
use Serafim\Blueprint\Mapping\Property as PropertyAnnotation;

/**
 * Class Property
 * @package Serafim\Blueprint\Presenter
 * @property-read mixed $value
 * @property-read string $name
 * @property-read string|null $title
 * @property-read bool $read
 * @property-read bool $write
 * @property-read bool $sortable
 * @property-read int $width
 * @property-read int $readDecorator
 * @property-read int $writeDecorator
 * @method string read()
 * @method string write()
 */
class Property
{
    /**
     * @var PropertyAnnotation
     */
    private $annotation;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Blueprint object
     * @var object
     */
    private $context;

    /**
     * Property constructor.
     * @param object $context
     * @param PropertyAnnotation $property
     * @param $value
     */
    public function __construct($context, PropertyAnnotation $property, $value)
    {
        $this->value        = $value;
        $this->context      = $context;
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

    /**
     * @param View $view
     * @param string $type
     * @return View
     */
    private function extend(View $view, $type)
    {
        $value = $this->value;

        $decorator = function($method) use ($value) {
            return call_user_func([$this, $method], $value);
        };
        $decorator = $decorator->bindTo($this->context, $this->context);

        switch ($type) {
            case 'read':
                if ($this->annotation->readDecorator !== null) {
                    $value = $decorator($this->annotation->readDecorator);
                }
                break;

            case 'write':
                if ($this->annotation->writeDecorator !== null) {
                    $value = $decorator($this->annotation->writeDecorator);
                }
                break;
        }

        $view->with('value', $value);
        $view->with('meta', $this->annotation);
        $view->with('name', $this->annotation->name);

        return $view;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function __call($name, $arguments)
    {
        if ($name === 'read' || $name === 'write') {
            return $this
                ->extend(call_user_func([$this->annotation, $name]), $name)
                ->render();
        }

        return call_user_func([$this->annotation, $name]);
    }
}
