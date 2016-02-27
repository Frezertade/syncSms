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
    protected $api_Response;
    protected $api_Services = array('GetAllIncomingSMS','GetAllOutgoingSMS','GetIncomingSMS','GetOutgoingSMS');
    protected $api_Param;
    protected $api_CompanyID;
    public function Authenticate($data){
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        if($smsService->authenticate($data['User_Name'],$data['User_Pass'])){
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
                    $Found = $smsService->getAllIncoming($this->api_CompanyID);
                    $this->api_Response['Response'] = $Found;
                }
            }
        }
        return new JsonModel($this->api_Response);
    }
    public function isValidRequest($api_request){
        $this->api_Response['Request_Error'] = array();
        if(isset($api_request['User_Name']) && isset($api_request['User_Pass'])
            && isset($api_request['Company_Code'])
            && isset($api_request['Service']) && isset($api_request['Param'])
        ){
            if(in_array($api_request['Service'],$this->api_Services)){
                if(strlen($api_request['Company_Code']) == 8){
                    $this->api_CompanyID = $api_request['Company_Code'];
                    return true;
                }else{
                    $error['Company_Code'] = 'Invalid';
                    $this->api_Response['Request_Error'] = $error;
                }
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