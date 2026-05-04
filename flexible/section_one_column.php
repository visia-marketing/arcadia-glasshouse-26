<?php
$column_width_raw = get_sub_field('column_width');
$column_align     = get_sub_field('column_align');

// Map numeric choice to UIKit width fraction
switch ( $column_width_raw ) {
  case 1:  $column_width = '1-6'; break;
  case 2:  $column_width = '1-3'; break;
  case 3:  $column_width = '1-2'; break;
  case 4:  $column_width = '2-3'; break;
  case 5:  $column_width = '5-6'; break;
  default: $column_width = '1-1'; break;
}
?>

<div class="fc-section-columns fc-section-one-column">
  <div class="uk-flex uk-flex-<?php echo esc_attr( $column_align ); ?>">
    <div class="content uk-width-<?php echo esc_attr( $column_width ); ?>">
      <?php echo get_sub_field('column_1'); ?>
    </div>
  </div>
</div>
