<?php $source = get_sub_field('cta_content_source');?>
<?php $cta_id = 'call-to-action-' . rand(); ?>
<?php
if ( $source === 'default' ){

    $background = get_field('cta_background', 'option');

    if( $background == 'image'){
        $content_color = get_field('cta_text_color', 'option') ?? '';
        $bg_image = get_field('cta_background_image', 'option');
        $image = wp_get_attachment_image_src( $bg_image, 'large' );

    }

    $content = get_field('cta_content', 'option');
    $fg_image = wp_get_attachment_image(get_field('cta_foreground_image', 'option'), 'full');
    $button = get_field('cta_link', 'option');

}else{

    $background = get_sub_field('cta_background');
   
    if( $background == 'image'){
        $content_color = get_field('cta_text_color') ?? '';
        $bg_image = get_sub_field('cta_background_image');
        $fg_image = get_sub_field('cta_foreground_image');
        $image = wp_get_attachment_image_src( $bg_image, 'large' );
    }

    $content = get_sub_field('cta_content');
    $button = get_sub_field('cta_link');
    $foreground_image = get_sub_field('cta_foreground_image');

}
?>

<style>
    <?php echo '#'.$cta_id; ?>.call-to-action-image {
        <?php if( $image ): ?>
        background-image: url('<?php echo $image[0];?>');
        background-size: cover;
        background-position: center;
        <?php endif; ?>
    }
</style>

<div class="uk-container uk-container-expand uk-width-1-1 fc-section-cta fc-section-columns call-to-action call-to-action--<?php echo $source;?> call-to-action-<?php echo $background; ?> background--<?php echo $background;?> background--<?php echo $content_color;?>" id="<?php echo $cta_id; ?>">

    <!-- <div class="call-to-action--inner uk-container uk-container-small"> -->

        <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-column uk-flex-row@m uk-margin-left uk-margin-auto-left@m uk-margin-right uk-margin-auto-right@m">

            <div class="uk-margin-large-right">
                <?php echo $fg_image; ?>
            </div>

            <div class="uk-width-xlarge uk-flex uk-flex-column uk-flex-center">
            <?php echo $content; ?>
            </div>

            <?php if( is_array($button) ): ?>
                <?php if( array_key_exists('url', $button) ): ?>
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="uk-button" <?php if( $button['target'] ): ?> target="<?php echo esc_attr( $button['target'] ); ?>" <?php endif; ?>>
                        <?php echo esc_html( $button['title'] ); ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

        <!-- </div> -->

        

        
    </div>

</div>