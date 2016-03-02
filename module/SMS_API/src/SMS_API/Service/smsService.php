<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:40 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;

interface smsService
{
    public function saveIncoming(IncomingSMS $sms);
    public function getOutgoingSMS($device_id);
    public function isValidUser(User $user);
    public function isValidDevice(SyncDevice $device);
    public function getAuthenticationService();
    public function authenticate($userName,$userPass);
    public function addUser(User $user);
    public function getAllIncoming(User $user);
    public function getAllOutgoing(User $user);
    public function getComRole(User $user);

    public function saveIncomingLog(User $user,IncomingSMS $sms);
    public function saveOutgoing(OutgoingSMS $sms);
    public function saveOutgoingLog(User $user,OutgoingSMS $sms);
    public function getNewIncoming(User $user);
    public function getNewOutgoing(User $user);
    public function saveSMSLog(User $user);

}