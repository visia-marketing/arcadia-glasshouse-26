<head>
	
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php $font = get_field( 'google_typekit_font_url', 'options'); ?>
  <?php if( str_contains( $font, 'google' ) || empty($font) ): ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php endif; ?>



  <?php wp_head(); ?>

  <?php
  // Organization schema — edit values via Appearance > Customize or ACF Options
  $org_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => get_bloginfo('name'),
    'url'      => esc_url( home_url('/') ),
    'logo'     => esc_url( get_field('main_logo', 'option') ?: '' ),
  ];
  $phone = get_field('phone_number', 'option');
  $email = get_field('email_address', 'option');
  if ( $phone ) $org_schema['telephone'] = esc_html( $phone );
  if ( $email ) $org_schema['email']     = esc_html( $email );
  ?>
  <script type="application/ld+json"><?php echo wp_json_encode( $org_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?></script>

  <?php if ( get_field('google_tag_manager_id', 'options') ):?>
    <!-- Google Tag Manager -->
    <script nonce="<?php echo $csp_nonce;?>">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo esc_js( get_field('google_tag_manager_id', 'options') ); ?>');</script>
    <!-- End Google Tag Manager -->
  <?php endif; ?>

</head>
