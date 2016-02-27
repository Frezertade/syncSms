<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:57 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;
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

    public function isValidUser($userName, $password)
    {
        $this->smsRepository->isValidUser($userName, $password);
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

    public function getAllIncoming($CompanyID)
    {
        return $this->smsRepository->getAllIncoming($CompanyID);
    }

    public function getAllOutgoing($CompanyID)
    {
        return $this->smsRepository->getAllOutgoing($CompanyID);
    }


}