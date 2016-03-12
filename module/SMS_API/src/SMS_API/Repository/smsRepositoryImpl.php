<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:44 PM
 */

namespace SMS_API\Repository;


use SMS_API\Model\Company;
use SMS_API\Model\Hydrator;
use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use SMS_API\Model\UserComRole;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\AdapterAwareTrait;

class smsRepositoryImpl implements smsRepository
{
    use AdapterAwareTrait;
    public function saveIncoming(IncomingSMS $sms)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'sms_id'=>$sms->getSmsId(),
                'company_id'=>$sms->getCompanyId(),
                'device_id'=>$sms->getDeviceId(),
                'sms_msg'=>$sms->getSmsMsg(),
                'sms_from'=>$sms->getSmsFrom(),
                'sms_to'=>$sms->getSmsTo(),
            ))
            ->into('incoming_sms');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

    public function getOutgoingSMS(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select()
            ->from(array('p'=>'incoming_sms'))
            ->where('p.username?')
            ->order('p.id DESC');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
    }

    public function isValidUser(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('user');
        $select->where(array('user_name'=>$user->getUserName(),'user_pass'=>$user->getUserPass()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        if($result->count() == 1){
            return true;
        }else{
            return false;
        }
    }
    public function isValidDevice(SyncDevice $device)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('devices');
        $select->where(array('secret_num'=>$device->getSecretNo()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        if($result->count() == 1){
            return true;
        }else{
            return false;
        }
    }
    public function getAuthenticationAdapter(){
        $callback = function($encryptedPassword,$clearTextPassword){
            $encrypter = new Bcrypt();
            $encrypter->setCost(12);
            return $encrypter->verify($clearTextPassword,$encryptedPassword);
        };
        $authenticationAdapter = new \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter(
            $this->adapter,
            'users',
            'user_name',
            'user_pass',
            $callback
        );
        return $authenticationAdapter;
    }

    public function addUser(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'user_name'=>$user->getUserName(),
                'user_pass'=>$this->Encrypt($user->getUserPass()),
            ))
            ->into('users');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result;
    }
    public function Encrypt($password){
        $encrypter = new Bcrypt();
        $encrypter->setCost(12);
        return $encrypter->create($password);
    }

    public function saveOutgoing(OutgoingSMS $sms)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'company_id'=>$sms->getCompanyId(),
                'user_id'=>$sms->getUserId(),
                'sms_from'=>$sms->getSmsFrom(),
                'sms_msg'=>$sms->getSmsMsg(),
                'sms_to'=>$sms->getSmsTo(),
            ))
            ->into('outgoing_sms');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result;
    }

    public function getAllIncoming(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('incoming_sms');
        $select->where(array('company_id'=>$this->getComRole($user)->getCompanyID()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $posts = '';
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Extract($posts,new IncomingSMS());
    }

    public function getAllOutgoing(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('outgoing_sms');
        $select->where(array('company_id'=>$this->getComRole($user)->getCompanyID()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $posts = '';
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Extract($posts,new OutgoingSMS());
    }

    public function getNewIncoming(User $user)
    {
        $row_sql = 'SELECT * FROM incoming_sms WHERE incoming_sms.id NOT IN( SELECT incoming_sms_log.incoming_sms_id FROM incoming_sms_log ) AND incoming_sms.company_id = '.$this->getComRole($user)->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Extract($posts,new IncomingSMS());
    }

    public function getNewOutgoing(User $user)
    {
        $row_sql = 'SELECT * FROM outgoing_sms WHERE outgoing_sms.id NOT IN( SELECT outgoing_sms_log.outgoing_sms_id FROM outgoing_sms_log ) AND outgoing_sms.company_id = '.$this->getComRole($user)->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Extract($posts,new OutgoingSMS());
    }
    /**
     * @param User $user
     * @return \SMS_API\Model\UserComRole
     */
    public function getComRole(User $user)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from(array('U'=>'users'));
        $select->join(array('R'=>'user_com_role'),'U.id = R.user_id');
        $select->where(array('user_name'=>$user->getUserName()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new UserComRole());
    }

    /**
     * save all incoming sms logs
     *
     * @param User $user
     * @param \SMS_API\Model\IncomingSMS $sms
     */
    public function saveIncomingLog(User $user, IncomingSMS $sms)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'incoming_sms_id'=>$sms->getId(),
                'company_id'=>$this->getComRole($user)->getCompanyID(),
            ))
            ->into('incoming_sms_log');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
    }

    /**
     * @param User $user
     * @param \SMS_API\Model\OutgoingSMS $sms
     */
    public function saveOutgoingLog(User $user, OutgoingSMS $sms)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'outgoing_sms_id'=>$sms->getId(),
                'company_id'=>$this->getComRole($user)->getCompanyID(),
            ))
            ->into('outgoing_sms_log');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
    }

    /**
     * @param Company $company
     * @return \SMS_API\Model\Company
     */
    public function getCompany(Company $company)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from(array('U'=>'company'));
        $select->where(array('secret_num'=>$company->getSecret()));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrator();
        return $hydrator->Hydrate($posts,new Company());
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @param \SMS_API\Model\IncomingSMS $sms
     * @return bool
     */
    public function deleteIncoming(UserComRole $user_r, IncomingSMS $sms)
    {
        $row_sql = 'DELETE FROM incoming_sms WHERE id='.$sms->getId().' AND company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return bool
     */
    public function deleteOutgoing(UserComRole $user_r, OutgoingSMS $sms)
    {
        $row_sql = 'DELETE FROM outgoing_sms WHERE id='.$sms->getId().' AND company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @param \SMS_API\Model\IncomingSMS $sms
     * @return bool
     */
    public function deleteIncomingLog(UserComRole $user_r, IncomingSMS $sms)
    {
        $row_sql = 'DELETE FROM incoming_sms_log WHERE id='.$sms->getId().' AND company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @param \SMS_API\Model\OutgoingSMS $sms
     * @return bool
     */
    public function deleteOutgoingLog(UserComRole $user_r, OutgoingSMS $sms)
    {
        $row_sql = 'DELETE FROM outgoing_sms_log WHERE id='.$sms->getId().' AND company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @return bool
     */
    public function deleteAllIncoming(UserComRole $user_r)
    {
        $row_sql = 'DELETE FROM incoming_sms WHERE company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @return bool
     */
    public function deleteAllOutgoing(UserComRole $user_r)
    {
        $row_sql = 'DELETE FROM outgoing_sms WHERE company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @return bool
     */
    public function deleteAllIncomingLog(UserComRole $user_r)
    {
        $row_sql = 'DELETE FROM incoming_sms_log WHERE company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param \SMS_API\Model\UserComRole $user_r
     * @return bool
     */
    public function deleteAllOutgoingLog(UserComRole $user_r)
    {
        $row_sql = 'DELETE FROM outgoing_sms_log WHERE company_id='.$user_r->getCompanyID();
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            return true;
        }else{
            return false;
        }
    }


}