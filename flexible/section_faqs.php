<?php
$style  = get_sub_field('faq_style');
$faqs   = get_sub_field('questions_and_answers');
$length = is_array( $faqs ) ? count( $faqs ) : 0;

// Determine container and item classes based on style
$faq_container_class = 'fc-faq-section';
$faq_class           = '';
$faq_item_class      = 'faq-item';
$question_class      = 'faq-question';
$answer_class        = 'faq-answer';

if ( $style === 'plain' ) {
  $faq_class .= 'plain-faq';
} else {
  $faq_container_class .= ' fc-section-accordion-simple';
  $faq_class            = 'accordion';
  $faq_item_class      .= ' accordion-item';
  $question_class       = 'accordion-topic';
  $answer_class         = 'accordion-response';

  if ( $style === 'separated' ) {
    $faq_class .= ' separated';
  }
}
?>

<div class="fc-section-columns <?php echo esc_attr( $faq_container_class ); ?>">
  <?php get_template_part('flexible/section_header'); ?>

  <?php if ( is_array( $faqs ) ) : ?>
    <ul class="uk-accordion uk-accordion-default" uk-accordion>

      <?php foreach ( $faqs as $faq ) : ?>
        <li class="uk-margin-remove-top">
          <a class="uk-accordion-title uk-flex uk-flex-middle uk-flex-between" href>
            <h4 class="uk-margin-top uk-margin-bottom"><?php echo esc_html( $faq['question'] ); ?></h4>
            <span uk-icon="icon: chevron-down; ratio: 1.5"></span>
          </a>
          <div class="uk-accordion-content uk-margin-medium-bottom">
            <?php echo wp_kses_post( $faq['answer'] ); ?>
          </div>
        </li>
      <?php endforeach; ?>

    </ul>
  <?php endif; ?>
</div>

<?php
// Build FAQ schema as a PHP array and encode it properly — no manual comma handling needed
if ( is_array( $faqs ) && $length > 0 ) :
  $schema_items = [];
  foreach ( $faqs as $faq ) {
    $schema_items[] = [
      '@type' => 'Question',
      'name'  => wp_strip_all_tags( $faq['question'] ),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => wp_strip_all_tags( $faq['answer'] ),
      ],
    ];
  }

  $schema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => $schema_items,
  ];
?>
<script type="application/ld+json">
<?php echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ); ?>
</script>
<?php endif; ?>
