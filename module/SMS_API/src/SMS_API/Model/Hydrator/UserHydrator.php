<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 10:58 PM
 */

namespace SMS_API\Model\Hydrator;


use SMS_API\Model\User;
use Zend\Hydrator\HydratorInterface;

class UserHydrator implements HydratorInterface
{
    public function extract($object)
    {
        if(!$object instanceof User){
            return array();
        }
        return array(
            'id' => $object->getId(),
            'user_name' => $object->getUserName(),
            'user_pass' => $object->getUserPass(),
            'created' => $object->getCreated(),
        );
    }

    public function hydrate(array $data, $object)
    {
        if (!$object instanceof User) {
            return $object;
        }
        $object->setId(isset($data['id'])? intval($data['id']):null);
        $object->setUserName(isset($data['user_name'])? $data['user_name']:null);
        $object->setUserPass(isset($data['user_pass'])? $data['user_pass']:null);
        $object->setCreated(isset($data['created'])? $data['created']:null);
        return $object;
    }

}