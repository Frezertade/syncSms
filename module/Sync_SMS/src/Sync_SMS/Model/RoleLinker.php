<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/19/2016
 * Time: 7:23 AM
 */

namespace Sync_SMS\Model;


class RoleLinker
{
    protected $id;
    protected $user_id;
    protected $company_id;
    protected $role_id;
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
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
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
            'company_id' => $this->getCompanyId(),
            'role_id' => $this->getRoleId(),
            'created' => $this->getCreated(),
        );
    }

}