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
use Zend\Form\Element\Select;

class Campaign extends Select
{
    /**
     * @return array
     */
    public function getValueOptions()
    {
        if (empty($this->valueOptions)) {
            $this->valueOptions = array();
            // Get topic list
            $columns = array('id', 'title');
            $where = array('status' => 1);
            $select = Pi::model('campaign', 'subscription')->select()->columns($columns)->where($where);
            $rowset = Pi::model('campaign', 'subscription')->selectWith($select);
            foreach ($rowset as $row) {
                $this->valueOptions[$row->id] = $row->title;
            }
        }
        return $this->valueOptions;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $this->Attributes = array(
            'size' => 1,
            'multiple' => 0,
            'class' => 'form-control',
        );
        // check form size
        if (isset($this->attributes['size'])) {
            $this->Attributes['size'] = $this->attributes['size'];
        }
        // check form multiple
        if (isset($this->attributes['multiple'])) {
            $this->Attributes['multiple'] = $this->attributes['multiple'];
        }
        return $this->Attributes;
    }
}