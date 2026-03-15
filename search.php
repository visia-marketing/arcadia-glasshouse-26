<article class="page page-search">

  <section class="page-content">
    <div class="uk-container">
      <div class="small-12 columns">

        <br>
        <p><br><?php _e( 'Search Results Found For', 'visia_starter_theme' ); ?>: "<?php the_search_query(); ?>"</p>

        <?php if ( have_posts() ) : ?>

          <div class="search-results-wrapper">

            <?php while ( have_posts() ) : the_post(); ?>

              <?php
              // Use Yoast SEO title if available, otherwise fall back to post title
              if ( get_post_meta( $post->ID, '_yoast_wpseo_title', true ) ) {
                $title = get_post_meta( $post->ID, '_yoast_wpseo_title', true );
              } else {
                $title = get_the_title();
              }

              // Use excerpt if available, otherwise fall back to Yoast meta description
              $excerpt = has_excerpt()
                ? get_the_excerpt()
                : get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
              ?>

              <div class="search-results-cell">
                <?php if ( get_the_post_thumbnail() ) : ?>
                  <div class="search-results-cell-image">
                    <?php the_post_thumbnail( [ 100, 100 ] ); ?>
                  </div>
                <?php endif; ?>

                <div class="search-results-cell-content">
                  <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $title ); ?></a></h2>
                  <span class="search-permalink"><?php the_permalink(); ?></span>
                  <p><?php echo esc_html( $excerpt ); ?></p>
                  <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="read-more">
                    Read More <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>

            <?php endwhile; ?>

          </div>

          <div class="search-pagination">
            <?php echo paginate_links(); ?>
          </div>

        <?php else : ?>

          <div class="search-results-wrapper">
            <div class="search-results-none">
              <?php echo wp_kses_post( get_field('no_results_message', 'options') ); ?>
            </div>
          </div>

        <?php endif; ?>

      </div>
    </div>
  </section>

</article>
