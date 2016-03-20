<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:15 AM
 */

namespace Sync_SMS\Service;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Sync_SMS\Model\User;

interface smsService
{
    /**
     * IncomingSMS Services
     */
    public function AddNew_IncomingSMS(IncomingSMS $incomingSMS);
    public function GetNew_IncomingSMS(Campaign $campaign);
    public function GetAll_IncomingSMS(Campaign $campaign);
    public function Delete_IncomingSMS(IncomingSMS $incomingSMS);

    /**
     * OutgoingSMS Services
     */
    public function AddNew_OutgoingSMS(OutgoingSMS $outgoingSMS);
    public function GetAll_OutgoingSMS(Campaign $campaign);
    public function GetNew_OutgoingSMS($device_code);
    public function Delete_OutgoingSMS(OutgoingSMS $outgoingSMS);

    /**
     * Campaign Services
     */
    public function GetCampaigns_by_device_code($device_code);
}