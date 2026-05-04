<?php
$size = get_sub_field('spacer_size') ?: 'medium';

$heights = [
  'small'  => '2rem',
  'medium' => '4rem',
  'large'  => '8rem',
  'xlarge' => '12rem',
];

if ( $size === 'custom' ) {
  $height = get_sub_field('spacer_custom') ?: '4rem';
} else {
  $height = $heights[ $size ] ?? '4rem';
}
?>

<div class="fc-spacer fc-spacer--<?php echo esc_attr( $size ); ?>" style="height: <?php echo esc_attr( $height ); ?>;"></div>
