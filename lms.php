<?php
/**
 * Plugin Name: LMS
 * Plugin URI: http://dev.phlgo.com
 * Author: JaeHo Song
 * Description: Learning Management System.
 * Version: 0.0.2
 */

include plugin_dir_path(__FILE__) . 'wp-include/library.php';


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
        'LMS Index',
        'LMS 0.0.1',
        'manage_options',
        'lms/index.php',
        '',
        plugin_dir_url( __FILE__ ) . 'icon/lms.png', // 메뉴 아이콘
        '23.45'
    );
    add_submenu_page(
        'lms/index.php',
        'LMS Settings',
        'Settings',
        'manage_options',
        'lms/setting.php',
        ''
    );
} );


add_action('wp_head', function() {
    echo option('lms', 'html_head', false);
});
add_action('wp_footer', function() {
    echo option('lms', 'html_bottom', false);
});