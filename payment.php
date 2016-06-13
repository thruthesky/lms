<div class="wrap">

    <h2>Payment</h2>

    <?php

    global $wpdb;
    $table = $wpdb->prefix . 'payment';
    $rows = $wpdb->get_results("SELECT * FROM $table WHERE result='Y' ORDER BY id DESC");

    di($rows);

    ?>


</div>