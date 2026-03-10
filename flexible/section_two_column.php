
  <?php //get_template_part('flexible/section_header'); ?>  

  <?php 
  $column_ratio = get_sub_field('column_ratio');
  $content_alignment = get_sub_field('content_alignment');

  $reverse = get_sub_field('reverse');


  $left_col = '';
  $right_col = '';


switch ($column_ratio) {
  case 1:
    $left_col = 'uk-width-1-4@m';
    $right_col = 'uk-width-3-4@m';
    break;
  case 2:
    $left_col = 'uk-width-1-3@m';
    $right_col = 'uk-width-2-3@m';
    break;
  case 4:
    $left_col = 'uk-width-2-3@m';
    $right_col = 'uk-width-1-3@m';
    break;
  case 5:
    $left_col = 'uk-width-3-4@m';
    $right_col = 'uk-width-1-4@m';
    break;
  default:
    $left_col = 'uk-width-1-2@m';
    $right_col = 'uk-width-1-2@m';  
}


  ?>

<div class="fc-section-columns">
  <div class="uk-flex uk-grid-large uk-child-width-expand uk-flex-left" uk-grid>

      <div class="uk-width-1-1@s <?php echo $left_col; ?> uk-flex-stretch content column">
        <div class="content uk-width-1-1 uk-flex uk-flex-column uk-height-1-1 uk-flex-stretch uk-flex-<?php echo $content_alignment; ?>">
          <?php echo get_sub_field('column_1'); ?>
        </div>
      </div>
      <div class="k-width-1-1@s <?php echo $right_col; ?> uk-flex-stretch column <?php if($reverse): ?>uk-flex-first<?php endif; ?>">
        <div class="content  uk-width-1-1 uk-flex uk-flex-column uk-height-1-1  uk-flex-<?php echo $content_alignment; ?>">
          <?php echo get_sub_field('column_2'); ?>
        </div>
      </div>

  </div>
</div>