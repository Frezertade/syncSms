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
        /*
         * GET request will arrive here
         */
        return new JsonModel();
    }
    public function create($data)
    {
        /*
         * POST request will arrive here
         */
        return new JsonModel(array('create'));
    }
}