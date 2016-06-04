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
namespace Module\Subscription\Validator;

use Pi;
use Zend\Validator\AbstractValidator;

class MobileDuplicate extends AbstractValidator
{
    const TAKEN = 'mobileExists';

    /**
     * @var array
     */
    protected $messageTemplates = array(
        self::TAKEN => 'This mobile already exists',
    );

    protected $options = array(
        'module', 'table'
    );

    /**
     * mobile validate
     *
     * @param  mixed $value
     * @param  array $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        $this->setValue($value);
        if (null !== $value) {
            $where = array('mobile' => $value);
            if (!empty($context['id'])) {
                $where['id <> ?'] = $context['id'];
            }
            $rowset = Pi::model($this->options['table'], $this->options['module'])->select($where);
            if ($rowset->count()) {
                $this->error(static::TAKEN);
                return false;
            }
        }
        return true;
    }
}
