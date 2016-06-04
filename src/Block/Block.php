<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt BSD 3-Clause License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */
namespace Module\Subscription\Block;

use Pi;
use Zend\Db\Sql\Predicate\Expression;

class Block
{
    public static function subscription($options = array(), $module = null)
    {
        // Set options
        $block = array();
        $block = array_merge($block, $options);

        return $block;
    }
}