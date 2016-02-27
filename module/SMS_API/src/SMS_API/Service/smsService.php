<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:40 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;

interface smsService
{
    public function saveIncoming(IncomingSMS $sms);
    public function getOutgoingSMS($device_id);
    public function isValidUser($userName,$password);

}