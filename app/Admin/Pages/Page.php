<?php
/**
 * This file is part of SerafimArts package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Admin\Pages;

use SleepingOwl\Admin\Model\ModelConfiguration;

/**
 * Interface Page
 * @package Admin\Pages
 */
interface Page
{
    /**
     * Page constructor.
     * @param ModelConfiguration $model
     */
    public function __construct(ModelConfiguration $model);
}