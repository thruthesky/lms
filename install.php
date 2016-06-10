<?php

register_activation_hook( __LMS_FILE__, function( ) {
    dog("register_activation_hook()");
    include __LMS_PATH__ . 'payment-gateway/install-wordpress.php';
});
