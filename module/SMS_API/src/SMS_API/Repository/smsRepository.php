<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:44 PM
 */

namespace SMS_API\Repository;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SMSLog;
use SMS_API\Model\User;

interface smsRepository extends RepositoryInterface
{
    public function saveIncoming(IncomingSMS $sms);
    public function saveOutgoing(OutgoingSMS $sms);
    public function getAllIncoming();
    public function getAllOutgoing();
    public function getNewIncoming();
    public function saveSMSLog(SMSLog $sms);
    public function getOutgoingSMS($device_id);
    public function isValidUser($userName,$password);
    public function getAuthenticationAdapter();
    public function addUser(User $user);

}