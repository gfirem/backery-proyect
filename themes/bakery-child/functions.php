<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bakery_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'bakery_theme_enqueue_styles' );

function bakery_theme_template( $template ) {
	global $post;

	if ( ! empty( $post ) && $post->post_parent === 25 ) {
		$locate_template = locate_template( 'page-products.php' );
		if ( ! empty( $locate_template ) ) {
			return $locate_template;
		}
	}

	return $template;
}

add_filter( 'page_template', 'bakery_theme_template' );