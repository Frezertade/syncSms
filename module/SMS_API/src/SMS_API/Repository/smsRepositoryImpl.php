<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 8:44 PM
 */

namespace SMS_API\Repository;


use SMS_API\Model\Hydrator\OutgoingSMSHydrator;
use SMS_API\Model\Hydrator\UserHydrator;
use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\User;
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
        print_r($resultSet);


       // print_r($result);
    }

}