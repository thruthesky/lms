<div class="wrap">

    <h2>Payment</h2>

    <?php

    global $wpdb;
    $table = $wpdb->prefix . 'payment';
    $rows = $wpdb->get_results("SELECT * FROM $table WHERE result='Y' ORDER BY id DESC");

//di($rows);
    ?>

    <table class="wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <th>ID</th>
            <th>User Account</th>
            <th>Method</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Stamp Create</th>
            <th>Stamp Finish</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ( $rows as $row ) { ?>
        <tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->paygate_account ?></td>
            <td><?php echo $row->method ?></td>
            <td><?php echo $row->currency ?></td>
            <td><?php echo $row->amount ?></td>
            <td><?php echo $row->stamp_create ?></td>
            <td><?php echo $row->stamp_finish ?></td>
            <td><?php echo $row->result ?></td>
        </tr>
        <?php } ?>


        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>User Account</th>
            <th>Method</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Stamp Create</th>
            <th>Stamp Finish</th>
            <th>Result</th>
        </tr>
        </tfoot>
    </table>


</div>
