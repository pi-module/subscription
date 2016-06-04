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
namespace Module\Subscription\Form\Element;

use Pi;
use Zend\Form\Element\Image as ZendImage;

class Image extends ZendImage
{
    /**
     * @return array
     */
    public function getAttributes()
    {
        $this->Attributes = array(
            'class' => 'img-thumbnail item-img',
            'src' => $this->attributes['src'],
        );
        return $this->Attributes;
    }
}