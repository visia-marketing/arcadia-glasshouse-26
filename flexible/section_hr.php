<?php
$style = get_sub_field('hr_style') ?: 'solid';
$color = get_sub_field('hr_color') ?: 'primary';
?>

<hr class="fc-hr fc-hr--<?php echo esc_attr( $style ); ?> fc-hr--<?php echo esc_attr( $color ); ?>">
