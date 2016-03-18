<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:36 AM
 */

namespace Mobile_API\Controller;


use Mobile_API\Model\NewsFeed;
use Mobile_API\Model\Testimony;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class apiController extends AbstractRestfulController
{
    protected $api_Response;
    protected $api_Services = array('GetNew_NewsFeed','GetAll_NewsFeed','Send_NewsFeedLog',"Send_Testimony");
    protected $api_Param;
    protected $api_IMEI;
    public function getList()
    {
        return new JsonModel();
    }
    public function create($data)
    {
        /**
         * @var \Mobile_API\Service\Service $apiService
         */
        $apiService = $this->getServiceLocator()->get('Mobile_API\Service\Service');
        if($this->isValidRequest($data)){
            if($this->isValidParam($data['Param'],$data['Service'])){
                $this->api_Param = $data['Param'];
                if($data['Service'] == $this->api_Services[0]){

                    $new_NewsFeeds = $apiService->GetNew_NewsFeeds($this->api_IMEI);
                    if($new_NewsFeeds != null){
                        foreach ($new_NewsFeeds as $news) {
                            $_NewsFeed = new NewsFeed();
                            $_NewsFeed->setId($news['News_ID']);
                            $apiService->Add_NewsFeed_Log($_NewsFeed,$this->api_IMEI);
                        }
                    }else{
                        $new_NewsFeeds = array();
                    }

                    $this->api_Response['NewsFeeds'] = $new_NewsFeeds;
                    $this->api_Response['NewsFeed_Log'] = array();
                    $this->api_Response['Testimony'] = array();
                }elseif($data['Service'] == $this->api_Services[1]){
                    $new_NewsFeeds = $apiService->GetAll_NewsFeeds();
                    $this->api_Response['NewsFeeds'] = $new_NewsFeeds;
                    $this->api_Response['NewsFeed_Log'] = array();
                    $this->api_Response['Testimony'] = array();
                }elseif($data['Service'] == $this->api_Services[2]){
                    $response = null;
                    $arr = json_decode($this->api_Param ,true);
                    $x = 0;
                    if(count($arr)>0){
                        for($x=0;$x<count($arr);$x++){
                            $newsFeed = new NewsFeed();
                            $newsFeed->setId($arr[$x]['News_ID']);
                            $state = $apiService->Add_NewsFeed_Log($newsFeed,$this->api_IMEI);
                            $res['News_ID'] = $arr[$x]['News_ID'];
                            $res['Log_State'] = $state;
                            $response[] = $res;
                        }
                    }
                    $this->api_Response['NewsFeed_Log'] = $response;
                    $this->api_Response['NewsFeeds'] = array();
                    $this->api_Response['Testimony'] = array();

                }elseif($data['Service'] == $this->api_Services[3]){
                    $newTestimony = new Testimony();
                    $newTestimony->setFullName($data["Full_Name"]);
                    $newTestimony->setGPS($data['GPS']);
                    $newTestimony->setTestimony($data['Testimony']);
                    $newTestimony->setIMEI($data['IMEI']);
                    $apiService->AddNew_Testimony($newTestimony);
                    $this->api_Response['NewsFeeds'] = array();
                    $this->api_Response['NewsFeed_Log'] = array();
                    $this->api_Response['Testimony'] = array(array("Testimony"=>"Saved"));
                }
            }else{
                $this->api_Response['NewsFeed_Log'] = array();
                $this->api_Response['NewsFeeds'] = array();
                $this->api_Response['Testimony'] = array();
            }
        }else{
            $this->api_Response['NewsFeed_Log'] = array();
            $this->api_Response['NewsFeeds'] = array();
            $this->api_Response['Testimony'] = array();
        }
        return new JsonModel($this->api_Response);
    }
    public function isValidRequest($api_request){
        $this->api_Response['Request_Error'] = array();
        if(isset($api_request['IMEI']) && isset($api_request['Service']) && isset($api_request['Param'])){
            if(in_array($api_request['Service'],$this->api_Services)){
                $this->api_IMEI = $api_request['IMEI'];
                return true;
            }else{
                $error['Service_Request'] = 'Unknown';
                $this->api_Response['Request_Error'] = $error;
                return false;
            }
        }else{
            $error['API_Parameter'] = 'Invalid';
            $this->api_Response['Request_Error'] = $error;
            return false;
        }
    }
    public function isValidParam($param,$service_type){
        $is_valid = false;
        if(!is_array($param)) {
            if ($service_type == $this->api_Services[0]) {
                $is_valid = true;
            }elseif ($service_type == $this->api_Services[1]) {
                $is_valid = true;
            }elseif ($service_type == $this->api_Services[2]) {
                if(is_array(json_decode($param,true))) {
                    $arr = json_decode($param,true);
                    $x = 0;
                    if(count($arr)>0){
                        for($x=0;$x<count($arr);$x++){
                            if(isset($arr[$x]['News_ID'])){
                                $is_valid = true;
                            }else{
                                $error['Parameter Error'] = 'Invalid Parameter is set!000';
                                $this->api_Response['Param_Error'] = $error;
                                $is_valid = false;
                                break;
                            }
                        }
                    }
                }else{
                    $error['Parameter Error'] = $param;
                    $this->api_Response['Param_Error'] = $error;
                }
            }elseif ($service_type == $this->api_Services[3]) {
                $is_valid = true;
            }
        }
        return $is_valid;
    }
}