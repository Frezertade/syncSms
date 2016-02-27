<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 10:36 PM
 */

namespace SMS_API\Model\Hydrator;


use SMS_API\Model\IncomingSMS;
use Zend\Hydrator\HydratorInterface;

class IncomingSMSHydrator implements HydratorInterface
{
    public function extract($object)
    {
        if(!$object instanceof IncomingSMS){
            return array();
        }
        return array(
            'company_id' => $object->getCompanyId(),
            'user_id' => $object->getUserId(),
            'sms_msg' => $object->getSmsMsg(),
            'sms_to' => $object->getSmsTo(),
            'sms_from' => $object->getSmsFrom(),
        );
    }

    public function hydrate(array $data, $object)
    {
        if(!$object instanceof IncomingSMS)
        {
            return $object;
        }
        $object->setSmsId(isset($data['id'])? intval($data['id']):null);
        $object->setCompnyId(isset($data['company_id'])? ($data['company_id']):null);
        $object->setUserId(isset($data['user_id'])? $data['user_id']:null);
        $object->setDeviceId(isset($data['device_id'])? $data['device_id']:null);
        $object->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
        $object->setSmsFrom(isset($data['sms_from'])? intval($data['sms_from']):null);
        $object->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
        return $object;
    }

}