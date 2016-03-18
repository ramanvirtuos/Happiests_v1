<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class'    => 'NotificationHeader',
    'function' => 'loadMessages',
    'filename' => 'notificationheader.php',
    'filepath' => 'hooks',
    'params'   => ''
);


$hook['post_controller_constructor'][] = array(
    'class'    => 'NotificationHeader',
    'function' => 'loadNotifications',
    'filename' => 'notificationheader.php',
    'filepath' => 'hooks',
    'params'   => ''
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'NotificationHeader',
    'function' => 'loadTasks',
    'filename' => 'notificationheader.php',
    'filepath' => 'hooks',
    'params'   => ''
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'NotificationHeader',
    'function' => 'loadMessageCounts',
    'filename' => 'notificationheader.php',
    'filepath' => 'hooks',
    'params'   => ''
);





/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
