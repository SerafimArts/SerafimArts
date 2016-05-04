<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 22:11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Blueprints;

use Illuminate\Contracts\View\View;
use Serafim\Blueprint\Mapping\Field as PropertyMetadata;

/**
 * Class Property
 * @package Serafim\Blueprint\Blueprints
 */
class Property
{
    /**
     * @var PropertyMetadata
     */
    private $field;

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
     * @param PropertyMetadata $field
     * @param string $name
     * @param mixed $value
     */
    public function __construct(PropertyMetadata $field, $name, $value)
    {
        $this->field = $field;
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->extend($this->field->read())->render();
    }

    /**
     * @param View $view
     * @return View
     */
    private function extend(View $view)
    {
        $view->with('name', $this->name);
        $view->with('value', $this->value);
        $view->with('meta', $this->field);

        return $view;
    }

    /**
     * @return string
     */
    public function write()
    {
        return $this->extend($this->field->write())->render();
    }
}