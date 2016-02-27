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
    public function getAllIncoming($CompanyID);
    public function getAllOutgoing($CompanyID);
    public function getNewIncoming($CompanyID);
    public function saveSMSLog(SMSLog $sms);
    public function getOutgoingSMS($Device_id);
    public function getAuthenticationAdapter();
    public function addUser(User $user);

}