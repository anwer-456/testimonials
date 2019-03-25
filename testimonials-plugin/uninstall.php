<?php
/**
 *$package Uninstall Plugin
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

//clear database data
// $testimonials = get_posts( array ( 'post_type'=>'testimonials', 'numberposts' => -1) );

//   foreach ($testimonials as $testimonial) {
//   	wp_delete_posts($testimonial->ID , true);
//   }

// Access the database via SQL
global $wpdb;
$wpdb->query(" DELETE FROM wp_posts WHERE post_type = 'testimonials'");
$wpdb->query(" DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");