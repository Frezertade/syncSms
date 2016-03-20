<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:28 AM
 */

namespace Sync_SMS\Service;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Sync_SMS\Model\User;

class smsServiceImpl implements smsService
{
    /**
     * @var \Sync_SMS\Repository\RepositoryInterface   $smsRepository
     */
    protected $smsRepository;

    /**
     * @return \Sync_SMS\Repository\RepositoryInterface
     */
    public function getSmsRepository()
    {
        return $this->smsRepository;
    }

    /**
     * @param \Sync_SMS\Repository\RepositoryInterface $smsRepository
     */
    public function setSmsRepository($smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function AddNew_IncomingSMS(IncomingSMS $incomingSMS)
    {
        return $this->smsRepository->AddNew_IncomingSMS($incomingSMS);
    }

    public function GetNew_IncomingSMS(Campaign $campaign)
    {
        // TODO: Implement GetNew_IncomingSMS() method.
    }

    public function GetAll_IncomingSMS(Campaign $campaign)
    {
        // TODO: Implement GetAll_IncomingSMS() method.
    }

    public function Delete_IncomingSMS(IncomingSMS $incomingSMS)
    {
        // TODO: Implement Delete_IncomingSMS() method.
    }

    public function AddNew_OutgoingSMS(OutgoingSMS $outgoingSMS)
    {
        // TODO: Implement AddNew_OutgoingSMS() method.
    }

    public function GetNew_OutgoingSMS($device_code)
    {
        return $this->smsRepository->GetNew_OutgoingSMS($device_code);
    }

    public function GetAll_OutgoingSMS(Campaign $campaign)
    {
        // TODO: Implement GetAll_OutgoingSMS() method.
    }

    public function Delete_OutgoingSMS(OutgoingSMS $outgoingSMS)
    {
        // TODO: Implement Delete_OutgoingSMS() method.
    }

    public function GetCampaigns_by_device_code($device_code)
    {
        return $this->smsRepository->GetCampaigns_by_device_code($device_code);
    }


}