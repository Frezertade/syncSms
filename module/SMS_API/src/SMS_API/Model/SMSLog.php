<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/27/2016
 * Time: 1:59 AM
 */

namespace SMS_API\Model;


class SMSLog
{
    protected $id;
    protected $sms_id;
    protected $company_id;
    protected $type;

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
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @param mixed $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}