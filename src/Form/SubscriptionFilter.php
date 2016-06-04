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

class SubscriptionFilter extends InputFilter
{
    public function __construct($option)
    {
        // first_name
        $this->add(array(
            'name' => 'first_name',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // last_name
        $this->add(array(
            'name' => 'last_name',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // email
        $this->add(array(
            'name' => 'email',
            'required' => (in_array($option['type'], array('both', 'email'))) ? true : false,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
            'validators'    => array(
                new \Module\Subscription\Validator\EmailDuplicate(array(
                    'module'            => Pi::service('module')->current(),
                    'table'             => 'people',
                )),
            ),
        ));
        // mobile
        $this->add(array(
            'name' => 'mobile',
            'required' => (in_array($option['type'], array('both', 'mobile'))) ? true : false,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
            'validators'    => array(
                new \Module\Subscription\Validator\MobileDuplicate(array(
                    'module'            => Pi::service('module')->current(),
                    'table'             => 'people',
                )),
            ),
        ));
    }
}