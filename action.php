<?php




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
