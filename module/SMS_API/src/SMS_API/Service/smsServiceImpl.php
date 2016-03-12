<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:57 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use Zend\Authentication\AuthenticationService;

class smsServiceImpl implements smsService
{
    /**
     * @var \SMS_API\Repository\smsRepository $smsRepository
     */
    protected $smsRepository;

    /**
     * @param \SMS_API\Model\IncomingSMS $sms
     */
    public function saveIncoming(IncomingSMS $sms)
    {
        $this->smsRepository->saveIncoming($sms);
    }

    public function getOutgoingSMS($device_id)
    {
        $this->smsRepository->getOutgoingSMS($device_id);
    }

    public function isValidUser(User $user)
    {
        return $this->authenticate($user->getUserName(),$user->getUserPass());
    }

    public function isValidDevice(SyncDevice $device)
    {
        return $this->smsRepository->isValidDevice($device);
    }

    /**
     * @return \SMS_API\Repository\smsRepository
     */
    public function getSmsRepository()
    {
        return $this->smsRepository;
    }

    /**
     * @param \SMS_API\Repository\smsRepository $smsRepository
     */
    public function setSmsRepository($smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    /**
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthenticationService()
    {
        $AuthAdapter = $this->smsRepository->getAuthenticationAdapter();
        return new AuthenticationService(null,$AuthAdapter);
    }

    public function authenticate($userName, $userPass)
    {
        $AuthService = $this->getAuthenticationService();
        /**
         * @var  \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter $AuthAdapter
         */
        $AuthAdapter = $AuthService->getAdapter();
        $AuthAdapter->setIdentity($userName);
        $AuthAdapter->setCredential($userPass);
        $Result = $AuthAdapter->authenticate();
        if($Result->isValid()){
            return true;
        }
        return false;
    }

    public function addUser(User $user)
    {
        return $this->smsRepository->addUser($user);
    }

    public function getAllIncoming(User $user)
    {
        return $this->smsRepository->getAllIncoming($user);
    }

    public function getAllOutgoing(User $user)
    {
        return $this->smsRepository->getAllOutgoing($user);
    }

    /**
     * @param \SMS_API\Model\User $user
     * @return \SMS_API\Model\UserComRole
     */
    public function getComRole(User $user)
    {
        return $this->smsRepository->getComRole($user);
    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\IncomingSMS $sms
     * @return bool
     */
    public function saveIncomingLog(User $user, IncomingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->saveIncomingLog($user,$sms);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @return bool
     */
    public function getNewIncoming(User $user)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->getNewIncoming($user);
        }else{
            return false;
        }

    }

    /**
     * @param \SMS_API\Model\User $user
     * @return mixed
     */
    public function getNewOutgoing(User $user)
    {
        return $this->smsRepository->getNewOutgoing($user);
    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\IncomingSMS $sms
     * @return bool
     */
    public function deleteIncoming(User $user, IncomingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteIncoming($user_role,$sms);
        }else{
            return false;
        }

    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\IncomingSMS $sms
     * @return bool
     */
    public function deleteIncomingLog(User $user, IncomingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteIncomingLog($user_role,$sms);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @return bool
     */
    public function deleteAllIncoming(User $user)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteAllIncoming($user_role);
        }else{
            return false;
        }
    }
    /**
     * @param \SMS_API\Model\User $user
     * @return bool
     */
    public function deleteAllIncomingLog(User $user)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteAllIncomingLog($user_role);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return mixed
     */
    public function saveOutgoing(User $user,OutgoingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            $sms->setCompanyId($this->getComRole($user)->getCompanyID());
            $sms->setUserId($this->getComRole($user)->getUserID());
            return $this->smsRepository->saveOutgoing($sms);
        }else{
            return false;
        }
    }

    /**
     * @param User $user
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return bool
     */
    public function saveOutgoingLog(User $user, OutgoingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->saveOutgoingLog($user_role,$sms);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return bool
     */
    public function deleteOutgoing(User $user, OutgoingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteOutgoing($user_role,$sms);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return bool
     */
    public function deleteOutgoingLog(User $user, OutgoingSMS $sms)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteOutgoingLog($user_role,$sms);
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\User $user
     * @return bool
     */
    public function deleteAllOutgoing(User $user)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteAllOutgoing($user_role);
        }else{
            return false;
        }
    }
    /**
     * @param \SMS_API\Model\User $user
     * @return bool
     */
    public function deleteAllOutgoingLog(User $user)
    {
        $user_role = $this->getComRole($user);
        if($user_role != null){
            return $this->smsRepository->deleteAllOutgoingLog($user_role);
        }else{
            return false;
        }
    }


}