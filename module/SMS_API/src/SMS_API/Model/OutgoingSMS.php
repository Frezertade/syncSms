<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 10:44 PM
 */

namespace SMS_API\Model;


class OutgoingSMS
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $company_id;
    /**
     * @var int
     */
    protected $user_id;
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
     * @var string
     */
    protected $created;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @param int $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
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

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    public function getArray(){
        return array(
            'id'=>$this->getId(),
            'company_id' => $this->getCompanyId(),
            'user_id' => $this->getUserId(),
            'sms_msg' => $this->getSmsMsg(),
            'sms_to' => $this->getSmsTo(),
            'sms_from' => $this->getSmsFrom(),
            'created' => $this->getCreated(),
        );
    }

}