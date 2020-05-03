<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryProducts extends BakeryBase {
	public function __construct() {
		parent::__construct();
		add_action( 'add_meta_boxes', array( $this, 'product_price_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'product_price_save' ) );
	}

	public function register_post_type() {
		register_post_type( 'product',
			array(
				'labels'              => array(
					'name'          => __( 'Products', 'bakery' ),
					'singular_name' => __( 'Product', 'bakery' ),
				),
				'public'              => false,
				'menu_icon'           => 'dashicons-store',
				'has_archive'         => true,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'query_var'           => true,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => 'product' ),
				'capability_type'     => 'post',
				'supports'            => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
				'taxonomies'          => array( 'prod_category' )
			)
		);

		register_taxonomy( 'prod_category', 'product', array(
			'public' => true,
			'hierarchical' => true,
			'show_tagcloud' => false,
			'rewrite' => array( 'slug' => 'product-category' )
		) );
	}

	public function product_price_meta_boxes() {
		add_meta_box( 'bakery-product-price', __( 'Product Price', 'bakery' ), array( $this, 'product_price_mb_callback' ), 'product', 'normal', 'high' );
	}

	public function product_price_mb_callback( $post ) {
		$price = get_post_meta( $post->ID, 'price', true );
		$price = isset( $price ) ? esc_attr( $price ) : 0;
		$bakery_price_prefix = get_option( 'bakery_price_prefix' );
		include_once Bakery::getView() . 'product-price.php';
	}

	public function product_price_save( $post_id ) {
		// Bail if we're doing an auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! empty( $_POST['_nonce'] ) && ! wp_verify_nonce( $_POST['_nonce'], 'nonce_value' ) ) {
			return;
		}

		// if our current user can't edit this post, bail
		if ( ! current_user_can( 'edit_post' ) ) {
			return;
		}

		if ( isset( $_POST['price'] ) ) {
			$price = filter_var( $_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, array( 'flags' => FILTER_FLAG_ALLOW_FRACTION ) );
			update_post_meta( $post_id, 'price', esc_attr( $price ) );
		}
	}
}