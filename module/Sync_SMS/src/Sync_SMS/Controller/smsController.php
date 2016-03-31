<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS
 * Date: 3/19/16
 * Time: 4:32 PM
 */

namespace Sync_SMS\Controller;


use Sync_SMS\Model\Contact;
use Sync_SMS\Model\IncomingSMS;
use Sync_SMS\Model\OutgoingSMS;
use Zend\Filter\File\Encrypt;
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

    public function Register(){
        /**
         * @var \Sync_SMS\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('Sync_SMS\Service\Service');
        $smsService->Process_Campaign_Request();
    }

    public function getList()
    {
        $file = fopen("Error_Logger.txt","a");
        fwrite($file,"\n".'-------GET REQUEST -------- '."\n");
        fwrite($file,"\n".'Post Request---> @ '.date("Y-m-d h:i:sa", time())."\n");
        fwrite($file,json_encode($_POST));
        fwrite($file,"\n".'GET Request---> @ '.date("Y-m-d h:i:sa", time())."\n");
        fwrite($file,json_encode($_GET));

        /**
         * @var \Sync_SMS\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('Sync_SMS\Service\Service');

        if(isset($_GET['device_code']) && isset($_GET['secret'])){
            $smsService->Process_Campaign_Registration($_GET['device_code']);
            $Device_Code = $_GET['device_code'];
            $Secrete_Code = $_GET['secret'];
            $outgoingSMSs = $smsService->GetNew_OutgoingSMS($Device_Code);
            $NewSMS = array();
            if($outgoingSMSs != null){
                /**
                 * @var \Sync_SMS\Model\OutgoingSMS $sms
                 */
                foreach($outgoingSMSs as $sms){
                    $new_sms['to'] = $sms->getSmsTo();
                    $new_sms['message'] = $sms->getSmsMsg();
                    $new_sms['uuid'] = $sms->getUuid();
                    $smsService->AddNew_OutgoingSMS_Log($sms->getId());
                    $NewSMS[] = $new_sms;
                }
                if(count($NewSMS)>0){
                    fwrite($file,"\n".'Sending SMS---> @ '.date("Y-m-d h:i:sa", time())."\n");
                    fwrite($file,json_encode($NewSMS));
                    fclose($file);
                    return new JsonModel(array('payload'=>array('success'=>true,'task'=>'send','secret'=>$Secrete_Code,'messages'=>$NewSMS)));
                }else{
                    fwrite($file,"\n".'No message Sent---> @ '.date("Y-m-d h:i:sa", time())."\n");
                    fwrite($file,json_encode($NewSMS));
                    fclose($file);
                    return new JsonModel(array('payload'=>array('success'=>false,'error'=>true)));
                }
            }else{
                fwrite($file,"\n".'There is no outgoing SMS @ '.date("Y-m-d h:i:sa", time())."\n");
                fclose($file);
                return new JsonModel(array('payload'=>array('success'=>false,'error'=>null)));
            }
        }
        fwrite($file,"\n".'Authentication Error Occurred---> @ '.date("Y-m-d h:i:sa", time())."\n");
        fclose($file);
        $this->Register();
        return new JsonModel(array('payload'=>array('success'=>false,'error'=>null)));
    }
    public function create($data)
    {
        $file = fopen("Error_Logger.txt","a");
        fwrite($file,"\n".'-------POST REQUEST -------- '."\n");
        fwrite($file,"\n".'Post Request---> @ '.date("Y-m-d h:i:sa", time())."\n");
        fwrite($file,json_encode($_POST));
        fwrite($file,"\n".'GET Request---> @ '.date("Y-m-d h:i:sa", time())."\n");
        fwrite($file,json_encode($_GET));


        /**
         * @var \Sync_SMS\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('Sync_SMS\Service\Service');
        if(isset($_GET['device_code']) && isset($_POST['message_id'])){
            $Campaigns = $smsService->GetCampaigns_by_device_code($_GET['device_code']);
            $NewSMS = new IncomingSMS();
            $NewSMS->setSmsId(isset($_POST['message_id'])? $_POST['message_id']:null);
            $NewSMS->setSmsFrom(isset($_POST['from'])? $_POST['from']:null);
            $NewSMS->setSmsMsg(isset($_POST['message'])? $_POST['message']:null);
            $NewSMS->setSmsTo(isset($_POST['sent_to'])? $_POST['sent_to']:null);

            if($Campaigns != null){
                /**
                 * @var \Sync_SMS\Model\Campaign $Campaign
                 */
                foreach($Campaigns as $Campaign){
                    $NewSMS->setCampaignId($Campaign->getId());
                    $smsService->AddNew_IncomingSMS($NewSMS);
                }
                $this->Register();
                fwrite($file,"\n".'---New Message Received-----'.date("Y-m-d h:i:sa", time())."\n");
                fwrite($file,json_encode($_GET));
                fclose($file);
                return new JsonModel(array('payload'=>array('success'=>true,'error'=>null)));
            }else{
                $this->Register();
                fwrite($file,"\n".'---No Campaigns Found-----'.date("Y-m-d h:i:sa", time())."\n");
                fwrite($file,json_encode($_GET));
                fclose($file);
                return new JsonModel(array('payload'=>array('success'=>false,'error'=>"No Campaign Found")));
            }
        }else{
            $this->Register();
            fwrite($file,"\n".'---No Device code Found || No Message id-----'.date("Y-m-d h:i:sa", time())."\n");
            fwrite($file,json_encode($_GET));
            fclose($file);
            return new JsonModel(array('payload'=>array('success'=>false,'error'=>"Error occurred in saving sms")));
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
}