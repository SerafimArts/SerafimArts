<?php
/**
 * This file is part of SerafimArts package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 10.05.2016 4:58
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Presenter;

use Serafim\Blueprint\Metadata;
use Serafim\Properties\Getters;

/**
 * Class Record
 * @package Serafim\Blueprint\Presenter
 * @property-read array $properties
 */
class Record
{
    use Getters;

    /**
     * @var Metadata
     */
    private $metadata;

    /**
     * @var object
     */
    private $blueprint;

    /**
     * Record constructor.
     * @param Metadata $metadata
     * @param $blueprint
     */
    public function __construct(Metadata $metadata, $blueprint)
    {
        $this->metadata = $metadata;
        $this->blueprint = $blueprint;
    }

    /**
     * @return \Generator
     */
    public function getProperties()
    {
        $reflection = new \ReflectionObject($this->blueprint);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            $value = $property->isStatic()
                ? $property->getValue()
                : $property->getValue($this->blueprint);

            yield new Property(
                $this->metadata->getPropertyAnnotation($property->name),
                $property->name,
                $value
            );
        }
    }
}