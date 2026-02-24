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
    $greenhouse['card_button_label'] = get_field('button_label', $gh);
    $greenhouse['card_link'] = get_permalink($gh);
    $greenhouse['card_icon'] = get_post_thumbnail_id($gh);

    $greenhouses[] = $greenhouse;


}
?>

<div class="greenhouses">
    <?php foreach( $greenhouses as $i => $greenhouse ): ?>
        <div class="uk-grid uk-grid-large">

            <?php 
            
            // if the index is odd, align the image to the right
            $align = ($i % 2) ? 'uk-align-right' : 'uk-align-left';
            ?>

            <div class="uk-width-1-2@m" >
                <?php echo wp_get_attachment_image( $greenhouse['card_icon'], 'square' , false, array('class' =>  $align ) ); ?>
            </div>

            <div class="uk-width-1-2@m <?php if($i % 2): echo "uk-flex-first@m"; endif; ?> uk-flex uk-flex-column uk-flex-center">

                <div class="row-content">
                    <span class="g-section-subtitle"><?php echo $greenhouse['card_collection'] ?></span>
                    <h2 class="uk-margin-top-remove"><?php echo $greenhouse['card_title']; ?></h2>
                    <?php echo $greenhouse['card_description']; ?>

                    <a href="<?php echo $greenhouse['card_link'] ?>" class="uk-button uk-button-primary uk-margin-top"><?php echo $greenhouse['card_button_label'];?></a>
                </div>
            </div>

            <hr class="uk-width-1-1 uk-margin-large-left uk-margin-large-top"/>

        </div>
    <?php endforeach; ?>
</div>

