<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:57 PM
 */

namespace SMS_API\Service;


use SMS_API\Model\IncomingSMS;

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


}