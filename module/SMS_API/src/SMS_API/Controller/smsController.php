<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 7:13 PM
 */

namespace SMS_API\Controller;


use SMS_API\Model\IncomingSMS;
use SMS_API\Model\OutgoingSMS;
use SMS_API\Model\SyncDevice;
use SMS_API\Model\User;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class smsController extends AbstractRestfulController
{
    protected $api_Response;
    protected $api_Services = array(
        'GetAllIncomingSMS','GetAllOutgoingSMS','GetNewIncomingSMS','GetAllDeliveredSMS','GetAllNotDeliveredSMS','GetNewOutgoingSMS',
        'DeleteAllIncomingSMS','DeleteAllOutgoingSMS','DeleteAllDeliveredSMS','DeleteAllNotDeliveredSMS',
        'DeleteIncomingSMS','DeleteOutgoingSMS','DeleteDeliveredSMS','DeleteNotDeliveredSMS',
        'AddNewOutgoingSMS','AddNewIncomingSMSLog','AddNewOutgoingSMSLog');
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
       // return new JsonModel($this->api_Response);
    }
    public function create($data)
    {
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        if($this->isValidRequest($data)){
            if($this->Authenticate($data)){
                if($data['Service'] == $this->api_Services[0]){
                    $IncomingSMS = $smsService->getAllIncoming($this->user);
                    $this->api_Response['Response'] = $IncomingSMS;
                }else if($data['Service'] == $this->api_Services[1]){
                    $OutgoingSMS = $smsService->getAllOutgoing($this->user);
                    $this->api_Response['Response'] = $OutgoingSMS;
                }else if($data['Service'] == $this->api_Services[2]){
                    $newIncoming = $smsService->getNewIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[3]){
                    $newIncoming = $smsService->getNewIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[4]){
                    $newIncoming = $smsService->getNewIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[5]){
                    $newIncoming = $smsService->getNewOutgoing($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[6]){
                    $newIncoming = $smsService->deleteAllIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[7]){
                    $newIncoming = $smsService->deleteAllOutgoing($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[8]){
                    $newIncoming = $smsService->deleteAllIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[9]){
                    $newIncoming = $smsService->deleteAllIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[10]){
                    if($this->isValidParam($data['Param'],$data['Service'])){
                        $response = null;
                        foreach($data['Param'] as $param){
                            $incomingSMS = new IncomingSMS();
                            $incomingSMS->setId($param['id']);
                            $response[] = $smsService->deleteIncoming($this->user,$incomingSMS);
                        }
                        $this->api_Response['Response'] = $response;
                    }
                }else if($data['Service'] == $this->api_Services[11]){
                    if($this->isValidParam($data['Param'],$data['Service'])){
                        $response = null;
                        foreach($data['Param'] as $param){
                            $outgoingSMS = new OutgoingSMS();
                            $outgoingSMS->setId($param['id']);
                            $response[] = $smsService->deleteOutgoing($this->user,$outgoingSMS);
                        }
                        $this->api_Response['Response'] = $response;
                    }
                }else if($data['Service'] == $this->api_Services[12]){
                    $newIncoming = $smsService->deleteAllIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[13]){
                    $newIncoming = $smsService->deleteAllIncoming($this->user);
                    $this->api_Response['Response'] = $newIncoming;
                }else if($data['Service'] == $this->api_Services[14]){
                    if($this->isValidParam($data['Param'],$data['Service'])){
                        $response = null;
                        foreach($data['Param'] as $param){
                            $outgoingSMS = new OutgoingSMS();
                            $outgoingSMS->setSmsMsg($param['sms_msg']);
                            $outgoingSMS->setSmsTo($param['sms_to']);
                            $response[] = $smsService->saveOutgoing($this->user,$outgoingSMS);
                        }
                        $this->api_Response['Response'] = $response;
                    }
                }else if($data['Service'] == $this->api_Services[15]){
                    if($this->isValidParam($data['Param'],$data['Service'])){
                        $response = null;
                        foreach($data['Param'] as $param){
                            $incomingSMS = new IncomingSMS();
                            $incomingSMS->setId($param['id']);
                            $response[] = $smsService->saveIncomingLog($this->user,$incomingSMS);
                        }
                        $this->api_Response['Response'] = $response;
                    }
                }else if($data['Service'] == $this->api_Services[16]){
                    if($this->isValidParam($data['Param'],$data['Service'])){
                        $response = null;
                        foreach($data['Param'] as $param){
                            $outgoingSMS = new OutgoingSMS();
                            $outgoingSMS->setId($param['id']);
                            $response[] = $smsService->saveOutgoing($this->user,$outgoingSMS);
                        }
                        $this->api_Response['Response'] = $response;
                    }
                }
            }
        }else if(isset($data['device_id']) && $this->isValidSyncDevice($data)){
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
    public function isValidParam($param,$type){
        $is_valid = false;
        if(!is_array($param)){
            if($type == $this->api_Services[10]){
                foreach($param as $items){
                    if(isset($items['id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid Incoming SMS Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[11]){
                foreach($param as $items){
                    if(isset($items['id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid Outgoing SMS Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[12]){
                foreach($param as $items){
                    if(isset($items['id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid Delivered SMS Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[13]){
                foreach($param as $items){
                    if(isset($items['id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid Delivered Not SMS Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[14]){
                foreach($param as $items){
                    if(isset($items['sms_msg']) && isset($items['sms_to'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid Outgoing Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[15]){
                foreach($param as $items){
                    if(isset($items['incoming_sms_id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid IncomingSMSLog Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }elseif($type == $this->api_Services[16]){
                foreach($param as $items){
                    if(isset($items['outgoing_sms_id'])){
                        $is_valid = true;
                    }else{
                        $error['Parameter Error'] = 'Invalid OutgoingSMSLog Param';
                        $this->api_Response['Request_Error'] = $error;
                        $is_valid = false;
                        break;
                    }
                }
            }
        }else{
            $error['Parameter Error'] = 'The parameter should be an array';
            $this->api_Response['Request_Error'] = $error;
        }

        return $is_valid;
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