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
    /**
     * @param \Sync_SMS\Model\Campaign $campaign
     * @param \Sync_SMS\Model\IncomingSMS $incomingSMS
     * @return mixed
     */
    public function AddNew_IncomingSMS(Campaign $campaign,IncomingSMS $incomingSMS);

    /**
     * @param \Sync_SMS\Model\Campaign $campaign
     * @return mixed
     */
    public function GetNew_IncomingSMS(Campaign $campaign);
    /**
     * @param \Sync_SMS\Model\Campaign $campaign
     * @return mixed
     */
    public function GetAll_IncomingSMS(Campaign $campaign);

    /**
     * @param \Sync_SMS\Model\Campaign $campaign
     * @param \Sync_SMS\Model\IncomingSMS $incomingSMS
     * @return mixed
     */
    public function Delete_IncomingSMS(Campaign $campaign,IncomingSMS $incomingSMS);

    /**
     * OutgoingSMS Services
     */
    /**
     * @param User $user
     * @param \Sync_SMS\Model\Campaign $campaign
     * @param \Sync_SMS\Model\OutgoingSMS $outgoingSMS
     * @return mixed
     */
    public function AddNew_OutgoingSMS(User $user,Campaign $campaign,OutgoingSMS $outgoingSMS);
    public function GetAll_OutgoingSMS(Campaign $campaign);
    public function Delete_OutgoingSMS(Campaign $campaign, OutgoingSMS $outgoingSMS);
}