<?php
$per_row      = get_sub_field('cards_per_row');
$divider      = get_sub_field('columns_divider'); // used as a CSS modifier class
$button_style = get_sub_field('button_style');
$icon_grid    = get_sub_field('icon_grid');

// Width classes per column count
$class = '';
switch ( $per_row ) {
  case 2:  $class = 'uk-width-1-1@xs uk-width-1-2@m'; break;
  case 3:  $class = 'uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m'; break;
  case 4:  $class = 'uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l'; break;
  default: $class = 'uk-width-1-1@xs uk-width-1-2@s uk-width-1-6@m'; break;
}

$grid_class = 'icon-grid ' . esc_attr( $divider ) . '-' . esc_attr( $per_row );
?>

<div class="<?php echo esc_attr( $grid_class ); ?> uk-grid uk-grid-large">

  <?php if ( is_array( $icon_grid ) ) : ?>
    <?php foreach ( $icon_grid as $card ) : ?>

      <div class="<?php echo esc_attr( $class ); ?>">
        <div class="uk-card uk-flex">

          <div class="uk-card-media uk-flex uk-flex-center uk-flex-middle">
            <img width="32" height="32"
                 src="<?php echo esc_url( $card['icon_svg'] ); ?>"
                 uk-svg
                 class="uk-preserve"
                 loading="lazy">
          </div>

          <div class="uk-card-body uk-padding-remove">

            <?php if ( ! empty( $card['cell_content']['card_title'] ) ) : ?>
              <h3 class="uk-margin-top-remove g-section-subtitle">
                <?php echo esc_html( $card['cell_content']['card_title'] ); ?>
              </h3>
            <?php endif; ?>

            <?php if ( ! empty( $card['cell_content']['card_text'] ) ) : ?>
              <?php echo wp_kses_post( $card['cell_content']['card_text'] ); ?>
            <?php endif; ?>

            <?php if ( ! empty( $card['cell_content']['card_button'] ) ) :
              $btn = $card['cell_content']['card_button'];
            ?>
              <a class="uk-button uk-button-<?php echo esc_attr( $button_style ); ?>"
                 href="<?php echo esc_url( $btn['url'] ); ?>"
                 <?php if ( ! empty( $btn['target'] ) ) : ?>target="<?php echo esc_attr( $btn['target'] ); ?>"<?php endif; ?>>
                <?php echo esc_html( $btn['title'] ); ?>
              </a>
            <?php endif; ?>

          </div>
        </div>
      </div>

    <?php endforeach; ?>
  <?php endif; ?>

</div>
