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
$categories = get_categories( array( 'taxonomy' => 'prod_category' ) );
foreach ( $categories as $category ) {

	$args = array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
				'taxonomy' => 'prod_category',
				'field'    => 'slug',
				'terms'    => array( $category->slug ),
			),
		),
	);

	echo sprintf( "<h3>%s</h3>", $category->name );

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
}