<div class="post-header">
  
  <?php if( get_field('tip_number') ): ?>
    <p class="g-section-subtitle">
      <?php echo 'Greenhouse Tip #'. get_field('tip_number'); ?>
    </p>
  <?php endif; ?>

  <h1 class="post-title uk-margin-xsmall-top"><?php echo get_the_title(); ?></h1>


</div>
<div class="post-content">
  <?php the_content();?>
</div>