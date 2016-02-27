<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:50 PM
 */

namespace SMS_API\Model;


class IncomingSMS
{
    /**
     * @var int
     */
    protected $compny_id;
    /**
     * @var int
     */
    protected $user_id;
    /**
     * @var string
     */
    protected $device_id;
    /**
     * @var string
     */
    protected $sms_id;
    /**
     * @var string
     */
    protected $sms_msg;
    /**
     * @var string
     */
    protected $sms_from;
    /**
     * @var string
     */
    protected $sms_to;

    /**
     * @return int
     */
    public function getCompnyId()
    {
        return $this->compny_id;
    }

    /**
     * @param int $compny_id
     */
    public function setCompnyId($compny_id)
    {
        $this->compny_id = $compny_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * @param string $device_id
     */
    public function setDeviceId($device_id)
    {
        $this->device_id = $device_id;
    }

    /**
     * @return string
     */
    public function getSmsId()
    {
        return $this->sms_id;
    }

    /**
     * @param string $sms_id
     */
    public function setSmsId($sms_id)
    {
        $this->sms_id = $sms_id;
    }

    /**
     * @return string
     */
    public function getSmsMsg()
    {
        return $this->sms_msg;
    }

    /**
     * @param string $sms_msg
     */
    public function setSmsMsg($sms_msg)
    {
        $this->sms_msg = $sms_msg;
    }

    /**
     * @return string
     */
    public function getSmsFrom()
    {
        return $this->sms_from;
    }

    /**
     * @param string $sms_from
     */
    public function setSmsFrom($sms_from)
    {
        $this->sms_from = $sms_from;
    }

    /**
     * @return string
     */
    public function getSmsTo()
    {
        return $this->sms_to;
    }

    /**
     * @param string $sms_to
     */
    public function setSmsTo($sms_to)
    {
        $this->sms_to = $sms_to;
    }



}