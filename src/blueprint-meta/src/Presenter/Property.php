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
     * @var string
     */
    private $name;

    /**
     * Property constructor.
     * @param PropertyAnnotation $property
     * @param string $name
     * @param $value
     */
    public function __construct(PropertyAnnotation $property, $name, $value)
    {
        $this->annotation = $property;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'value') {
            return $this->value;
        }

        return $this->annotation->{$name};
    }

    /**
     * @param View $view
     * @return View
     */
    private function extend(View $view)
    {
        $view->with('name', $this->name);
        $view->with('value', $this->value);
        $view->with('meta', $this->annotation);

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
                ->extend(call_user_func([$this->annotation, $name]))
                ->render();
        }

        return call_user_func([$this->annotation, $name]);
    }
}