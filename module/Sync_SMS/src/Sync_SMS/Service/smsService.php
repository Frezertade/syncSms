<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:15 AM
 */

namespace Sync_SMS\Service;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\Contact;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Sync_SMS\Model\User;

interface smsService
{
    /**
     * IncomingSMS Services
     */
    public function AddNew_IncomingSMS(IncomingSMS $incomingSMS);
    public function AddNew_IncomingSMS_Log($sms_id);
    public function GetAll_IncomingSMS_();
    public function GetNew_IncomingSMS(Campaign $campaign);
    public function GetAll_IncomingSMS(Campaign $campaign);
    public function Delete_IncomingSMS(IncomingSMS $incomingSMS);

    /**
     * OutgoingSMS Services
     */
    public function AddNew_OutgoingSMS(OutgoingSMS $outgoingSMS);
    public function AddNew_OutgoingSMS_Log($sms_id);
    public function GetAll_OutgoingSMS(Campaign $campaign);
    public function GetNew_OutgoingSMS($device_code);
    public function Delete_OutgoingSMS(OutgoingSMS $outgoingSMS);

    /**
     * Campaign Services
     */
    public function GetCampaigns_by_device_code($device_code);
    public function GetCampaigns_by_name($name);

    /**
     * Contact Services
     */
    public function AddNew_Contact(Contact $contact);
    public function Get_Contact($PhoneNum);

    /**
     * Campaign Contacts Service
     */
    public function AddNew_CampaignContact(Contact $contact,Campaign $campaign);

    public function Process_Campaign_Request();
    public function Process_Campaign_Registration($device_code);
}