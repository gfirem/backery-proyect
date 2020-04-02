<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bakery_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'bakery_theme_enqueue_styles' );
