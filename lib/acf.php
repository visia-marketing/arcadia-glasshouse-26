<?php

/**
 * Auto-Collapse ACF Flexible Content Layouts in Admin
 * 
 * Improves the admin UI experience by automatically collapsing all flexible content
 * layouts when the page loads. This prevents long, unwieldy edit screens when there
 * are many flexible content blocks.
 * 
 * Note: '.clones .layout' are excluded as these are the template/clone fields
 * that ACF uses internally and shouldn't be collapsed.
 */
add_action('acf/input/admin_head','my_acf_admin_head');
function my_acf_admin_head() { ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    // Add the collapsed class to all layouts except clone templates
    $('.layout').not('.clones .layout').addClass('-collapsed');
  });
  </script>
  <?php
}



/**
 * Convert String to URL-Safe Anchor
 * 
 * Transforms any string into a valid HTML anchor/ID by:
 * - Converting to lowercase
 * - Removing special characters
 * - Replacing spaces with hyphens
 * 
 * Example: "My Section Title!" becomes "my-section-title"
 * 
 * @param string $string The string to convert
 * @return string URL-safe anchor string
 */
function create_anchor($string) {
  $string = strtolower($string);                    // Convert to lowercase
  $string = preg_replace('/[^a-z0-9]+/', ' ', $string); // Replace non-alphanumeric with spaces
  $string = trim($string);                          // Remove leading/trailing spaces
  $string = str_replace(' ', '-', $string);         // Replace spaces with hyphens
  return $string;
}



/**
 * Render ACF Flexible Content Sections
 * 
 * Main function for outputting flexible content layouts.
 * Loops through all flexible content rows and renders each with appropriate
 * template parts and wrapper elements.
 * 
 * This creates a modular page builder system where editors can add/reorder
 * content sections through the WordPress admin.
 * 
 * Structure:
 * - Wrapper div with page-specific ID
 * - Individual sections for each flexible content row
 * - Dynamic classes and IDs for styling/JavaScript targeting
 * - Optional background images for sections
 */
function get_flexible_content() {
  // Check if the flexible_content field has any rows


  get_template_part('partials/page-header');
  

  if (have_rows('flexible_content')) {
    // Create main wrapper with unique ID based on page title
    echo '<div class="fc-wrapper" id="fc-wrapper-' . esc_attr(create_anchor(get_the_title())) . '">';

    // Loop through each flexible content row
    while (have_rows('flexible_content')) : the_row();
      /**
       * Get layout type and field values for current row
       */
      $id = get_sub_field('id') ?: 'fc-section-' . get_row_index(); // Custom ID or auto-generated fallback
      $class = get_sub_field('class') ?: '';                        // Optional custom CSS classes
      $border = get_sub_field('border') ?: '';                      // Border style classes   
      $background = get_sub_field('background') ?: '';              // Background type (color/image/etc)
      $background_image_id = get_sub_field('background_image');     // Background image attachment ID
      
      
      $padding_map = [ '0' => 'none', '3.25' => 'tiny', '5.5' => 'small', '7.75' => 'medium', '11' => 'large', '15.25' => 'xlarge' ];
      $spacing_map = [ '0' => 'none', '2.5' => 'tiny', '5' => 'small', '7' => 'medium', '9.5' => 'large', '11.5' => 'xlarge' ];

      $top_padding    = $padding_map[ get_sub_field('top_padding') ]    ?? get_sub_field('top_padding')    ?? 'none';
      $bottom_padding = $padding_map[ get_sub_field('bottom_padding') ] ?? get_sub_field('bottom_padding') ?? 'none';
      $content_spacing = $spacing_map[ get_sub_field('content_spacing') ] ?? get_sub_field('content_spacing') ?? 'none';
      $horizontal_align = get_sub_field('horizontal_align') ?: '';

      $container_map = [
        'small'                            => '',
        'regular'                          => 'uk-container-large',
        'large'                            => 'uk-container-xlarge',
        // Legacy: full class strings stored before this was simplified
        'uk-container'                     => '',
        'uk-container uk-container-large'  => 'uk-container-large',
        'uk-container uk-container-xlarge' => 'uk-container-xlarge',
      ];
      $container_modifier = $container_map[ get_sub_field('container_width') ] ?? '';

      // ornamentation
      $ornament = get_sub_field('ornament');
      $ornament_svg = '';

      $allowed_ornaments = [1, 2, 3, 4, 5, 6, 7];
      if( in_array((int) $ornament, $allowed_ornaments, true) ){
        $ornament_align = get_sub_field('ornament_alignment') == '0' ? 'left' : 'right';
        $svg_path = get_template_directory() . '/assets/src/svg/';
        $ornament_svg = file_get_contents($svg_path . 'ornament_' . (int) $ornament . '.svg');
      }



      // Background image via CSS custom property
      $bg_style = '';
      if ($background === 'image' && $background_image_id) {
        $background_image_url = wp_get_attachment_image_url($background_image_id, 'full');
        $bg_style = ' style="--bg-image: url(' . esc_url($background_image_url) . ')"';
      }





      /**
       * Build section element with dynamic classes
       * Classes include:
       * - fc-section: Base class for all sections
       * - fc-section-[index]: Numbered class for nth-child targeting
       * - fc-section-[background]: Background type class
       * - Custom classes from ACF fields
       */
      echo '<section class="fc-section fc-section-' . esc_attr(get_row_index()) . ' fc-section-' . esc_attr($background) . ' pt-' . esc_attr($top_padding) . ' pb-' . esc_attr($bottom_padding) . ' ' . esc_attr($class) . '" id="' . esc_attr($id) . '"' . $bg_style . '>';

        if ($ornament_svg) {
          echo '<div id="ornament_'.$id.'" class="uk-container uk-container-xlarge ornament-container uk-flex uk-flex-'.$ornament_align.'">';
            echo '<div class="ornament">';
              echo $ornament_svg;
            echo '</div>';
          echo '</div>';
        }

        ?>


        <?php if( strpos($background, 'grid-svg') !== false ): ?>
          <div class="grid-svg-wrapper">
            <?php 
              $svg_path = get_template_directory() . '/assets/src/svg/';
              $grid_svg = file_get_contents($svg_path.'grid.svg');
              echo $grid_svg;
              ?>
          </div>

        <?php endif; ?>


        <?php

        echo '<div class="uk-container ' . esc_attr($container_modifier) . ' uk-flex uk-flex-column uk-flex-' . esc_attr($horizontal_align) . ' gap-' . esc_attr($content_spacing) . '">';



          get_template_part('flexible/'.get_row_layout() );

        echo '</div>';  
      echo '</section>';

    endwhile;

    echo '</div>';
  }
}



