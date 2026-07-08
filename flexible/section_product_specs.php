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
                    $download = $product['spec_sheet'];
                    
                    // Extract the download ID from the array/object
                    $download_id = null;
                    if ( is_array( $download ) && ! empty( $download[0] ) ) {
                        $download_id = $download[0]->ID;
                    } elseif ( is_object( $download ) && isset( $download->ID ) ) {
                        $download_id = $download->ID;
                    } elseif ( is_numeric( $download ) ) {
                        $download_id = $download;
                    }
                    
                    if ( $download_id ) {
                        try {
                            $dlm_download = download_monitor()->service( 'download_repository' )->retrieve_single( $download_id );
                        } catch ( Exception $exception ) {
                            $dlm_download = null;
                        }

                        if ( $dlm_download ) : 
                            // Capture the output from the_download_link() if it echoes
                            $link = '';
                            if ( method_exists($dlm_download, 'get_download_url') ) {
                                $link = $dlm_download->get_download_url();
                            } elseif ( method_exists($dlm_download, 'get_download_link') ) {
                                $link = $dlm_download->get_download_link();
                            } else {
                                ob_start();
                                $dlm_download->the_download_link();
                                $link = ob_get_clean();
                            }
                        ?>

                            <div class="download-cell">  
                                <a href="<?php echo esc_url( $link ); ?>" class="uk-button uk-button-primary" target="_blank">
                                    Download Spec Sheet
                                </a>
                            </div>

                        <?php endif; ?>
                    <?php } ?>   

                <?php endif; ?>
             </div>



        </div>


    <?php endforeach; ?>



</div>

