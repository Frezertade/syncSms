<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 7:13 PM
 */

namespace SMS_API\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class smsController extends AbstractRestfulController
{
    public function getList()
    {
        /**
         * @var \SMS_API\Service\smsService $smsService
         */
        $smsService = $this->getServiceLocator()->get('SMS_API\Service\smsService');
        $smsService->isValidUser('dasdsad','sadasdsad');


        return new JsonModel(array('bengeos'=>'sadajsdh'));
    }
    public function create($data)
    {
        /*
         * POST request will arrive here
         */
        return new JsonModel(array('create'));
    }
}