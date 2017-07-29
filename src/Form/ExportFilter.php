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
namespace Module\Subscription\Form;

use Pi;
use Zend\InputFilter\InputFilter;

class ExportFilter extends InputFilter
{
    public function __construct($option)
    {
        // include_user
        $this->add(array(
            'name' => 'include_user',
            'required' => false,
        ));
    }
}