<?php while (have_posts()) : the_post(); ?>

  <article class="page page-flexible page-flexible-<?php echo get_post_type( $post->ID ); ?> page-<?php global $post; echo $post->post_name; ?>" id="overview">
    
    <?php get_template_part('templates/page-header'); ?>

    <?php get_flexible_content(); ?>

  </article>

<?php endwhile; ?>