<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 7:13 PM
 */

namespace SMS_API\Controller;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class smsController extends AbstractRestfulController
{
    protected $api_Response;
    protected $api_Services = array('GetAllIncomingSMS','GetAllOutgoingSMS','GetIncomingSMS','GetOutgoingSMS','NewOutgoing','AddUser','NewIncoming');
    protected $api_Param;
    protected $api_CompanyID;
    protected $user;
    /**
     * @var \SMS_API\Model\SyncDevice $syncDevice
     */
    protected $syncDevice;
    public function Authenticate($data){
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        if($smsService->authenticate($data['User_Name'],$data['User_Pass'])){
            $this->user = new User();
            $this->user->setUserName($data['User_Name']);
            $this->user->setUserPass($data['User_Pass']);
            return true;
        }
        $error['Authentication'] = 'Invalid User';
        $this->api_Response['Request_Error'] = $error;
        return false;
    }
    public function getList()
    {
        if($this->isValidRequest($_GET)){
            if($this->Authenticate($_GET)){

            }
        }
        return new JsonModel($this->api_Response);
    }
    public function create($data)
    {
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        if($this->isValidRequest($data)){
            if($this->Authenticate($data)){
                if($data['Service'] == 'GetAllIncomingSMS'){
                    $IncomingSMS = $smsService->getAllIncoming($this->user);
                    $this->api_Response['Response'] = $IncomingSMS;
                }else if($data['Service'] == 'GetAllOutgoingSMS'){
                    $OutgoingSMS = $smsService->getAllOutgoing($this->user);
                    $this->api_Response['Response'] = $OutgoingSMS;
                }else if($data['Service'] == 'GetRole'){
                    $UserComeRole = $smsService->getComRole($this->user);
                    $this->api_Response['Response'] = $UserComeRole;
                }else if($data['Service'] == 'AddUser'){
                    $new_user = new User();
                    $new_user->setUserName('');
                    $new_user->setUserPass('Pass');
                    $UserComeRole = $smsService->addUser($new_user);
                    $this->api_Response['Response'] = $UserComeRole;
                }else if($data['Service'] == 'NewIncoming'){
                    $newIncoming = $smsService->getNewIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == 'NewOutgoing'){
                    $newOutgoing = $smsService->getNewOutgoing($this->user);
                    $this->api_Response['Response'] = $newOutgoing;
                }
            }
        }else if($this->isValidSyncDevice($data)){
            $new_sms = new IncomingSMS();
            $new_sms->setSmsId($data['message_id']);
            $new_sms->setCompanyId($this->syncDevice->getCompanyID());
            $new_sms->setSmsTo($data['sent_to']);
            $new_sms->setSmsFrom($data['from']);
            $new_sms->setSmsMsg($data['message']);
            $newIncoming = $smsService->saveIncoming($new_sms);
        }
        return new JsonModel($this->api_Response);
    }
    public function isValidSyncDevice($api_request){
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        $this->api_Response['Request_Error'] = array();
        if(isset($api_request['secret']) && isset($api_request['from']) && isset($api_request['sent_to'])
            && isset($api_request['message'])&& isset($api_request['message_id']) && isset($api_request['device_id'])){
            $this->syncDevice = new SyncDevice();
            $this->syncDevice->setDeviceID($api_request['device_id']);
            $this->syncDevice->setSecretNo($api_request['secret']);
            return true;
        }else{
            $error['Device_Request'] = 'Not known';
            $this->api_Response['Request_Error'] = $error;
            return false;
        }
    }
    public function isValidRequest($api_request){
        $this->api_Response['Request_Error'] = array();
        if(isset($api_request['User_Name']) && isset($api_request['User_Pass'])
            && isset($api_request['Service']) && isset($api_request['Param'])
        ){
            if(in_array($api_request['Service'],$this->api_Services)){
                    return true;
            }else{
                $error['Service_Request'] = 'Unknown';
                $this->api_Response['Request_Error'] = $error;
            }
        }else{
            $error['Request_Format'] = 'Invalid';
            $this->api_Response['Request_Error'] = $error;
        }

        return false;
    }
    public function addUser($data){
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