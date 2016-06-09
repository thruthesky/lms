<?php

register_activation_hook( __LMS_FILE__, function( ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'payment';
    dog( "table_name: $table_name");
    if( $wpdb->get_var( "show tables like '{$table_name}'" ) == $table_name ) {
        dog("table_name exists.");
    }
    else {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $sql = <<<EOS
CREATE TABLE $table_name (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL DEFAULT 0,
    method VARCHAR(64) NOT NULL DEFAULT '',
    amount INT UNSIGNED NOT NULL DEFAULT 0,
    success CHAR(1) NOT NULL DEFAULT 'N',
    stamp_create INT UNSIGNED NOT NULL DEFAULT 0,
    stamp_finish INT UNSIGNED NOT NULL DEFAULT 0,
    options LONGTEXT,
    PRIMARY KEY  (id)
);
EOS;
        dbDelta( $sql );
        $table_name = $wpdb->prefix . 'payment_log';
        $sql = <<<EOS
CREATE TABLE $table_name (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    payment_id INT UNSIGNED NOT NULL DEFAULT 0,
    message LONGTEXT,
    stamp_create INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY  (id)
);
EOS;
        dbDelta( $sql );

        dog("table created");
    }
});
