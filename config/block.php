<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */
return array(
    'subscription' => array(
        'name' => 'subscription',
        'title' => _a('Subscription'),
        'description' => _a('Subscribe to Newsletter and website campaign'),
        'render' => array('block', 'subscription'),
        'template' => 'subscription',
        'config' => array(
            'campaign' => array(
                'title' => _a('Campaign'),
                'description' => '',
                'edit' => 'Module\Subscription\Form\Element\Campaign',
                'filter' => 'string',
                'value' => 0,
            ),
        ),
    ),
);