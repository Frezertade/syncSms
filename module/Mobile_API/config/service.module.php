<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:21 AM
 */
return array(
    'invokables'=> array(
        'Mobile_API\Repository\RepositoryInterface' => 'Mobile_API\Repository\RepositoryImpl',
    ),
    'factories'=>array(
        'Mobile_API\Service\Service' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator){
            $smsService = new \Mobile_API\Service\ServiceImpl();
            $smsService->setRepository($serviceLocator->get('Mobile_API\Repository\RepositoryInterface'));
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