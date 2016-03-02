<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/2/2016
 * Time: 9:34 AM
 */

namespace SMS_API\Model;


class SyncDevice
{
    protected $DeviceID;
    protected $SecretNo;
    protected $CompanyID;

    /**
     * @return mixed
     */
    public function getDeviceID()
    {
        return $this->DeviceID;
    }

    /**
     * @param mixed $DeviceID
     */
    public function setDeviceID($DeviceID)
    {
        $this->DeviceID = $DeviceID;
    }

    /**
     * @return mixed
     */
    public function getSecretNo()
    {
        return $this->SecretNo;
    }

    /**
     * @param mixed $SecretNo
     */
    public function setSecretNo($SecretNo)
    {
        $this->SecretNo = $SecretNo;
    }

    /**
     * @return mixed
     */
    public function getCompanyID()
    {
        return $this->CompanyID;
    }

    /**
     * @param mixed $CompanyID
     */
    public function setCompanyID($CompanyID)
    {
        $this->CompanyID = $CompanyID;
    }


}