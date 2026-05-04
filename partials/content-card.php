<?php
$card         = $args['card_obj'];
$delay        = $args['delay'];
$per_row      = $args['per_row'];
$aos          = $args['aos'];
$aos_duration = $args['duration'];

$card_url = ! empty( $card['card_link']['url'] ) ? $card['card_link']['url'] : '';

$class = 'uk-card uk-margin-bottom';

switch ( $per_row ) {
  case 2:  $class .= ' uk-width-1-1@xs uk-width-1-2@m'; break;
  case 3:  $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m'; break;
  case 4:  $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-4@l'; break;
  default: $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m'; break;
}
?>

<div class="<?php echo esc_attr( $class ); ?>"
  <?php if ( $aos ) : ?>
    data-aos="<?php echo esc_attr( $aos ); ?>"
    data-aos-duration="<?php echo esc_attr( $aos_duration ); ?>"
    data-aos-delay="<?php echo esc_attr( $delay ); ?>"
  <?php endif; ?>
  data-hover-card>

  <div class="uk-height-1-1 uk-flex uk-flex-column uk-position-relative">

    <?php $image = wp_get_attachment_image( $card['card_icon'], 'thumbnail', false, [ 'class' => 'uk-width-1-1', 'loading' => 'lazy' ] ); ?>

    <?php if ( $image ) : ?>
      <div class="card-media uk-card-media-top">
        <?php echo $image; ?>
      </div>
    <?php endif; ?>

    <?php $card_tag = $card_url ? 'a' : 'div'; ?>
    <<?php echo $card_tag; ?>
      <?php if ( $card_url ) : ?>href="<?php echo esc_url( $card_url ); ?>"<?php endif; ?>
      class="card-body uk-card-body uk-height-1-1 uk-width-1-1 uk-position-absolute uk-flex uk-flex-column uk-flex-right">

      <?php if ( ! empty( $card['card_collection'] ) ) : ?>
        <span class="g-section-subtitle">
          <?php echo esc_html( $card['card_collection'] ); ?>
        </span>
      <?php endif; ?>

      <h3 class="card-title uk-card-title uk-margin-remove">
        <?php echo esc_html( $card['card_title'] ); ?>
      </h3>

      <?php if ( ! empty( $card['card_description'] ) ) : ?>
        <p class="card-p uk-margin-remove">
          <?php echo wp_kses_post( $card['card_description'] ); ?>
        </p>
      <?php endif; ?>

    </<?php echo $card_tag; ?>>

  </div>
</div>
