<?php
$accordion        = get_sub_field('accordion');
$accordion_layout = get_sub_field('accordion_layout');

$container_class = 'fc-section-accordion-simple ' . esc_attr( $accordion_layout );
?>

<div class="fc-section-columns <?php echo esc_attr( $container_class ); ?>">

  <?php if ( is_array( $accordion ) ) : ?>
    <ul class="uk-accordion uk-accordion-default" uk-accordion>

      <?php foreach ( $accordion as $item ) : ?>
        <li class="uk-margin-remove-top">
          <a class="uk-accordion-title uk-flex uk-flex-middle uk-flex-between" href>
            <h4 class="uk-margin-top uk-margin-bottom"><?php echo esc_html( $item['heading'] ); ?></h4>
            <span uk-icon="icon: chevron-down; ratio: 1.5"></span>
          </a>
          <div class="uk-accordion-content uk-margin-medium-bottom">
            <?php echo wp_kses_post( $item['content'] ); ?>
          </div>
        </li>
      <?php endforeach; ?>

    </ul>
  <?php endif; ?>

</div>
