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


<script>
    jQuery(function($) {
        $('.delete-button').click(function(){
            var name = $(this).attr('target-name');
            var $target = $('.photo-upload-button[target-name="'+name+'"]');
            $target.find('input').val('');
            $target.find('img').attr('src', '');
        });
    });

    jQuery(document).ready(function($) {
        $('.photo-upload-button').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            var custom_uploader = wp.media({
                    title: '사이트 사진 선택',
                    button: {
                        text: '선택하기'
                    },
                    multiple: false
                })
                .on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $this.find('input').val(attachment.url);
                    $this.find('img').attr('src', attachment.url);
                })
                .open();
        });
    });
</script>


<?php
if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;
?>

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>



    <div>
        <a href="<?php echo home_url()?>/category/qna/feed" target="_blank">RSS Feed</a>
    </div>

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
                <th scope="row">Company Address</th>
                <td><input type='text' name="lms[company_address]" value='<?php opt('lms[company_address]') ?>' /></td>
            </tr>


            <tr valign="top">
                <th scope="row">Manager Name</th>
                <td><input type='text' name="lms[manager_name]" value='<?php opt('lms[manager_name]') ?>' /></td>
            </tr>


            <tr valign="top">
                <th scope="row">Email</th>
                <td><input type='text' name="lms[email]" value='<?php opt('lms[email]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    Phone Number
                </th>
                <td>
                    <input type='text' name="lms[phone_number]" value='<?php opt('lms[phone_number]') ?>' />
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">Kakao Talk ID</th>
                <td>
                    <input type='text' name="lms[kakaotalk]" value='<?php opt('lms[kakaotalk]') ?>' />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Skype ID</th>
                <td><input type='text' name="lms[skype]" value='<?php opt('lms[skype]') ?>' /></td>
            </tr>




            <tr valign="top">
                <th scope="row">Bank Information</th>
                <td><input type='text' name="lms[bank]" value='<?php opt('lms[bank]') ?>' /></td>
            </tr>



            <tr valign="top">
                <th scope="row">
                    Company Domain
                </th>
                <td>
                    <input type='text' name="lms[domain]" value='<?php opt('lms[domain]') ?>' />
			<a href='http://<?php opt('lms[domain]')?>' target='_blank'>Admin Page</a>
                </td>
            </tr>




            <tr valign="top">
                <th scope="row">Domain Key</th>
                <td><input type='text' name="lms[domain_key]" value='<?php opt('lms[domain_key]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">올더게이트 ID</th>
                <td><input type='text' name="lms[allthegate_id]" value='<?php opt('lms[allthegate_id]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">올더게이트 CP ID</th>
                <td><input type='text' name="lms[allthegate_cp_id]" value='<?php opt('lms[allthegate_cp_id]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">올더게이트 CP PWD</th>
                <td><input type='text' name="lms[allthegate_cp_pwd]" value='<?php opt('lms[allthegate_cp_pwd]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">올더게이트 CP CODE</th>
                <td><input type='text' name="lms[allthegate_cp_code]" value='<?php opt('lms[allthegate_cp_code]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">올더게이트 SUB CP ID</th>
                <td><input type='text' name="lms[allthegate_sub_cp_id]" value='<?php opt('lms[allthegate_sub_cp_id]') ?>' /></td>
            </tr>

            <tr valign="top">
                <th scope="row">상품 이름</th>
                <td><input type='text' name="lms[allthegate_item_name]" value='<?php opt('lms[allthegate_item_name]') ?>' /></td>
            </tr>




            <tr valign="top">
                <th scope="row">
                    <?php _e("Logo on top", 'lms')?>
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
                    $option_name = 'logo_on_top';
                    $name = 'lms' . "[$option_name]";
                    $src = get_opt( $name );
                    ?>

                    <div class="photo-upload-button" target-name="<?php echo $name?>">
                        <input type="hidden" type="text" name="<?php echo $name?>" value="<?php echo $src?>">
                        <div>
                            <div class="photo">
                                <img src="<?php echo $src?>"/></div>
                            <div class="button">
                                사이트 대표 아이콘(사진) 등록 하기 ( jpg 또는 png 파일. 너비 512 픽셀, 높이 512 픽셀 )
                            </div>
                        </div>
                    </div>

                    <div class="button delete-button" target-name="<?php echo $name?>">
                        사진 삭제
                    </div>
                </td>
            </tr>




            <tr valign="top">
                <th scope="row">
                    <?php _e("Logo on bottom", 'lms')?>
                </th>
                <td>
                    <?php
                    $option_name = 'logo_on_bottom';
                    $name = 'lms' . "[$option_name]";
                    $src = get_opt( $name );
                    ?>
                    <div class="photo-upload-button" target-name="<?php echo $name?>">
                        <input type="hidden" type="text" name="<?php echo $name?>" value="<?php echo $src?>">
                        <div>
                            <div class="photo">
                                <img src="<?php echo $src?>"/></div>
                            <div class="button">
                                사이트 상단 헤더(타이틀 이미지) ( jpg 또는 png 파일. 너비 1600 픽셀, 높이 200 ~ 400 픽셀 )
                            </div>
                        </div>
                    </div>
                    <div class="button delete-button" target-name="<?php echo $name?>">Delete photo</div>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e("Extra Image", 'lms')?>
                </th>
                <td>
                    <?php
                    $option_name = 'extra_image';
                    $name = 'lms' . "[$option_name]";
                    $src = get_opt( $name );
                    ?>
                    <div class="photo-upload-button" target-name="<?php echo $name?>">
                        <input type="hidden" type="text" name="<?php echo $name?>" value="<?php echo $src?>">
                        <div>
                            <div class="photo">
                                <img src="<?php echo $src?>"/></div>
                            <div class="button">
                                In case of later use.
                            </div>
                        </div>
                    </div>
                    <div class="button delete-button" target-name="<?php echo $name?>">Delete photo</div>
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








        </table>

        <input type="submit">
    </form>

</div>
