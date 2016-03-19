<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS
 * Date: 3/19/16
 * Time: 4:29 PM
 */
namespace Sync_SMS;
return array(
    'router' => array(
        'routes' => array(
            'sms_api' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/sync_sms',
                    'defaults' => array(
                        'controller' => 'Sync_SMS\Controller\api',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Sync_SMS\Controller\api' => Controller\smsController::class,
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