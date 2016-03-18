<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/17/2016
 * Time: 9:22 PM
 */

namespace Mobile_API\Model;


class Testimony
{
    protected $id;
    protected $Full_Name;
    protected $Testimony;
    protected $GPS;
    protected $IMEI;

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
    public function getFullName()
    {
        return $this->Full_Name;
    }

    /**
     * @param mixed $Full_Name
     */
    public function setFullName($Full_Name)
    {
        $this->Full_Name = $Full_Name;
    }

    /**
     * @return mixed
     */
    public function getTestimony()
    {
        return $this->Testimony;
    }

    /**
     * @param mixed $Testimony
     */
    public function setTestimony($Testimony)
    {
        $this->Testimony = $Testimony;
    }

    /**
     * @return mixed
     */
    public function getGPS()
    {
        return $this->GPS;
    }

    /**
     * @param mixed $GPS
     */
    public function setGPS($GPS)
    {
        $this->GPS = $GPS;
    }

    /**
     * @return mixed
     */
    public function getIMEI()
    {
        return $this->IMEI;
    }

    /**
     * @param mixed $IMEI
     */
    public function setIMEI($IMEI)
    {
        $this->IMEI = $IMEI;
    }


}