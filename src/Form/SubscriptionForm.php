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
use Pi\Form\Form as BaseForm;

class SubscriptionForm extends BaseForm
{
    public function __construct($name = null, $option = array())
    {
        $this->option = $option;
        parent::__construct($name);
    }

    public function getInputFilter()
    {
        if (!$this->filter) {
            $this->filter = new SubscriptionFilter($this->option);
        }
        return $this->filter;
    }

    public function init()
    {
        // id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        // first_name
        $this->add(array(
            'name' => 'first_name',
            'options' => array(
                'label' => __('First name'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
                'required' => true,
            )
        ));
        // last_name
        $this->add(array(
            'name' => 'last_name',
            'options' => array(
                'label' => __('Last name'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
                'required' => true,
            )
        ));
        // email
        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => __('Email'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
                'required' => (in_array($this->option['type'], array('both', 'email'))) ? true : false,
            )
        ));
        // mobile
        $this->add(array(
            'name' => 'mobile',
            'options' => array(
                'label' => __('Mobile'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
                'required' => (in_array($this->option['type'], array('both', 'mobile'))) ? true : false,
            )
        ));

        // Save
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => __('Subscription'),
            )
        ));
    }
}