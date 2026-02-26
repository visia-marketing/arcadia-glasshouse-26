<article class="post-single">

  <header class="fc-page-header page-header fc-section-dark uk-margin-xlarge-bottom " id="page_header_<?php echo get_the_ID();?>">

      <div class="page-header-content-wrapper fc-section  page-header-">
        <div class="uk-container uk-container-large">
          <div class="uk-text-center">
            <div class="page-header-content">
              
                <p class="uk-align-left category-name">
                  <?php the_title(); ?>
                </p>

            </div>
          </div>
        </div>
      </div>
    </header>

  <?php //get_template_part('templates/page-breadcrumbs'); ?>
  <section class="post-content-wrapper">
    <div class="uk-container uk-container-large uk-flex uk-margin-auto-left uk-margin-auto-right">
      <div class="uk-width-1-1 uk-width-2-3@m uk-margin-large-left">
        <?php get_template_part('partials/content', 'single'); ?>
        <?php //the_posts_navigation(); ?>
      </div>
      <div class="uk-width-1-1 uk-width-1-3@m uk-flex-first@m">
        <?php get_template_part('partials/post', 'sidebar'); ?>
      </div>
    </div>
  </section>
</article>

<?php
  $ornament = get_field('ornament');

  // if ornament align == 0 value is 'right' if 1 value is 'left'
  $ornament_align = 'right';
  // get the relatiuve path to the svgs directory in the theme assets assets/src/svg folder
  $svg_path = get_template_directory() . '/assets/src/svg/';
  $ornament_svg = '';
  $ornament_svg = file_get_contents($svg_path.'ornament_'.$ornament.'.svg');
  if ($ornament) { 
    echo '<div id="ornament_'.$id.'" class="uk-container uk-container-xlarge ornament-container uk-flex uk-flex-'.$ornament_align.' uk-margin-auto-left uk-margin-auto-right">';
      echo '<div class="ornament">';
        echo $ornament_svg;
      echo '</div>';
    echo '</div>';
  }
?>