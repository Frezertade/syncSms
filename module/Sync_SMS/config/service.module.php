<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS
 * Date: 3/19/16
 * Time: 4:30 PM
 */
namespace Sync_SMS;
return array(
    'invokables'=> array(
        'Sync_SMS\Repository\RepositoryInterface' => 'Sync_SMS\Repository\RepositoryImpl',
    ),
    'factories'=>array(
        'Sync_SMS\Service\Service' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator){
            $smsService = new \Sync_SMS\Service\smsServiceImpl();
            $smsService->setSmsRepository($serviceLocator->get('Sync_SMS\Repository\RepositoryInterface'));
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