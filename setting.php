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
        <?php $options = get_option( 'lms' ); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    Company Name
                </th>
                <td>
                    <input type='text' name="lms[company_name]" value='<?php option('lms', 'company_name') ?>' />
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
                    $src = $options[$option_name];
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
                    <textarea name="lms[copyright]"><?php option('lms', 'copyright') ?></textarea>
                    Input copyright.
                </td>
            </tr>



            <tr valign="top">
                <th scope="row">
                    HTML HEAD
                </th>
                <td>
                    <textarea name="lms[html_head]"><?php option('lms', 'html_head') ?></textarea>
                    Input Javascript, Style that will be placed right before &lt;/head&gt; tag.<br>
                    It is a good place to put META tags, Javascript, Styles.
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    HTML Bootom
                </th>
                <td>
                    <textarea name="lms[html_bottom]"><?php option('lms', 'html_bottom') ?></textarea>
                    Input Javascript, CSS, HTML codes that will be placed right before &lt;/body&gt; tag.
                </td>
            </tr>



        </table>

        <input type="submit">
    </form>

</div>