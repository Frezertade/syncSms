<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 6:51 AM
 */

namespace Sync_SMS\Model;


class IncomingSMS
{
    protected $id;
    protected $sms_id;
    protected $campaign_id;
    protected $sms_from;
    protected $sms_msg;
    protected $sms_to;
    protected $created;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSmsId()
    {
        return $this->sms_id;
    }

    /**
     * @param mixed $sms_id
     */
    public function setSmsId($sms_id)
    {
        $this->sms_id = $sms_id;
    }

    /**
     * @return mixed
     */
    public function getCampaignId()
    {
        return $this->campaign_id;
    }

    /**
     * @param mixed $campaign_id
     */
    public function setCampaignId($campaign_id)
    {
        $this->campaign_id = $campaign_id;
    }

    /**
     * @return mixed
     */
    public function getSmsFrom()
    {
        return $this->sms_from;
    }

    /**
     * @param mixed $sms_from
     */
    public function setSmsFrom($sms_from)
    {
        $this->sms_from = $sms_from;
    }

    /**
     * @return mixed
     */
    public function getSmsMsg()
    {
        return $this->sms_msg;
    }

    /**
     * @param mixed $sms_msg
     */
    public function setSmsMsg($sms_msg)
    {
        $this->sms_msg = $sms_msg;
    }

    /**
     * @return mixed
     */
    public function getSmsTo()
    {
        return $this->sms_to;
    }

    /**
     * @param mixed $sms_to
     */
    public function setSmsTo($sms_to)
    {
        $this->sms_to = $sms_to;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return array
     */
    public function getArray(){
        return array(
            'id' => $this->getId(),
            'sms_id' => $this->getSmsId(),
            'campaign_id' => $this->getCampaignId(),
            'sms_from' => $this->getSmsFrom(),
            'sms_msg' => $this->getSmsMsg(),
            'sms_to' => $this->getSmsTo(),
            'created' => $this->getCreated(),
        );
    }

}