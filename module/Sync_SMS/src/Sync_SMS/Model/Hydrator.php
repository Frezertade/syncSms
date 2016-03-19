<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 8:12 AM
 */

namespace Sync_SMS\Model;


class Hydrator
{
    public function Hydrate($Post,$DataType){
        if(is_array($Post)){
            if($DataType instanceof IncomingSMS){
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new IncomingSMS();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setSmsId(isset($data['sms_id'])? ($data['sms_id']):null);
                    $New_Data->setCampaignId(isset($data['campaign_id'])? $data['campaign_id']:null);
                    $New_Data->setSmsFrom(isset($data['sms_from'])? $data['sms_from']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? intval($data['sms_msg']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }else if($DataType instanceof OutgoingSMS){
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new OutgoingSMS();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setCampaignId(isset($data['campaign_id'])? $data['campaign_id']:null);
                    $New_Data->setUuid(isset($data['uuid'])? $data['uuid']:null);
                    $New_Data->setSmsMsg(isset($data['sms_msg'])? intval($data['sms_msg']):null);
                    $New_Data->setSmsTo(isset($data['sms_to'])? $data['sms_to']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }else if($DataType instanceof User){
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new User();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserName(isset($data['user_name'])? ($data['user_name']):null);
                    $New_Data->setUserEmail(isset($data['user_email'])? $data['user_email']:null);
                    $New_Data->setUserPass(isset($data['user_pass'])? $data['user_pass']:null);
                    $New_Data->setCreated(isset($data['created'])? intval($data['created']):null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }
        }
        return null;
    }
}