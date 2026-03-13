<?php
$card_source = get_sub_field('card_source'); // Manual or Post Type
$cards = get_sub_field('cards');
$display = get_sub_field('cards_display'); // Grid or Slider
$per_row = get_sub_field('cards_per_row'); // 3, 4, 5

$aos = get_sub_field('animate_in');
$aos_duration = 0;
$aos_step = 0;

$show_loadmore = 0;

if( $card_source == "greenhouse" ){

    $cards = array();
    $gh_cards = get_sub_field('greenhouses');
    foreach( $gh_cards as $gh  ){
        $card = array();
        $card['card_collection'] = get_field('series_label', $gh);
        $card['card_title'] = get_field('long_name', $gh) ? get_field('long_name', $gh) : get_the_title($gh);
        $card['card_description'] = get_field('short_excerpt', $gh);
        $card['card_link']['url'] = get_permalink($gh);
        $card['card_icon'] = get_post_thumbnail_id($gh);
        $cards[] = $card;
    }

}


if( $card_source == "categories" ){
    $cards = array();
    $blog_categories = get_sub_field('categories');

    if (isset($_GET['paged'])) {
        set_query_var('paged', (int) $_GET['paged']);
    }

    // build query args
    $args = array(
        'post_type' => 'post',
        'category__in' => $blog_categories,
        'posts_per_page' => 12,
        'paged' => get_query_var('paged') ?: 1,
        'ignore_sticky_posts' => true,
    );

    $blogs_query = new WP_Query($args);
    $query_found_posts = $blogs_query->found_posts;
    
    

    if ($blogs_query->max_num_pages > 1) {
        $show_loadmore = 1;
    }
    
    foreach( $blogs_query->posts as $blog_post ){

        $card = array();
        $card['card_tip'] = get_field('tip_number', $blog_post->ID);
        $card['card_title'] = get_the_title($blog_post->ID);
        $excerpt = wp_strip_all_tags(get_the_excerpt($blog_post->ID));
        $content = wp_strip_all_tags(excerpt_remove_blocks($blog_post->post_content));
        $card['card_description'] = $excerpt ?: ($content ? wp_trim_words($content, 12, null) : '');
        $card['card_link']['url'] = get_permalink($blog_post->ID);
        $card['card_icon'] = get_post_thumbnail_id($blog_post->ID) ?: 245;
        $cards[] = $card;

    }

}


$rand_id = $display . '_' . wp_generate_uuid4();

if ($aos == 'no_animation') {
    $aos = false;
}else{
    $aos_duration = get_sub_field('duration');
    $aos_step = get_sub_field('animation_step');
}

$class = ' uk-card uk-margin-bottom ';

switch ($per_row) {
    case 2:
        $class .= ' uk-width-1-1@xs uk-width-1-2@m';
        break;
    case 3:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m';
        break;
    case 4:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-4@l';
        break; 
    default:
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-6@m'; // Default to 3 per uk-container
}


?>


    <?php //get_template_part('flexible/section_header'); ?>
    

    <?php if($display == "carousel"): ?>
        <div id="<?php echo $rand_id;?>" class="fc-section-cards carousel-wrapper"  data-slides-to-show="<?php echo $per_row; ?>" data-duration="<?php echo $aos_duration; ?>" data-step="<?php echo $aos_step; ?>">
    <?php elseif($display == "simple"): ?>
        <div id="<?php echo $rand_id;?>" class="fc-section-cards fc-section-cards-simple grid-container uk-grid uk-grid-small uk-grid-match">
    <?php else: ?>
        <div id="<?php echo $rand_id;?>" class="fc-section-cards grid-container uk-grid uk-grid-small uk-grid-match">
    <?php endif; ?>
    <?php $delay = 0; ?>

        <?php foreach( $cards as $card ): ?>

        <?php
            $delay += $aos_step;
            $args = array(
                'card_obj' => $card,
                'aos' => $aos,
                'delay' => $delay,
                'duration' => $aos_duration,
                'step' => $aos_step,
                'per_row' => $per_row
            );
        ?>
            <?php get_template_part( 'partials/content' , 'card', $args); ?>
        <?php  if ($delay >= ($aos_step * $per_row)) { $delay = 0; } ?>

        <?php endforeach; ?>

    </div>

    <?php if($show_loadmore): ?>
        <div class="uk-margin-auto-left uk-margin-auto-right uk-flex uk-flex-column uk-flex-middle" id="load_more_posts__container">
            <button id="load_more_posts" class="uk-width-small uk-flex uk-flex-column uk-flex-center uk-flex-middle" data-max-pages="<?php echo esc_attr($blogs_query->max_num_pages); ?>">
                <span>Load More </span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="18" viewBox="0 0 28 18" fill="none">
                    <path d="M12.1987 16.7163C12.9555 17.5633 14.1846 17.5633 14.9415 16.7163L26.5665 3.70515C27.3233 2.85807 27.3233 1.48242 26.5665 0.635342C25.8096 -0.211736 24.5805 -0.211736 23.8237 0.635342L13.567 12.1149L3.3104 0.642117C2.55356 -0.20496 1.32446 -0.20496 0.567627 0.642117C-0.189209 1.48919 -0.189209 2.86485 0.567627 3.71193L12.1926 16.723L12.1987 16.7163Z" fill="#347763"/>
                </svg>
                <div class="loader"></div>
            </button>
        </div>
    <?php endif; ?>

<?php if($display == "carousel"): ?>

    <style>

        #<?php echo $rand_id;?> .carousel-wrapper .slick-prev:before,
        #<?php echo $rand_id;?> .carousel-wrapper .slick-next:before{
            content: '' !important;
        }

        #<?php echo $rand_id;?> .carousel-wrapper svg *{
            stroke: #072E6E;
        }

    </style>
<?php endif; ?>