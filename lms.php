<?php
/**
 * Plugin Name: LMS
 * Plugin URI: http://dev.phlgo.com
 * Author: JaeHo Song
 * Description: Learning Management System.
 * Version: 0.0.2
 */

if ( ! defined('ABC_LIBRARY') ) {
    echo "LMS: Activate ABC-Library";
    return;
}
else {
    dog('lms');
}

/**
 * Defines
 */
define('__LMS_FILE__', __FILE__);
define('__LMS_PATH__', plugin_dir_path( __LMS_FILE__ ));
define('LMS_OPTION', 'lms');
define('API_ENDPOINT', 'http://onlineenglish.kr/ajax.php');



/**
 * hooks
 *
 *
 */
include __LMS_PATH__ . "hook-admin-menu.php";
include __LMS_PATH__ . 'hook-init.php';
include __LMS_PATH__ . 'function.php';
include __LMS_PATH__ . 'main-server/action.php';
include __LMS_PATH__ . 'main-server/api.php';
include __LMS_PATH__ . 'action.php';
include __LMS_PATH__ . 'payment-gateway/function.php';
include __LMS_PATH__ . 'payment-gateway/config.php';


