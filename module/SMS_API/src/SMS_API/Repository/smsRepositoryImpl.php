<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:44 PM
 */

namespace SMS_API\Repository;


use SMS_API\Model\Hydrator\IncomingSMSHydrator;
use SMS_API\Model\Hydrator\OutgoingSMSHydrator;
use SMS_API\Model\Hydrator\UserHydrator;
use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SMSLog;
use SMS_API\Model\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class smsRepositoryImpl implements smsRepository
{
    use AdapterAwareTrait;


    public function saveIncoming(IncomingSMS $sms)
    {
        // TODO: Implement saveIncoming() method.
    }

    public function getOutgoingSMS($device_id)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->columns(array(
            'id',
            'company_id',
            'user_id',
            'sms_msg',
            'sms_to',
            'sms_from',
            'created',
        ))
            ->from(array('p'=>'incoming_sms'))
            ->where('p.username?')
            ->order('p.id DESC');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
    }

    public function isValidUser($userName, $password)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('user');
        $select->where(array('user_name'=>$userName,'user_pass'=>$password));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $hydrator = new AggregateHydrator();
        $hydrator->add(new UserHydrator());
        $resultSet = new HydratingResultSet($hydrator, new User());
        $resultSet->initialize($result);
        $posts = array();

        foreach($resultSet as $post){
            $posts[] = $post;
        }
        if(sizeof($posts) == 1){
            return 1;
        }
        return 0;
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
    }

    public function getAllIncoming($CompanyID)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('incoming_sms');
        $select->where(array('company_id'=>$CompanyID));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $hydrator = new AggregateHydrator();
        $hydrator->add(new IncomingSMSHydrator());
        $resultSet = new HydratingResultSet($hydrator, new IncomingSMS());
        $resultSet->initialize($result);
        $posts = array();
        foreach($resultSet as $post){
            $posts[] = $post;
        }
        return $posts;
    }

    public function getAllOutgoing($CompanyID)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $select = $sql->select();
        $select->from('outgoing_sms');
        $select->where(array('company_id'=>$CompanyID));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $hydrator = new AggregateHydrator();
        $hydrator->add(new OutgoingSMSHydrator());
        $resultSet = new HydratingResultSet($hydrator, new OutgoingSMS());
        $resultSet->initialize($result);
        $posts = array();
        foreach($resultSet as $post){
            $posts[] = $post;
        }
        return $posts;
    }

    public function getNewIncoming($CompanyID)
    {
        // TODO: Implement getNewIncoming() method.
    }

    public function saveSMSLog(SMSLog $sms)
    {
        // TODO: Implement saveSMSLog() method.
    }


}