<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */

function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');



/**
 * Clean up the_excerpt()
 */

function excerpt_length() {
    return 22;
}
add_filter('excerpt_length', __NAMESPACE__ . '\\excerpt_length', 999);

function excerpt_more() {
  return '...';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');





/**
 * Move Yoast to Bottom
 */

 function yoast_to_bottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\\yoast_to_bottom' );