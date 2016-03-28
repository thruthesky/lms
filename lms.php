<?php
/**
 * Plugin Name: LMS
 * Plugin URI: http://dev.phlgo.com
 * Author: JaeHo Song
 * Description: Learning Management System.
 * Version: 0.0.2
 */
/**
 * Defines
 */
define('LMS_OPTION', 'lms');
/**
 * includes
 */
include plugin_dir_path(__FILE__) . 'wp-include/library.php';
/**
 * hooks
 */
include plugin_dir_path(__FILE__) . 'hook-admin-menu.php';
include plugin_dir_path(__FILE__) . 'hook-init.php';

