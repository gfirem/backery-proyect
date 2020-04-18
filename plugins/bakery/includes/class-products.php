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
			)
		);
	}

	public function product_price_meta_boxes() {
		add_meta_box( 'bakery-product-price', __( 'Product Price', 'bakery' ), array( $this, 'product_price_mb_callback' ), 'product', 'normal', 'high' );
	}

	public function product_price_mb_callback( $post ) {
		$price = get_post_meta( $post->ID, 'bakery_product_price', true );
		$price  = isset( $price ) ? esc_attr( $price ) : 0;
		include_once Bakery::getView() . 'product-price.php';
	}

	public function product_price_save( $post_id ) {
		// Bail if we're doing an auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( !empty($_POST['_nonce']) && ! wp_verify_nonce( $_POST['_nonce'], 'nonce_value' ) ) {
			return;
		}

		// if our current user can't edit this post, bail
		if ( ! current_user_can( 'edit_post' ) ) {
			return;
		}

		if ( isset( $_POST['bakery_product_price'] ) ) {
			$price = filter_var( $_POST['bakery_product_price'], FILTER_SANITIZE_NUMBER_FLOAT );
			update_post_meta( $post_id, 'bakery_product_price', esc_attr( $price ) );
		}
	}
}