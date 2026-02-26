<div class="post-sidebar">

	<?php

	// get current cost category
	$category = get_the_category();
	$cat_name = $category[0]->name;
	?>
	
	<?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 25, 'post__not_in' => array($post->ID) ) ); ?>

	<?php if($related){ ?>

		<div class="post-sidebar-related-posts uk-padding uk-margin-large-bottom">

			<h3 class="g-section-subtitle">More <?php echo $cat_name;?> </h3>

			<ul class="uk-padding-remove"> 
				<?php foreach($related as $post ) { ?>

					<?php setup_postdata($post); ?>

					<li class="">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</li>

					<?php wp_reset_postdata(); ?>
				

				<?php } ?>
		  	</ul>

		</div> 
	
	<?php } ?>

	

</div>
