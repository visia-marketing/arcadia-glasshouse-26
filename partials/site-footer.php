<footer class="main-footer">

  <div class="uk-container uk-container-large uk-flex uk-flex-wrap">   

    <div class="uk-width-1-1@s uk-width-1-3@m uk-width-1-3@xl uk-margin-medium-bottom uk-margin-remove-bottom@m">
      <div class="footer-logo">
        <a href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo esc_url( get_field('footer_logo', 'option') ); ?>" alt="<?php bloginfo('name'); ?>" loading="lazy"></a>
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
              <?php if( $social_media ): foreach( $social_media as $social ): ?>
                <a href="<?php echo esc_url($social['social_url']); ?>" target="_blank" class="uk-margin-small-right">
                  <i class="fa-brands fa-<?php echo esc_attr($social['social_icon']); ?> fa-2xl"></i>
                </a>
              <?php endforeach; endif; ?>
            </div>

            <?php $footer_badges = get_field('footer_badges', 'options'); ?>
            <div class="badges uk-margin-medium-top uk-flex uk-flex-wrap uk-flex-left">
              <?php foreach( $footer_badges as $badge ): ?>
                <a href="<?php echo esc_url( $badge['badge_url'] ); ?>" target="_blank" class="uk-width-small uk-margin-small-right">
                  <?php echo wp_get_attachment_image( $badge['badge_image'], 'medium' , false, array('class' => 'footer-badge') ); ?>
                </a>
              <?php endforeach; ?>
            </div>

          </div>
        </div>

      </div> <!-- .uk-grid -->
    </div><!-- .uk-width-1-2 -->

    
  </div> <!-- uk container -->
  
  <div class="uk-container uk-container-large uk-margin-xlarge-top uk-flex uk-flex-left uk-width-1-1 copyright-container">
    <div class="footer-copyright">
      <div class="copyright">
        <?php echo wp_kses_post( get_field('copyright', 'options') ); ?>
      </div>
      <?php
        if (has_nav_menu('footer_navigation_legal')) :
        wp_nav_menu(['theme_location' => 'footer_navigation_legal', 'depth' => 1, 'menu_class' => 'footer-menu-legal' ]); 
        endif;
      ?>
    </div>
  </div>

</footer>