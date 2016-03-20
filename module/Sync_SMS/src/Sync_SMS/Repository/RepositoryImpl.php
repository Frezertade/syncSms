<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 6:46 AM
 */

namespace Sync_SMS\Repository;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\Company;
use Sync_SMS\Model\Contact;
use Sync_SMS\Model\Device;
use Sync_SMS\Model\Hydrator;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Sync_SMS\Model\User;
use Zend\Db\Adapter\AdapterAwareTrait;

class RepositoryImpl implements RepositoryInterface
{
    use AdapterAwareTrait;

    public function AddNew_IncomingSMS(IncomingSMS $incomingSMS)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'sms_id'=>$incomingSMS->getSmsId(),
                'campaign_id'=>$incomingSMS->getCampaignId(),
                'sms_from'=>$incomingSMS->getSmsFrom(),
                'sms_msg'=>$incomingSMS->getSmsMsg(),
                'sms_to'=>$incomingSMS->getSmsTo(),
            ))
            ->into('incoming_sms');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

    public function AddNew_IncomingSMS_Log($sms_id)
    {
        // TODO: Implement AddNew_IncomingSMS_Log() method.
    }

    public function GetNew_IncomingSMS(Campaign $campaign)
    {
        // TODO: Implement GetNew_IncomingSMS() method.
    }

    public function GetAll_IncomingSMS_()
    {
        $row_sql = 'SELECT * FROM incoming_sms';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new IncomingSMS());
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
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'user_id'=>$outgoingSMS->getUserId(),
                'campaign_id'=>$outgoingSMS->getCampaignId(),
                'uuid'=>$outgoingSMS->getUuid(),
                'sms_to'=>$outgoingSMS->getSmsTo(),
                'sms_msg'=>$outgoingSMS->getSmsMsg(),
            ))
            ->into('outgoing_sms');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

    public function AddNew_OutgoingSMS_Log($sms_id)
    {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'outgoing_sms_id'=>$sms_id,
            ))
            ->into('outgoing_sms_log');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }


    public function GetNew_OutgoingSMS($device_code)
    {
        $row_sql = 'SELECT * FROM outgoing_sms WHERE outgoing_sms.id NOT IN (SELECT outgoing_sms_log.outgoing_sms_id FROM outgoing_sms_log ) AND outgoing_sms.campaign_id IN( SELECT campaign.id FROM campaign WHERE campaign.company_id IN(SELECT company_device.company_id FROM company_device WHERE company_device.device_id IN (SELECT devices.id FROM devices WHERE devices.device_code = \''.$device_code.'\')))';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new OutgoingSMS());
    }

    public function GetAll_OutgoingSMS(Campaign $campaign)
    {
        // TODO: Implement GetAll_OutgoingSMS() method.
    }

    public function Delete_OutgoingSMS(OutgoingSMS $outgoingSMS)
    {
        // TODO: Implement Delete_OutgoingSMS() method.
    }

    public function GetCampaigns(Device $device)
    {
        $row_sql = 'SELECT * FROM campaign WHERE campaign.id IN( SELECT company_device.campaign_id FROM company_device WHERE company_device.device_id'.$device->getId().' )';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Campaign());
    }

    public function GetCampaigns_by_user(User $user)
    {
        $row_sql = 'SELECT * FROM campaign WHERE campaign.company_id IN( SELECT role_linker.company_id FROM role_linker WHERE role_linker.user_id'.$user->getId().')';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Campaign());
    }

    public function GetCampaigns_by_name($name)
    {
        $row_sql = 'SELECT * FROM campaign WHERE campaign.name = \''.$name.'\'';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Campaign());
    }

    public function GetCampaigns_by_device_code($device_code)
    {
        $row_sql = 'SELECT * FROM campaign WHERE campaign.company_id IN( SELECT company_device.company_id FROM company_device WHERE company_device.device_id IN ( SELECT devices.id FROM devices WHERE devices.device_code = \''.$device_code.'\' ))';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Campaign());
    }

    public function GetCompanies(User $user)
    {
        $row_sql = 'SELECT * FROM company WHERE company.id IN( SELECT role_linker.company_id FROM role_linker WHERE role_linker.user_id'.$user->getId().' )';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Company());
    }

    public function GetDevice($device_code)
    {
        // TODO: Implement GetDevice() method.
    }

    public function Get_Contact($PhoneNum)
    {
        $row_sql = 'SELECT * FROM contacts WHERE contacts.phone_number = '.$PhoneNum;
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Contact());
    }

    public function AddNew_Contact(Contact $contact)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'full_name'=>$contact->getFullName(),
                'phone_number'=>$contact->getPhone(),
            ))
            ->into('contacts');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

    public function AddNew_CampaignContact(Contact $contact, Campaign $campaign)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'campaign_id'=>$campaign->getId(),
                'contact_id'=>$contact->getId(),
            ))
            ->into('campaign_contacts');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }


}