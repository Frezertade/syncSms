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
        // TODO: Implement extract() method.
    }

    public function hydrate(array $data, $object)
    {
        if(!$object instanceof IncomingSMS)
        {
            return $object;
        }
        $object->setCompnyId(isset($data['id'])? intval($data['id']):null);
        $object->setUserId(isset($data['title'])? $data['title']:null);
        $object->setDeviceId(isset($data['content'])? $data['content']:null);
        $object->setSmsMsg(isset($data['slug'])? $data['slug']:null);
        $object->setCompnyId(isset($data['id'])? intval($data['id']):null);
        $object->setUserId(isset($data['title'])? $data['title']:null);
        $object->setDeviceId(isset($data['content'])? $data['content']:null);
        $object->setSmsMsg(isset($data['slug'])? $data['slug']:null);
        return $object;
    }

}