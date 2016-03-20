<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 6:48 AM
 */

namespace Sync_SMS\Repository;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\Contact;
use Sync_SMS\Model\Device;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Sync_SMS\Model\User;

interface RepositoryInterface extends Repository
{
    /**
     * IncomingSMS Services
     */
    public function AddNew_IncomingSMS(IncomingSMS $incomingSMS);
    public function AddNew_IncomingSMS_Log($sms_id);
    public function GetNew_IncomingSMS(Campaign $campaign);
    public function GetAll_IncomingSMS(Campaign $campaign);
    public function GetAll_IncomingSMS_();
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
     * Sync SMS Campaign Sevices
     */
    public function GetCampaigns(Device $device);
    public function GetCampaigns_by_user(User $device);
    public function GetCampaigns_by_device_code($device_code);
    public function GetCampaigns_by_name($name);

    /**
     * Company Services
     */
    public function GetCompanies(User $user);

    /**
     * Device Service
     */
    public function GetDevice($device_code);

    /**
     * Contact Services
     */
    public function Get_Contact($PhoneNum);
    public function AddNew_Contact(Contact $contact);

    /**
     * Contact Campaign
     */
    public function AddNew_CampaignContact(Contact $contact,Campaign $campaign);
}