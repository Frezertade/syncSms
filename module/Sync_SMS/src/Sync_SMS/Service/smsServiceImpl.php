<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:28 AM
 */

namespace Sync_SMS\Service;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\Contact;
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
        try{
            return $this->smsRepository->AddNew_IncomingSMS($incomingSMS);
        }catch(\Exception $e){
            return null;
        }

    }

    public function AddNew_IncomingSMS_Log($sms_id)
    {
        try{
            return $this->smsRepository->AddNew_IncomingSMS_Log($sms_id);
        }catch(\Exception $e){
            return null;
        }

    }

    public function GetAll_IncomingSMS_()
    {
        try{
            return $this->smsRepository->GetAll_IncomingSMS_();
        }catch(\Exception $e){
            return null;
        }

    }

    public function GetNew_IncomingSMS(Campaign $campaign)
    {
        try{

        }catch(\Exception $e){
            return null;
        }
    }

    public function GetAll_IncomingSMS(Campaign $campaign)
    {
        try{

        }catch(\Exception $e){
            return null;
        }
    }

    public function Delete_IncomingSMS(IncomingSMS $incomingSMS)
    {
        try{

        }catch(\Exception $e){
            return null;
        }
    }

    public function AddNew_OutgoingSMS(OutgoingSMS $outgoingSMS)
    {
        return $this->smsRepository->AddNew_OutgoingSMS($outgoingSMS);
    }

    public function AddNew_OutgoingSMS_Log($sms_id)
    {
        try{
            return $this->smsRepository->AddNew_OutgoingSMS_Log($sms_id);
        }catch(\Exception $e){
            return null;
        }

    }

    public function GetNew_OutgoingSMS($device_code)
    {
        try{
            return $this->smsRepository->GetNew_OutgoingSMS($device_code);
        }catch(\Exception $e){
            return null;
        }
    }

    public function GetAll_OutgoingSMS(Campaign $campaign)
    {
        return $this->smsRepository->GetAll_OutgoingSMS($campaign);
    }

    public function Delete_OutgoingSMS(OutgoingSMS $outgoingSMS)
    {
        try{

        }catch(\Exception $e){
            return null;
        }
    }

    public function GetCampaigns_by_device_code($device_code)
    {
        try{
            return $this->smsRepository->GetCampaigns_by_device_code($device_code);
        }catch(\Exception $e){
            return null;
        }

    }

    public function GetCampaigns_by_name($name)
    {
        try{
            return $this->smsRepository->GetCampaigns_by_name($name);
        }catch(\Exception $e){
            return null;
        }
    }

    public function AddNew_Contact(Contact $contact)
    {
        try{
            return $this->smsRepository->AddNew_Contact($contact);
        }catch(\Exception $e){
            return null;
        }

    }

    public function Get_Contact($PhoneNum)
    {
        try{
            return $this->smsRepository->Get_Contact($PhoneNum);
        }catch(\Exception $e){
            return null;
        }
    }

    public function Process_Campaign_Request(){
        try{

            $Incomings = $this->GetAll_IncomingSMS_();
            if($Incomings != null){
                /**
                 * @var \Sync_SMS\Model\IncomingSMS $sms
                 */
                foreach($Incomings as $sms){
                    $msg = $sms->getSmsMsg();
                    $rex = explode(',',$msg);

                    if(count($rex) == 3){
                        if(strtolower($rex[0]) == 'reg' && strlen($rex[1])>1 && strlen($rex[2])>1){
                            $contact = new Contact();
                            $contact->setPhone($sms->getSmsFrom());
                            $contact->setFullName($rex[1]);
                            $this->AddNew_Contact($contact);
                            $_Contact = $this->Get_Contact($contact->getPhone());
                            if($_Contact != null){
                                /**
                                 * @var \Sync_SMS\Model\Contact $_contact_
                                 */
                                foreach($_Contact as $_contact_){
                                    $Campaigns = $this->GetCampaigns_by_name($rex[2]);
                                    if($Campaigns != null){
                                        /**
                                         * @var \Sync_SMS\Model\Campaign $_campaign_
                                         */
                                        foreach($Campaigns as $_campaign_){
                                            $state = $this->AddNew_CampaignContact($_contact_,$_campaign_);
                                            if($state){
                                                $new_outgoing = new OutgoingSMS();
                                                $new_outgoing->setCampaignId($_campaign_->getId());
                                                $new_outgoing->setUserId(1);
                                                $new_outgoing->setSmsTo($_contact_->getPhone());
                                                $new_outgoing->setSmsMsg("Hello ".$_contact_->getFullName()." Now you have successfully registered to ".$_campaign_->getName()." campaign");
                                                $new_outgoing->setUuid($sms->getSmsId());
                                                $this->AddNew_OutgoingSMS($new_outgoing);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }catch(\Exception $e){
            return null;
        }
    }

    public function Process_Campaign_Registration($device_code){
        try{
            $Incomings = $this->GetAll_IncomingSMS_();
            if($Incomings != null){
                /**
                 * @var \Sync_SMS\Model\IncomingSMS $sms
                 */
                foreach($Incomings as $sms){
                    $msg = $sms->getSmsMsg();
                    $rex = explode(',',$msg);
                    print_r($msg);
                    if(count($rex) == 2){
                        if(strtolower($rex[0]) == 'reg' && strlen($rex[1])>1){
                            $contact = new Contact();
                            $contact->setPhone($sms->getSmsFrom());
                            $contact->setFullName($rex[1]);
                            $state = $this->AddNew_Contact($contact);
                            if($state){
                                // if the contact is newly registered
                                $_Contact = $this->Get_Contact($contact->getPhone());
                                if($_Contact != null){
                                    /**
                                     * @var \Sync_SMS\Model\Contact $_contact_
                                     */
                                    foreach($_Contact as $_contact_){
                                        $Campaigns = $this->GetCampaigns_by_device_code($device_code);
                                        if($Campaigns != null){
                                            /**
                                             * @var \Sync_SMS\Model\Campaign $_campaign_
                                             */
                                            foreach($Campaigns as $_campaign_){
                                                $state = $this->AddNew_CampaignContact($_contact_,$_campaign_);
                                                if($state){
                                                    $new_outgoing = new OutgoingSMS();
                                                    $new_outgoing->setCampaignId($_campaign_->getId());
                                                    $new_outgoing->setUserId(1);
                                                    $new_outgoing->setSmsTo($_contact_->getPhone());
                                                    $new_outgoing->setSmsMsg("Hello ".$_contact_->getFullName()." Now you have successfully registered to ".$_campaign_->getName()." campaign");
                                                    $new_outgoing->setUuid($sms->getSmsId());
                                                    $this->AddNew_OutgoingSMS($new_outgoing);
                                                }
                                            }
                                        }
                                    }
                                }
                            }else{
                                // if the contact is already registered
                                $_Contact = $this->Get_Contact($contact->getPhone());
                                if($_Contact != null){
                                    /**
                                     * @var \Sync_SMS\Model\Contact $_contact_
                                     */
                                    foreach($_Contact as $_contact_){
                                        $Campaigns = $this->GetCampaigns_by_device_code($device_code);

                                        if($Campaigns != null){
                                            /**
                                             * @var \Sync_SMS\Model\Campaign $_campaign_
                                             */
                                            foreach($Campaigns as $_campaign_){

                                                $new_outgoing = new OutgoingSMS();
                                                $new_outgoing->setCampaignId($_campaign_->getId());
                                                $new_outgoing->setUserId(1);
                                                $new_outgoing->setSmsTo($_contact_->getPhone());
                                                $new_outgoing->setSmsMsg("Hello ".$_contact_->getFullName()." Now you are already registered to ".$_campaign_->getName()." campaign");
                                                $new_outgoing->setUuid($_contact_->getId());
                                                $this->AddNew_OutgoingSMS($new_outgoing);
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                }
            }
        }catch(\Exception $e){
            return null;
        }
    }

    public function AddNew_CampaignContact(Contact $contact, Campaign $campaign)
    {
        try{
            return $this->smsRepository->AddNew_CampaignContact($contact,$campaign);
        }catch(\Exception $e){
            return null;
        }
    }


}