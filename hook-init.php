<?php


function lms_init() {
    load_plugin_textdomain( 'lms', FALSE, basename( dirname( __FILE__ ) ) );
}
add_action( 'plugins_loaded', 'lms_init' );
display_option_on('wp_head', LMS_OPTION, 'html_head');
display_option_on('wp_footer', LMS_OPTION, 'html_bottom');

add_action('wp_footer', function(){
    $domain = get_opt('lms[domain]');
    if ( empty($domain) ) {
        echo "
    <script>
    alert('Error: No domain in LMS Settings.');
    </script>
    ";
    }
});

