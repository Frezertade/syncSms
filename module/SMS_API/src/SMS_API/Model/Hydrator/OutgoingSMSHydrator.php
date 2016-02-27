<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 10:42 PM
 */

namespace SMS_API\Model\Hydrator;


use SMS_API\Model\OutgoingSMS;
use Zend\Hydrator\HydratorInterface;

class OutgoingSMSHydrator implements HydratorInterface
{
    public function extract($object)
    {
        if(!$object instanceof OutgoingSMS){
            return array();
        }
        return array(
            'company_id' => $object->getCompanyId(),
            'user_id' => $object->getUserId(),
            'sms_msg' => $object->getSmsMsg(),
            'sms_to' => $object->getSmsTo(),
            'sms_from' => $object->getSmsFrom(),
            'created' => $object->getCreated(),
        );
    }

    public function hydrate(array $data, $object)
    {
        if(!$object instanceof OutgoingSMS){
            return $object;
        }
        $object->setCompanyId(isset($data['company_id'])? intval($data['company_id']):null);
        $object->setUserId(isset($data['user_id'])? intval($data['user_id']):null);
        $object->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
        $object->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
        $object->setSmsFrom(isset($data['sms_from'])? $data['sms_from']:null);
        $object->setCreated(isset($data['created'])? $data['created']:null);
        return $object;
    }

}