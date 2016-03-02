<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/1/2016
 * Time: 11:24 PM
 */

namespace SMS_API\Model;


class UserComRole
{
    protected $id;
    protected $User_ID;
    protected $Company_ID;
    protected $Role;
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
    public function getUserID()
    {
        return $this->User_ID;
    }

    /**
     * @param mixed $User_ID
     */
    public function setUserID($User_ID)
    {
        $this->User_ID = $User_ID;
    }

    /**
     * @return mixed
     */
    public function getCompanyID()
    {
        return $this->Company_ID;
    }

    /**
     * @param mixed $Company_ID
     */
    public function setCompanyID($Company_ID)
    {
        $this->Company_ID = $Company_ID;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * @param mixed $Role
     */
    public function setRole($Role)
    {
        $this->Role = $Role;
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

    public function getArray(){
        return array(
            'id' => $this->getId(),
            'user_id' => $this->getUserID(),
            'company_id' => $this->getCompanyID(),
            'role' => $this->getRole(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
        );
    }

}