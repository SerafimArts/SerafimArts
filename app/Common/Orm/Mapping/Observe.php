<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Common\Orm\Mapping;

use Doctrine\Common\Annotations\Annotation\Target;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Observe
 * @package Common\Orm\Mapping
 * @Annotation
 * @Target("CLASS")
 */
class Observe
{
    /**
     * @var array
     */
    public $value = [];

    /**
     * @param array $data Key-value for properties to be defined in this class.
     * @throws \LogicException
     */
    public final function __construct(array $data)
    {
        if (isset($data['value'])) {
            $this->value = (array)$data['value'];
        }
    }

    /**
     * @param string|Model $model
     */
    public function observe(string $model)
    {
        foreach ($this->value as $observer) {
            $model::observe($observer);
        }
    }
}