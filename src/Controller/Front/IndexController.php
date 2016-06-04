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
namespace Module\Subscription\Controller\Front;

use Pi;
use Pi\Mvc\Controller\ActionController;
use Module\Subscription\Form\SubscriptionForm;
use Module\Subscription\Form\SubscriptionFilter;

class IndexController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $module = $this->params('module');
        $slug = $this->params('slug');
        // Get config
        $config = Pi::service('registry')->config->read($module);
        // Get campaign
        if (isset($slug) && !empty($slug)) {
            $campaign = $this->getModel('campaign')->find($slug, 'slug');
            if (!empty($campaign)) {
                $campaign = $campaign->toArray();
                if ($campaign['status'] != 1 || $campaign['time_start'] > time() || $campaign['time_end'] < time()) {
                    $this->getResponse()->setStatusCode(404);
                    $this->terminate(__('The campaign not found.'), '', 'error-404');
                    $this->view()->setLayout('layout-simple');
                    return;
                }
            } else {
                $this->getResponse()->setStatusCode(404);
                $this->terminate(__('The campaign not found.'), '', 'error-404');
                $this->view()->setLayout('layout-simple');
                return;
            }
        } else {
            $campaign = array();
            $campaign['title'] = $config['default_title'];
            $campaign['text_description'] = $config['default_description'];
            $campaign['text_subscription'] = $config['default_subscription'];
            $campaign['text_email'] = $config['default_email'];
            $campaign['text_sms'] = $config['default_sms'];
            $campaign['subscription_type'] = $config['default_subscription_type'];
        }
        // Get user information
        $uid = Pi::user()->getId();
        if ($uid > 0) {
            $user = Pi::api('user', 'subscription')->getUserInformation($uid);
            // Set view
            $this->view()->assign('user', $user);
        }
        // Set option
        $option = array(
            'type' => $campaign['subscription_type'],
            'uid' => $uid,
        );
        // Set form
        $form = new SubscriptionForm('subscription', $option);
        $form->setAttribute('enctype', 'multipart/form-data');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter(new SubscriptionFilter($option));
            $form->setData($data);
            if ($form->isValid()) {
                $values = $form->getData();
            }
        } else {
            $subscription = array();
            if (isset($user['first_name']) && !empty($user['first_name'])) {
                $subscription['first_name'] = $user['first_name'];
            }
            if (isset($user['last_name']) && !empty($user['last_name'])) {
                $subscription['last_name'] = $user['last_name'];
            }
            if (isset($user['email']) && !empty($user['email'])) {
                $subscription['email'] = $user['email'];
            }
            if (isset($user['mobile']) && !empty($user['mobile'])) {
                $subscription['mobile'] = $user['mobile'];
            }
            $form->setData($subscription);
        }
        // Set view
        $this->view()->setTemplate('subscription');
        $this->view()->assign('config', $config);
        $this->view()->assign('campaign', $campaign);
        $this->view()->assign('form', $form);
    }
}