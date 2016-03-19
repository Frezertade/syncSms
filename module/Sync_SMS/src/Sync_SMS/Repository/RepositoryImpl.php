<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 6:46 AM
 */

namespace Sync_SMS\Repository;


use Sync_SMS\Model\Campaign;
use Sync_SMS\Model\Device;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
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
        return $hydrator->Extract($posts,new IncomingSMS());
    }


}