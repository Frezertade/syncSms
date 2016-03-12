<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:40 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;

interface smsService
{


    public function isValidUser(User $user);
    public function isValidDevice(SyncDevice $device);
    public function getAuthenticationService();
    public function authenticate($userName,$userPass);
    public function addUser(User $user);


    public function getComRole(User $user);


    /**
     * Service related to Incoming SMS
     */
    public function saveIncoming(IncomingSMS $sms);
    public function saveIncomingLog(User $user,IncomingSMS $sms);

    public function getNewIncoming(User $user);
    public function getAllIncoming(User $user);

    public function deleteIncoming(User $user, IncomingSMS $sms);
    public function deleteIncomingLog(User $user, IncomingSMS $sms);
    public function deleteAllIncoming(User $user);
    public function deleteAllIncomingLog(User $user);

    /**
     * Service related to Outgoing SMS
     */
    public function getOutgoingSMS($device_id);
    public function getAllOutgoing(User $user);
    public function getNewOutgoing(User $user);

    public function saveOutgoing(User $user,OutgoingSMS $sms);
    public function saveOutgoingLog(User $user,OutgoingSMS $sms);

    public function deleteOutgoing(User $user, OutgoingSMS $sms);
    public function deleteOutgoingLog(User $user, OutgoingSMS $sms);
    public function deleteAllOutgoing(User $user);
    public function deleteAllOutgoingLog(User $user);
}