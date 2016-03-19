<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS
 * Date: 3/19/16
 * Time: 4:32 PM
 */

namespace Sync_SMS\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class smsController extends AbstractRestfulController
{
    protected $api_Response;
    protected $api_Services = array(
        'AddNew_IncomingSMS','GetAllOutgoingSMS','GetNewIncomingSMS','GetAllDeliveredSMS','GetAllNotDeliveredSMS','GetNewOutgoingSMS',
        'DeleteAllIncomingSMS','DeleteAllOutgoingSMS','DeleteAllDeliveredSMS','DeleteAllNotDeliveredSMS',
        'DeleteIncomingSMS','DeleteOutgoingSMS','DeleteDeliveredSMS','DeleteNotDeliveredSMS',
        'AddNewOutgoingSMS','AddNewIncomingSMSLog','AddNewOutgoingSMSLog');
    protected $api_Param;
    protected $api_CompanyID;
    protected $user;

    public function getList()
    {
        return new JsonModel();
    }
    public function create($data)
    {
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        return new JsonModel();
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
}