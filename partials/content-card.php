<?php

$card = $args['card_obj'];

// if( !is_array( $card) ){
//     $post = get_post($card);

//     $card = [];
    
//     // // Collection
//     $terms = get_the_terms($post->ID, 'collection');
//     if( $terms && ! is_wp_error( $terms ) ){
//         $term = $terms[0];
//         $card['card_collection'] = $term->name;
//     }

//     // Blog Category
//     $categories = get_the_terms($post->ID, 'category');
//     if( $categories && ! is_wp_error( $categories ) ){
//         $category = $categories[0];
//         $card['card_category'] = $category->name;
//     }


//     $card['card_title'] = get_field('long_name', $post->ID) ? get_field('long_name', $post->ID) : get_the_title($post->ID);
//     $card['card_description'] = get_field('short_excerpt', $post->ID);
//     $card['card_link']['url'] = get_permalink($post->ID);
//     $card['card_icon'] = get_post_thumbnail_id($post->ID);
    
// }

$delay = $args['delay'];
$per_row = $args['per_row'];
$aos = $args['aos'];
$aos_duration = $args['duration'];


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
        $class .= ' uk-width-1-1@xs uk-width-1-2@s uk-width-1-3@m'; // Default to 3 per uk-container
}


?>


<div class="<?php echo $class; ?>" <?php if($aos != false): ?>data-aos="<?php echo $aos; ?>" data-aos-duration="<?php echo $aos_duration; ?>" data-aos-delay="<?php echo $delay; ?>"<?php endif; ?> data-hover-card> 
    <div class="uk-height-1-1 uk-flex uk-flex-column uk-position-relative" >

        <?php $image = wp_get_attachment_image($card['card_icon'], 'thumbnail', false, array( 'class' => 'uk-width-1-1')); ?>
                
        <?php if( $image ): ?>
            <div class="card-media uk-card-media-top">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>
        

            <a href="<?php echo $card['card_link']['url']; ?>" class="card-body uk-card-body uk-height-1-1 uk-width-1-1 uk-position-absolute uk-flex uk-flex-column uk-flex-right">


                <?php if( array_key_exists( 'card_tip', $card) ): ?>
                    <?php if( !empty($card['card_tip']) ): ?>
                        <span class="card-tip">Tip <?php echo $card['card_tip']; ?></span>
                    <?php endif; ?>
                <?php endif ;?>


                <?php if( array_key_exists('card_collection', $card) ): ?>
                    <span class="g-section-subtitle">
                        <?php echo $card['card_collection']; ?>
                    </span>
                <?php endif; ?>

                <h3 class="card-title uk-card-title uk-margin-remove">
                    <?php echo $card['card_title']; ?>
                </h3>

                <?php if( $card['card_description'] != ''): ?>
                    <p class="card-p uk-margin-remove">
                        <?php echo $card['card_description']; ?>
                    </p>
                <?php endif; ?>

            </a>

    </div>
</div>