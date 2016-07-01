<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Orm\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Repository
 * @package Common\Orm\Mapping
 * @Annotation
 * @Target("CLASS")
 */
class Repository
{
    /**
     * @var string
     */
    public $class;

    /**
     * @var mixed
     */
    public $interface;

    /**
     * Repository constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (!isset($values['class'])) {
            throw new \LogicException('Repository class must defined');
        }

        if (!isset($values['interface'])) {
            $this->interface = $values['class'] ?? null;

            $reflection = new \ReflectionClass($values['class']);
            $interfaces = $reflection->getInterfaces();

            if (count($interfaces) === 1) {
                /** @var \ReflectionClass $interface */
                $interface = reset($interfaces);
                $this->interface = $interface->name;
            }
        }

        $this->class = $values['class'];
    }
}