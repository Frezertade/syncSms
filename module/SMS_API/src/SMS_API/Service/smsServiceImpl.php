<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:57 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use Zend\Authentication\AuthenticationService;

class smsServiceImpl implements smsService
{
    /**
     * @var \SMS_API\Repository\smsRepository $smsRepository
     */
    protected $smsRepository;

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

    public function getComRole(User $user)
    {
        return $this->smsRepository->getComRole($user);
    }

    public function saveIncomingLog(User $user, IncomingSMS $sms)
    {
        return $this->smsRepository->saveIncomingLog($user,$sms);
    }

    public function saveOutgoing(OutgoingSMS $sms)
    {
        return $this->smsRepository->saveOutgoing($sms);
    }

    public function saveOutgoingLog(User $user, OutgoingSMS $sms)
    {
        return $this->smsRepository->saveOutgoingLog($user,$sms);
    }

    public function getNewIncoming(User $user)
    {
        return $this->smsRepository->getNewIncoming($user);
    }

    public function getNewOutgoing(User $user)
    {
        return $this->smsRepository->getNewOutgoing($user);
    }

    public function saveSMSLog(User $user)
    {
        return $this->smsRepository->saveSMSLog($user);
    }


}