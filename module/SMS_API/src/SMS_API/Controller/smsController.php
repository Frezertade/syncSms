<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 7:13 PM
 */

namespace SMS_API\Controller;


use SMS_API\Model\User;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class smsController extends AbstractRestfulController
{
    protected $api_response;
    public function Authenticate($data){
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        if($smsService->authenticate($data['user_name'],$data['user_pass'])){
            $this->api_response['Authentication'] = 'Success';
            return true;
        }
        $this->api_response['Authentication'] = 'Failed';
        return false;
    }
    public function getList()
    {
        $this->api_response['Request_Time'] = time();
        if($this->isValidRequest($_GET)){
            if($this->Authenticate($_GET)){

            }
        }
        $this->api_response['Response_Time'] = time();
        return new JsonModel($this->api_response);
    }
    public function create($data)
    {
        $this->api_response['Request_Time'] = time();
        if($this->isValidRequest($data)){
            if($this->Authenticate($data)){

            }
        }
        $this->api_response['Response_Time'] = time();
        return new JsonModel($this->api_response);
    }
    public function isValidRequest($api_request){
        if(isset($api_request['user_name']) && isset($api_request['user_pass']) && isset($api_request['service']) && isset($api_request['param'])){
            $this->api_response['Request'] = 'Valid';
            return true;
        }
        $this->api_response['Request'] = 'Invalid';
        return false;
    }
    public function addUser(){
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        $user = new User();
        $user->setUserName($data['user_name']);
        $user->setUserPass($data['user_pass']);
        $smsService->addUser($user);
    }
}