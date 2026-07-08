<?php $products = get_sub_field('products'); ?>

<div class="fc-section-product-specs">

    <?php foreach( $products as $product ): ?>


        <div class="uk-flex uk-grid uk-flex-wrap uk-width-1-1 uk-flex-between uk-margin-large-bottom">
        

            <div class="uk-width-expand uk-margin-bottom uk-flex uk-flex-row uk-flex-center uk-padding-remove-left">
                <?php $image = wp_get_attachment_image( $product['image_1'], 'medium', false, [ 'class' => 'uk-width-1-1', 'loading' => 'lazy', 'style' => 'object-fit: contain;' ] ); ?>
                <?php if ( $image ) : ?>
                        <?php echo $image; ?>
                <?php endif; ?>
            </div>


            <div class="uk-width-expand uk-margin-bottom uk-flex uk-flex-row uk-flex-center uk-padding-remove-left">
                <?php $image2 = wp_get_attachment_image( $product['image_2'], 'medium', false, [ 'class' => ' uk-width-1-1 uk-margin-remove-right', 'loading' => 'lazy', 'style' => 'object-fit: contain;' ] ); ?>
                <?php if ( $image2 ) : ?>
                        <?php echo $image2; ?>
                <?php endif; ?>
            </div>


             <div class="uk-width-1-3@m uk-width-1-1@m">
                <h3 class=""><?php echo esc_html( $product['product_title'] ); ?></h3>
                <p class="uk-margin-remove"><?php echo wp_kses_post( $product['product_text'] ); ?></p>


                <?php if ( ! empty( $product['spec_sheet'] ) ) : ?>

                    <?php
                        if ( function_exists( 'download_monitor' ) ) {
                            // Replace 123 with your actual Download ID
                            $download_id = $product['spec_sheet']->ID; 
                            
                            try {
                                $download = download_monitor()->service( 'download_repository' )->retrieve_single( $download_id );
                                $download_url = $download->get_the_download_link();
                                
                                echo esc_url( $download_url );
                            } catch ( Exception $e ) {
                                // Handle case where download item doesn't exist
                            }
                        }

                    ?>



                    <a href="<?php echo esc_url( $download_url ); ?>" class="button uk-button uk-button-default uk-button-primary">Download Specs</a>
                <?php endif; ?>
             </div>



        </div>


    <?php endforeach; ?>



</div>

