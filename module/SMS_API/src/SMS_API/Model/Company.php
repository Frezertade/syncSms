<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/2/2016
 * Time: 10:53 AM
 */

namespace SMS_API\Model;


class Company
{
    protected $id;
    protected $name;
    protected $secret;
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
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
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

    public function getArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'secret' => $this->getSecret(),
            'created' => $this->getCreated(),
        );
    }
}