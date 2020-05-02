<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $wp_query;

$target_cat = ( ! empty( $wp_query ) && ! empty( $wp_query->query_vars['pagename'] ) && $wp_query->query_vars['pagename'] !== 'products' ) ? $wp_query->query_vars['pagename'] : false;

$args = array(
	'post_type' => 'product',
	'tax_query' => array(
		array(
			'taxonomy' => 'prod_category',
			'field'    => 'slug',
			'terms'    => array( $target_cat . '-cat' ),
		),
	),
);

$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) {
	echo '<div class="product-container">';
	while ( $wp_query->have_posts() ) {
		$wp_query->the_post();
		get_template_part( 'content', 'product' );
	}
	wp_reset_query();
	echo '</div>';
}