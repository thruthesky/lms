<?php





add_action('begin_registerSubmit', function(){
    //dog('registerSubmit begins...');
});
/**
 * When a user registers.
 *
 * @does update user info on main LMS server.
 */
add_action('end_registerSubmit', function($id){
    dog('lms::after_registerSubmit() : ' . $id);
    user_insert($id);
});




add_action('begin_updateSubmit', function(){
    //dog('registerSubmit begins...');
});

/**
 * When a user registers.
 *
 * @does update user info on main LMS server.
 */
add_action('end_updateSubmit', function($id){
    dog('lms::end_updateSubmit() : ' . $id);
    user_insert($id);
});




