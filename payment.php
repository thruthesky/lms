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
            <th scope="col" id="id" class="manage-column">ID</th>
            <th scope="col" id="user_account" class="manage-column">User Account</th>
            <th scope="col" id="method" class="manage-column">Method</th>
            <th scope="col" id="currency" class="manage-column">Currency</th>
            <th scope="col" id="Amount" class="manage-column">Amount</th>
            <th scope="col" id="stamp_create" class="manage-column">Stamp Create</th>
            <th scope="col" id="date" class="manage-column">Stamp Finish</th>
            <th scope="col" id="result" class="manage-column">Result</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ( $rows as $row ) { ?>
        <tr>
            <td scope="col" id="id" class="manage-column"><?php echo $row->id ?></td>
            <td scope="col" id="user_account" class="manage-column"><?php echo $row->paygate_account ?></td>
            <td scope="col" id="method" class="manage-column"><?php echo $row->method ?></td>
            <td scope="col" id="currency" class="manage-column"><?php echo $row->currency ?></td>
            <td scope="col" id="Amount" class="manage-column"><?php echo $row->amount ?></td>
            <td scope="col" id="stamp_create" class="manage-column"><?php echo $row->stamp_create ?></td>
            <td scope="col" id="date" class="manage-column"><?php echo $row->stamp_finish ?></td>
            <td scope="col" id="result" class="manage-column"><?php echo $row->result ?></td>
        </tr>
        <?php } ?>


        </tbody>
        <tfoot>
        <tr>
            <th scope="col" id="id" class="manage-column">ID</th>
            <th scope="col" id="user_account" class="manage-column">User Account</th>
            <th scope="col" id="method" class="manage-column">Method</th>
            <th scope="col" id="currency" class="manage-column">Currency</th>
            <th scope="col" id="Amount" class="manage-column">Amount</th>
            <th scope="col" id="stamp_create" class="manage-column">Stamp Create</th>
            <th scope="col" id="date" class="manage-column">Stamp Finish</th>
            <th scope="col" id="result" class="manage-column">Result</th>
        </tr>
        </tfoot>
    </table>


</div>
