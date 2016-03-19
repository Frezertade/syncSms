<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 6:57 AM
 */

namespace Sync_SMS\Model;


class OutgoingSMS
{
    protected $id;
    protected $user_id;
    protected $campaign_id;
    protected $uuid;
    protected $sms_to;
    protected $sms_msg;
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
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
            'user_id' => $this->getUserId(),
            'campaign_id' => $this->getCampaignId(),
            'uuid' => $this->getUuid(),
            'sms_to' => $this->getSmsTo(),
            'sms_msg' => $this->getSmsMsg(),
            'created' => $this->getCreated(),
        );
    }
}