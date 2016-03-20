<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS
 * Date: 3/19/16
 * Time: 4:32 PM
 */

namespace Sync_SMS\Controller;


use Sync_SMS\Model\IncomingSMS;
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
        /**
         * @var \Sync_SMS\Service\smsService $smsService
         */
        /**/
        $smsService = $this->getServiceLocator()->get('Sync_SMS\Service\Service');
        if(isset($_GET['device_code']) && isset($_GET['secret'])){
            $Device_Code = $_GET['device_code'];
            $Secrete_Code = $_GET['secret'];
            $outgoingSMSs = $smsService->GetNew_OutgoingSMS($Device_Code);
            $NewSMS = null;
            /**
             * @var \Sync_SMS\Model\OutgoingSMS $sms
             */
            foreach($outgoingSMSs as $sms){
                $new_sms['to'] = $sms->getSmsTo();
                $new_sms['message'] = $sms->getSmsMsg();
                $new_sms['uuid'] = $sms->getUuid();
                $NewSMS[] = $new_sms;
            }
            if(count($NewSMS)>0){
                return new JsonModel(array('payload'=>array('success'=>true,'task'=>'send','secret'=>$Secrete_Code,'messages'=>$NewSMS)));
            }else{
                return new JsonModel(array('payload'=>array('success'=>false,'task'=>'send','secret'=>$Secrete_Code,'messages'=>$NewSMS)));
            }
        }else{

        }
        /*
        $file = fopen("Error_Logger.txt","a");
        fwrite($file,"\n".'GET Request--->'."\n");
        fwrite($file,json_encode($_GET));
        fclose($file);*/

        return new JsonModel(array('payload'=>array('success'=>true,'error'=>false)));
    }
    public function create($data)
    {
        /**
         * @var \Sync_SMS\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('Sync_SMS\Service\Service');
        if(isset($_GET['device_code'])){
            $Campaigns = $smsService->GetCampaigns_by_device_code($_GET['device_code']);
            $NewSMS = new IncomingSMS();
            $NewSMS->setSmsId($_POST['message_id']);
            $NewSMS->setSmsFrom($_POST['from']);
            $NewSMS->setSmsMsg($_POST['message']);
            $NewSMS->setSmsTo($_POST['sent_to']);


            /**
             * @var \Sync_SMS\Model\Campaign $Campaign
             */
            foreach($Campaigns as $Campaign){
                $NewSMS->setCampaignId($Campaign->getId());
                $smsService->AddNew_IncomingSMS($NewSMS);
                $file = fopen("Error.txt","a");

            }
            $file = fopen("Error_Logger.txt","a");
            fwrite($file,"\n".'POST--->'."\n");
            fwrite($file,json_encode($_POST));
            fwrite($file,"\n".'GET--->'."\n");
            fwrite($file,json_encode($_GET));
            fclose($file);
        }


        return new JsonModel(array('payload'=>array('success'=>true,'error'=>false)));
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