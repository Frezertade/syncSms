<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:40 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\User;

interface smsService
{
    public function saveIncoming(IncomingSMS $sms);
    public function getOutgoingSMS($device_id);
    public function isValidUser($userName,$password);
    public function getAuthenticationService();
    public function authenticate($userName,$userPass);
    public function addUser(User $user);

}