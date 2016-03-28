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
if ( ! defined('WP_LIBRARY') ) die("Activate WP-Library");

/**
 * hooks
 */
include plugin_dir_path(__FILE__) . 'hook-admin-menu.php';
include plugin_dir_path(__FILE__) . 'hook-init.php';


function lms_init() {
    load_plugin_textdomain( 'lms', FALSE, basename( dirname( __FILE__ ) ) );
}
add_action( 'plugins_loaded', 'lms_init' );


add_action( 'admin_init', function() {
    register_setting( 'lms', 'lms' );
});
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar; // 관리자 툴바
    $wp_admin_bar->add_menu( array(
        'id' => 'siteapi_toolbar',
        'title' => 'LMS',
        'href' => home_url('wp-admin/admin.php?page=lms%2Findex.php')
    ) );
});
add_action('admin_menu', function () {
    add_menu_page(
        __('LMS Index', 'lms'),
        __('LMS 0.0.1', 'lms'),
        'manage_options',
        'lms/index.php',
        '',
        plugin_dir_url( __FILE__ ) . 'icon/lms.png', // 메뉴 아이콘
        '23.45'
    );
    add_submenu_page(
        'lms/index.php',
        __('LMS Settings', 'lms'),
        __('Settings', 'lms'),
        'manage_options',
        'lms/setting.php',
        ''
    );
} );


add_action('wp_head', function() {
    option('lms', 'html_head', false);
});
add_action('wp_footer', function() {
    option('lms', 'html_bottom', false);
});


// 회원 가입 페이지에 양식을 추가
// first_name 과 같이 기본적으로 제공되는 meta_key 를 사용하면 된다.
add_action( 'register_form', function() {
    require ('template/register_form.php');

});
// 회원 가입 후, 메인페이지로 이동.
add_filter( 'bbp_user_register_redirect_to', function() {
    return home_url('/');
});
// 회원 가입 버튼을 누르면 회원 정보를 업데이트하는 코드
add_action( 'user_register', function ( $user_id ) {
    dog($_POST);
    dog($user_id);
    update_user_meta($user_id, 'first_name', $_POST['first_name']);
    update_user_meta($user_id, 'nickanme', $_POST['nickanme']);
    update_user_meta($user_id, 'mobile', $_POST['mobile']);
    update_user_meta($user_id, 'landline', $_POST['landline']);
    update_user_meta($user_id, 'skype', $_POST['skype']);
    update_user_meta($user_id, 'kakao', $_POST['kakao']);
    update_user_meta($user_id, 'address', $_POST['address']);

}, 10, 1);
