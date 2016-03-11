<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:44 PM
 */

namespace SMS_API\Repository;


use SMS_API\Model\Company;
use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use SMS_API\Model\UserComRole;

interface smsRepository extends RepositoryInterface
{
    public function saveIncoming(IncomingSMS $sms);
    public function saveIncomingLog(User $user,IncomingSMS $sms);
    public function saveOutgoing(OutgoingSMS $sms);
    public function saveOutgoingLog(User $user,OutgoingSMS $sms);
    public function getAllIncoming(User $user);
    public function getAllOutgoing(User $user);
    public function getNewIncoming(User $user);
    public function getNewOutgoing(User $user);
    public function getOutgoingSMS(User $user);
    public function getAuthenticationAdapter();
    public function addUser(User $user);
    public function getComRole(User $user);
    public function isValidUser(User $user);
    public function isValidDevice(SyncDevice $device);
    public function getCompany(Company $company);
    public function deleteIncoming(UserComRole $user_r, IncomingSMS $sms);
    public function deleteOutgoing(UserComRole $user_r, OutgoingSMS $sms);
    public function deleteIncomingLog(UserComRole $user_r, IncomingSMS $sms);
    public function deleteOutgoingLog(UserComRole $user_r, OutgoingSMS $sms);
    public function deleteAllIncoming(UserComRole $user_r);
    public function deleteAllOutgoing(UserComRole $user_r);
    public function deleteAllIncomingLog(UserComRole $user_r);
    public function deleteAllOutgoingLog(UserComRole $user_r);

}