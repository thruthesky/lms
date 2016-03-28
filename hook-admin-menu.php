<?php

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
