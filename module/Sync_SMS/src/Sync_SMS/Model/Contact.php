<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/20/2016
 * Time: 4:54 AM
 */

namespace Sync_SMS\Model;


class Contact
{
    protected $id;
    protected $full_name;
    protected $Phone;
    protected $created;
    protected $updated;

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
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param mixed $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
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
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
    /**
     * @return array
     */
    public function getArray(){
        return array(
            'id' => $this->getId(),
            'full_name' => $this->getFullName(),
            'phone_number' => $this->getPhone(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
        );
    }

}