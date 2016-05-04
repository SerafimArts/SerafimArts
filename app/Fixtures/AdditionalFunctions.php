<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 03.05.2016 4:32
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fixtures;

use Faker\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdditionalFunctions
 * @package Fixtures
 */
class AdditionalFunctions
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * AdditionalFunctions constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function hash($value)
    {
        return Hash::make($value);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->faker->{$name};
    }
}