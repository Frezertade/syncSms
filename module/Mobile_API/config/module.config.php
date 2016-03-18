<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:21 AM
 */
namespace Mobile_API;
return array(
    'router' => array(
        'routes' => array(
            'sms_api' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/api',
                    'defaults' => array(
                        'controller' => 'Mobile_API\Controller\api',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Mobile_API\Controller\api' => Controller\apiController::class,
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
    ),
);