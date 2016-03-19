<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:58 AM
 */

namespace Sync_SMS\Model;


class Device
{
    protected $id;
    protected $name;
    protected $secret_code;
    protected $phone_number;
    protected $description;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSecretCode()
    {
        return $this->secret_code;
    }

    /**
     * @param mixed $secret_code
     */
    public function setSecretCode($secret_code)
    {
        $this->secret_code = $secret_code;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
            'name' => $this->getName(),
            'secret_code' => $this->getSecretCode(),
            'phone_number' => $this->getPhoneNumber(),
            'description' => $this->getDescription(),
            'created' => $this->getCreated(),
        );
    }

}