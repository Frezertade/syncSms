<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 2/26/2016
 * Time: 7:04 PM
 */
return array(
    'invokables'=> array(
        'SMS_API\Repository\smsRepository' => 'SMS_API\Repository\smsRepositoryImpl',
    ),
    'factories'=>array(
        'SMS_API\Service\smsService' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator){
            $smsService = new \SMS_API\Service\smsServiceImpl();
            $smsService->setSmsRepository($serviceLocator->get('SMS_API\Repository\smsRepository'));
            return $smsService;
        },
    ),
    'initializers'=>array(
        function($instance,\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator){
            if($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface){
                $instance->setDbAdapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
            }
        }
    ),
);