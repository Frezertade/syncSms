<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/1/2016
 * Time: 9:16 PM
 */

namespace SMS_API\Model;


class Hydrator
{
    public function __construct()
    {
        print_r('Data initialised');
    }

    public function Hydrate($PDO_Posts,$DataType){
        if(is_array($PDO_Posts)){
            if($DataType instanceof IncomingSMS){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new IncomingSMS();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCompanyId(isset($data['company_id'])? ($data['company_id']):null);
                    $New_Data->setDeviceId(isset($data['device_id'])? $data['device_id']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
                    $New_Data->setSmsFrom(isset($data['sms_from'])? intval($data['sms_from']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }else if($DataType instanceof OutgoingSMS){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new OutgoingSMS();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? $data['user_id']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
                    $New_Data->setSmsFrom(isset($data['sms_from'])? intval($data['sms_from']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }else if($DataType instanceof UserComRole){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new UserComRole();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? $data['user_id']:null);
                    $New_Data->setCompanyID(isset($data['company_id'])? $data['company_id']:null);
                    $New_Data->setRole(isset($data['role'])? intval($data['role']):null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found = $New_Data;
                }
                return $Found;
            }else if($DataType instanceof Company){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new Company();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setSecret(isset($data['secret_num'])? $data['secret_num']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found = $New_Data;
                }
                return $Found;
            }
        }else{
            return null;
        }
    }
    public function Extract($PDO_Posts,$DataType){
        if(is_array($PDO_Posts)){
            if($DataType instanceof IncomingSMS){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new IncomingSMS();
                    $New_Data->setSmsId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCompanyId(isset($data['company_id'])? ($data['company_id']):null);
                    $New_Data->setDeviceId(isset($data['device_id'])? $data['device_id']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
                    $New_Data->setSmsFrom(isset($data['sms_from'])? intval($data['sms_from']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }else if($DataType instanceof OutgoingSMS){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new OutgoingSMS();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? $data['user_id']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? $data['sms_msg']:null);
                    $New_Data->setSmsFrom(isset($data['sms_from'])? intval($data['sms_from']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }else if($DataType instanceof UserComRole){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new UserComRole();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? $data['user_id']:null);
                    $New_Data->setCompanyID(isset($data['company_id'])? $data['company_id']:null);
                    $New_Data->setRole(isset($data['role'])? intval($data['role']):null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $New_Data->setUpdated(isset($data['updated'])? $data['updated']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }else if($DataType instanceof Company){
                $Found = null;
                foreach($PDO_Posts as $data){
                    $New_Data = new Company();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setSecret(isset($data['secret_num'])? $data['secret_num']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }
        }else{
            return null;
        }
    }
}