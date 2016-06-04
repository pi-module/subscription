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
namespace Module\Subscription\Api;

use Pi;
use Pi\Application\Api\AbstractApi;

/*
 * Pi::api('notification', 'subscription')->joinUser($user, $campaign);
 */

class Notification extends AbstractApi
{
    public function joinUser($user, $campaign)
    {
        // Check notification module
        if (!Pi::service('module')->isActive('notification')) {
            return false;
        }

        // Get config
        $config = Pi::service('registry')->config->read($this->getModule());

        // Get admin main
        $siteName = Pi::config('sitename');
        $adminMail = Pi::config('adminmail');
        $adminName = Pi::config('adminname');
        
        // Set module name
        $module = Pi::service('module')->current();
        
        // Set uid
        $uid = ($user['uid'] > 0) ? $user['uid'] : '';

        // Set mail information
        $information = array(
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'title' => $campaign['title'],
            'extra' => $campaign['text_main'],
            'time' => _date($user['time_join']),
        );

        // Send mail to admin
        if ($config['notification_admin_email']) {
            $toAdmin = array(
                $adminMail => $adminName,
            );
            Pi::api('mail', 'notification')->send(
                $toAdmin,
                'subscription_admin',
                $information,
                $module
            );
        }

        // Send sms to admin
        if ($config['notification_admin_sms']) {
            $content = sprintf(
                $config['sms_subscription_admin'],
                $siteName,
                $user['first_name'],
                $user['last_name'],
                $campaign['title']
            );
            Pi::api('sms', 'notification')->sendToAdmin($content);
        }

        // Send mail to user
        if (isset($user['email']) && !empty($user['email'])) {
            $toUser = array(
                $user['email'] => sprintf('%s %s', $user['first_name'], $user['last_name']),
            );
            Pi::api('mail', 'notification')->send(
                $toUser,
                'subscription_user',
                $information,
                $module,
                $uid
            );
        }

        // Send sms to user
        if (isset($user['mobile']) && !empty($user['mobile'])) {
            $content = sprintf(
                $config['sms_subscription_user'],
                $user['first_name'],
                $user['last_name'],
                $campaign['text_sms']
            );
            Pi::api('sms', 'notification')->send($content, $user['mobile']);
        }
    }
}