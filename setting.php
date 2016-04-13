<style>
    input[name='lms[site_description]'] {
        width: 100%;
        box-sizing: border-box;
    }
    .photo img {
        max-width:100%;
        height:auto;
    }
    textarea
    {
        width:100%;
        height: 14em;
    }
    textarea.short {
        height: 4em;
    }
</style>

<?php
if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;
?>

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
        <div class="updated fade"><p><strong><?php _e( 'Settings saved', 'lms' ); ?></strong></p></div>
    <?php endif; ?>

    <form method="post" action="options.php">
        <?php settings_fields( 'lms' ); ?>


        <table class="form-table">

            <tr valign="top">
                <th scope="row">
                    Company Name
                </th>
                <td>
                    <input type='text' name="lms[company_name]" value='<?php opt('lms[company_name]') ?>' />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    Company Domain
                </th>
                <td>
                    <input type='text' name="lms[domain]" value='<?php opt('lms[domain]') ?>' />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    Domain Key
                </th>
                <td>
                    <input type='text' name="lms[domain_key]" value='<?php opt('lms[domain_key]') ?>' />
                </td>
            </tr>



            <tr value="top">
                <th scope="row">
                    Logo
                </th>
                <td>
                    <?php
                    if(function_exists( 'wp_enqueue_media' )){
                        wp_enqueue_media();
                    }
                    else{
                        wp_enqueue_style('thickbox');
                        wp_enqueue_script('media-upload');
                        wp_enqueue_script('thickbox');
                    }
                    $option_name = 'logo';
                    $name = "lms[$option_name]";
                    $src = get_opt($name);
                    ?>
                    <input type="hidden" type="text" name="<?php echo $name?>" value="<?php echo $src?>">
                    <div class="logo">
                        <div class="upload-button">
                            <div class="photo">
                                <img src="<?php echo $src?>"/>
                            </div>
                            <div class="button logo-button">
                                Upload LOGO ( width: 400px, height: 200px )
                            </div>
                            <div class="button delete-button">
                                Delete
                            </div>
                        </div>
                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            $('.upload-button .photo, .logo-button').click(function(e) {
                                e.preventDefault();
                                var custom_uploader = wp.media({
                                        title: 'Choose Logo',
                                        button: {
                                            text: 'Select Logo'
                                        },
                                        multiple: false
                                    })
                                    .on('select', function() {
                                        var attachment = custom_uploader.state().get('selection').first().toJSON();
                                        $('input[name="<?php echo $name?>"]').val(attachment.url);
                                        $('.photo img').attr('src', attachment.url);
                                    })
                                    .open();
                            });
                            $('.delete-button').click(function(e) {
                                e.preventDefault();
                                $('.logo .photo img').prop('src', '');
                                $('[name="<?php echo $name?>"]').val('');
                            });
                        });
                    </script>
                </td>
            </tr>



            <tr valign="top">
                <th scope="row">
                    Copyright
                </th>
                <td>
                    <textarea name="lms[copyright]"><?php opt('lms[copyright]') ?></textarea>
                    Input copyright.
                </td>
            </tr>



            <tr valign="top">
                <th scope="row">
                    HTML HEAD
                </th>
                <td>
                    <textarea name="lms[html_head]"><?php opt('lms[html_head]') ?></textarea>
                    Input Javascript, Style that will be placed right before &lt;/head&gt; tag.<br>
                    It is a good place to put META tags, Javascript, Styles.
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    HTML Bootom
                </th>
                <td>
                    <textarea name="lms[html_bottom]"><?php opt('lms[html_bottom]') ?></textarea>
                    Input Javascript, CSS, HTML codes that will be placed right before &lt;/body&gt; tag.
                </td>
            </tr>



            <tr valign="top">
                <th scope="row">
                    Banner 1 - Title
                </th>
                <td>
                    <textarea class="short" name="lms[banner_1_title]"><?php opt('lms[banner_1_title]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 1 - Content
                </th>
                <td>
                    <textarea class="short" name="lms[banner_1_content]"><?php opt('lms[banner_1_content]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 1 - More Button
                </th>
                <td>
                    <textarea class="short" name="lms[banner_1_more]"><?php opt('lms[banner_1_more]') ?></textarea>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    Banner 2 - Title
                </th>
                <td>
                    <textarea class="short" name="lms[banner_2_title]"><?php opt('lms[banner_2_title]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 2 - Content
                </th>
                <td>
                    <textarea class="short" name="lms[banner_2_content]"><?php opt('lms[banner_2_content]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 2 - More Button
                </th>
                <td>
                    <textarea class="short" name="lms[banner_2_more]"><?php opt('lms[banner_2_more]') ?></textarea>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    Banner 3 - Title
                </th>
                <td>
                    <textarea class="short" name="lms[banner_3_title]"><?php opt('lms[banner_3_title]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 3 - Content
                </th>
                <td>
                    <textarea class="short" name="lms[banner_3_content]"><?php opt('lms[banner_3_content]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 3 - More Button
                </th>
                <td>
                    <textarea class="short" name="lms[banner_3_more]"><?php opt('lms[banner_3_more]') ?></textarea>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    Banner 4 - Title
                </th>
                <td>
                    <textarea class="short" name="lms[banner_4_title]"><?php opt('lms[banner_4_title]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 4 - Content
                </th>
                <td>
                    <textarea class="short" name="lms[banner_4_content]"><?php opt('lms[banner_4_content]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 4 - More Button
                </th>
                <td>
                    <textarea class="short" name="lms[banner_4_more]"><?php opt('lms[banner_4_more]') ?></textarea>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    Banner 5 - Title
                </th>
                <td>
                    <textarea class="short" name="lms[banner_5_title]"><?php opt('lms[banner_5_title]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 5 - Content
                </th>
                <td>
                    <textarea class="short" name="lms[banner_5_content]"><?php opt('lms[banner_5_content]') ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Banner 5 - More Button
                </th>
                <td>
                    <textarea class="short" name="lms[banner_5_more]"><?php opt('lms[banner_5_more]') ?></textarea>
                </td>
            </tr>







        </table>

        <input type="submit">
    </form>

</div>