<?php
$source = get_sub_field('cta_content_source');

if ( $source === 'default' ) {

  $background    = get_field('cta_background', 'option');
  $content_color = '';
  $bg_image_url  = '';

  if ( $background === 'image' ) {
    $content_color = get_field('cta_text_color', 'option') ?? '';
    $bg_image_id   = get_field('cta_background_image', 'option');
    $bg_image_url  = $bg_image_id ? wp_get_attachment_image_url( $bg_image_id, 'large' ) : '';
  }

  $content  = get_field('cta_content', 'option');
  $fg_image = wp_get_attachment_image( get_field('cta_foreground_image', 'option'), 'full' );
  $button   = get_field('cta_link', 'option');

} else {

  $background    = get_sub_field('cta_background');
  $content_color = '';
  $bg_image_url  = '';

  if ( $background === 'image' ) {
    $content_color = get_sub_field('cta_text_color') ?? '';
    $bg_image_id   = get_sub_field('cta_background_image');
    $bg_image_url  = $bg_image_id ? wp_get_attachment_image_url( $bg_image_id, 'large' ) : '';
  }

  $content  = get_sub_field('cta_content');
  $fg_image = wp_get_attachment_image( get_sub_field('cta_foreground_image'), 'full' );
  $button   = get_sub_field('cta_link');

}

// When a background image is set, pass it via CSS custom property and add fc-section-image
// so the existing ::before pseudo-element rule in _flexible.scss renders it correctly.
$bg_image_class = $bg_image_url ? ' fc-section-image' : '';
$bg_style       = $bg_image_url ? ' style="--bg-image: url(' . esc_url( $bg_image_url ) . ')"' : '';
?>

<div class="fc-section-cta fc-section-columns call-to-action call-to-action--<?php echo esc_attr( $source ); ?> call-to-action-<?php echo esc_attr( $background ); ?> background--<?php echo esc_attr( $background ); ?> background--<?php echo esc_attr( $content_color ); ?><?php echo $bg_image_class; ?>"<?php echo $bg_style; ?>>

  <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-column uk-flex-row@m uk-margin-left uk-margin-auto-left@m uk-margin-right uk-margin-auto-right@m">

    <?php if ( $fg_image ) : ?>
      <div class="uk-margin-large-right">
        <?php echo $fg_image; ?>
      </div>
    <?php endif; ?>

    <div class="uk-width-xlarge uk-flex uk-flex-column uk-flex-center">
      <?php echo $content; ?>
    </div>

    <?php if ( is_array( $button ) && ! empty( $button['url'] ) ) : ?>
      <a href="<?php echo esc_url( $button['url'] ); ?>"
         class="uk-button"
         <?php if ( ! empty( $button['target'] ) ) : ?>target="<?php echo esc_attr( $button['target'] ); ?>"<?php endif; ?>>
        <?php echo esc_html( $button['title'] ); ?>
      </a>
    <?php endif; ?>

  </div>

</div>
