<?php /*
$footer_form = get_field('footer_form');
if ( $footer_form && (!empty($footer_form['heading']) || !empty($footer_form['title']) || !empty($footer_form['form_id'])) ): ?>
  <div class="site-footer-form">
    <div class="uk-container columns">
      <?php if ( $footer_form['heading'] ): echo '<h2 class="g-style-section-heading">' . $footer_form['heading'] . '</h2>'; endif; ?>
      <?php if ( $footer_form['title'] ): echo '<h3 class="g-style-section-title">' . $footer_form['title'] . '</h3>'; endif; ?>
      <?php echo do_shortcode('[gravityform id="' . $footer_form['form_id'] . '" title="false"]');?>
    </div>
  </div>
<?php endif; */ ?>

<footer class="main-footer">

  <div class="uk-container uk-container-large uk-flex uk-flex-wrap">   

    <div class="uk-width-1-1@s uk-width-1-3@m uk-width-1-3@xl uk-margin-medium-bottom uk-margin-remove-bottom@m">
      <div class="footer-logo">
        <a href="<?= esc_url(home_url('/')); ?>"><img src="<?php the_field('footer_logo', 'option');?>" alt="<?php bloginfo('name'); ?>"></a>
      </div>
    </div>

    <div class="uk-width-1-1@s uk-width-2-3@m uk-width-2-3@xl  uk-margin-medium-bottom uk-margin-remove-bottom@m">
      <div class="uk-grid uk-grid-small">

        <div class="uk-width-1-1@s uk-width-1-4@m ">   
          <?php
          if (has_nav_menu('footer_navigation_1')) :
          wp_nav_menu(['theme_location' => 'footer_navigation_1', 'depth' => 2, 'menu_class' => 'footer-menu' ]); 
          endif;
          ?>
        </div>

        <div class="uk-width-1-1@s uk-width-1-4@m">   
          <?php
          if (has_nav_menu('footer_navigation_2')) :
          wp_nav_menu(['theme_location' => 'footer_navigation_2', 'depth' => 2, 'menu_class' => 'footer-menu ' ]); 
          endif;
          ?>
        </div>

        <div class="uk-width-1-1@s uk-width-1-4@m ">   
          <?php
          if (has_nav_menu('footer_navigation_3')) :
          wp_nav_menu(['theme_location' => 'footer_navigation_3', 'depth' => 2, 'menu_class' => 'footer-menu ' ]); 
          endif;
          ?>
        </div>

        <div class="uk-width-1-1@s uk-width-1-4@m">
          <div class="uk-flex uk-flex-column uk-flex-middle uk-flex-top@m">
            <p class="connect">Connect with Us</p>

            <?php $social_media = get_field('social_media', 'options'); ?>
            <div class="social-icons uk-margin-small-top uk-flex uk-flex-wrap uk-flex-left">
              <?php foreach( $social_media as $social ): ?>
                <a href="<?php echo $social['url']; ?>" target="_blank" class="uk-margin-small-right">
                  <i class="fa-brands fa-<?php echo $social['social_icon']; ?> fa-2xl"></i>
                </a>
              <?php endforeach; ?>
            </div>

            <?php $footer_badges = get_field('footer_badges', 'options'); ?>
            <div class="badges uk-margin-medium-top uk-flex uk-flex-wrap uk-flex-left">
              <?php foreach( $footer_badges as $badge ): ?>
                <a href="<?php echo $badge['badge_url']; ?>" target="_blank" class="uk-width-small uk-margin-small-right">
                  <?php echo wp_get_attachment_image( $badge['badge_image'], 'medium' , false, array('class' => 'footer-badge') ); ?>
                </a>
              <?php endforeach; ?>
            </div>
            
        </div>

      </div> <!-- .uk-grid -->
    </div><!-- .uk-width-1-2 -->

    
  </div> <!-- uk container -->
  
  <div class="uk-container uk-container-large uk-margin-xlarge-top uk-flex uk-flex-left uk-width-1-1 copyright-container">
    <div class="footer-copyright">
      <div class="copyright">
        <?php echo get_field('copyright', 'options');?>
      </div>
      <?php
        if (has_nav_menu('footer_navigation_legal')) :
        wp_nav_menu(['theme_location' => 'footer_navigation_legal', 'depth' => 1, 'menu_class' => 'footer-menu-legal' ]); 
        endif;
      ?>
    </div>
  </div>

</footer>