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
    'front' => array(),
    'admin' => array(
        'people' => array(
            'label' => _a('People'),
            'permission' => array(
                'resource' => 'people',
            ),
            'route' => 'admin',
            'module' => 'subscription',
            'controller' => 'people',
            'action' => 'index',
        ),

        'campaign' => array(
            'label' => _a('Campaign'),
            'permission' => array(
                'resource' => 'campaign',
            ),
            'route' => 'admin',
            'module' => 'subscription',
            'controller' => 'campaign',
            'action' => 'index',
        ),

        'tools' => array(
            'label' => _a('Tools'),
            'permission' => array(
                'resource' => 'tools',
            ),
            'route' => 'admin',
            'module' => 'subscription',
            'controller' => 'tools',
            'action' => 'index',
        ),
    ),
);