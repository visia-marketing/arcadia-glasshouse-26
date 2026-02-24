<?php



$objects = get_sub_field('greenhouses');
$greenhouses = array();

foreach( $objects as $gh  ){
    $greenhouse = array();


    $terms = get_the_terms($gh, 'collection');

    if( $terms && ! is_wp_error( $terms ) ){
        $term = $terms[0];
        $greenhouse['card_collection'] = $term->name;
    }

    $greenhouse['card_title'] = get_the_title($gh);
    $greenhouse['card_description'] = get_field('long_excerpt', $gh);
    $greenhouse['card_link'] = get_permalink($gh);
    $greenhouse['card_icon'] = get_post_thumbnail_id($gh);

    $greenhouses[] = $greenhouse;


}
?>
    <?php foreach( $greenhouses as $i => $greenhouse ): ?>
        <div class="uk-grid uk-grid-large">

            <div class="uk-width-1-2@m">
                <?php echo wp_get_attachment_image( $greenhouse['card_icon'], 'square' ); ?>
            </div>

            <div class="uk-width-1-2@m <?php if($i % 2): echo "uk-flex-first@m"; endif; ?>">

                <span class="g-section-subtitle"><?php echo $greenhouse['card_collection'] ?></span>
                <h3><?php echo $greenhouse['card_title']; ?></h3>
                <?php echo $greenhouse['card_description']; ?>

                <a href="<?php echo $greenhouse['card_link'] ?>" class="uk-button uk-button-primary uk-margin-top">View <?php echo $greenhouse['card_title']; ?> Series</a>



            </div>

        </div>
    <?php endforeach; ?>


