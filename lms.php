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
define('LMS_OPTION', 'lms');
define('API_ENDPOINT', 'http://onlineenglish.kr/ajax.php');

/**
 * hooks
 */
include plugin_dir_path(__FILE__) . 'hook-admin-menu.php';
include plugin_dir_path(__FILE__) . 'hook-init.php';



add_action('begin_registerSubmit', function(){
    //dog('registerSubmit begins...');
});
add_action('end_registerSubmit', function($id){
    dog('lms::after_registerSubmit() : ' . $id);
    user_insert($id);
});


add_action('begin_updateSubmit', function(){
    //dog('registerSubmit begins...');
});
add_action('end_updateSubmit', function($id){
    dog('lms::end_updateSubmit() : ' . $id);
    user_insert($id);
});


function ajax_ex_body( $html ) {
    $body = json_decode( $html['body'], true );
    return $body;
}
function ajax_url($func) {
    $url = API_ENDPOINT . '?';
    $url .= 'id=' . user()->user_login;
    $url .= '&nickname=' . urlencode(user()->nickname);
    $url .= '&name=' . urlencode(user()->name);
    $url .= '&email=' . urlencode(user()->user_email);
    $url .= '&mobile=' . urlencode(user()->mobile);
    $url .= '&landline=' . urlencode(user()->landline);
    $url .= '&classid=' . urlencode(user()->skype);
    $url .= '&domain=' . urlencode( get_opt('lms[domain]'));
    $url .= '&domain_key=' . urlencode( get_opt('lms[domain_key]'));
    $url .= '&function=' . $func;
    return $url;
}

function user_insert($id) {
    wp_set_current_user($id);
    ajax_ex_body( wp_remote_get( ajax_url('user_insert') ) );
}



/**
 * @return array|mixed|object
 *
[idx] => 18070
[id] => Pia
[name] => Pia Joy Soriano
[nickname] => Manager Pia
[classid] => ontue.teacher.135
[url_youtube] => http://youtu.be/bXM3FP6iL1Q
[photo] => ./data/teacher/primary_photo_18070
[teaching_year] => 5
[birthday] => 19881121
[greeting] =>
Hello there!! ..This is Manager Pia.  If you have any problems in the class, I'm willing to help you.


[major] => Bachelor of Science in Nursing
[gender] => F
 */
function teacher_list() {
    $url = API_ENDPOINT . '?';
    $url .= 'domain=' . urlencode( get_opt('lms[domain]'));
    $url .= '&domain_key=' . urlencode( get_opt('lms[domain_key]'));
    $url .= '&function=teacher_list';
    dog($url);
    $cid = 'teacher-list';
    $response = get_transient( $cid );
    if( false === $response ) {
        $response = wp_remote_get( $url );
        set_transient( $cid, $response, 60 * 60 ); // 1시간 동안 캐시
    }
    return ajax_ex_body($response);
}

function reservation_list() {
    $url = ajax_url('reservation_list');
    dog($url);
    return ajax_ex_body( wp_remote_get( $url ) );
}
function past_list() {
    $url = ajax_url('past_list');
    dog($url);
    return ajax_ex_body( wp_remote_get( $url ) );
}


function kday( $day ) {
    $days = array('Sun'=>'일', 'Mon'=>'월', 'Tue'=>'화', 'Wed'=>'수', 'Thu'=>'목', 'Fri'=>'금', 'Sat'=>'토');
    return $days[$day];
}
