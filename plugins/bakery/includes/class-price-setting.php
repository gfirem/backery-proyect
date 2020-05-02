<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryPriceSetting {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'price_setting' ) );
	}

	public function price_setting() {
		add_settings_section(
			'bakery_section',
			'Bakery Options',
			null,
			'general'
		);

		add_settings_field(
			'bakery_price_prefix',
			__( 'Price Prefix', 'bakery' ),
			array( $this, 'price_setting_callback' ),
			'general',
			'bakery_section',
			array(
				'label_for' => 'bakery_price_prefix',
				'id'        => 'bakery_price_prefix'
			)
		);

		register_setting( 'general', 'bakery_price_prefix', 'esc_attr' );
	}

	function price_setting_callback( $args ) {
		$bakery_price_prefix = get_option( $args['id'] );
		$bakery_price_prefix = !empty( $bakery_price_prefix ) ? esc_attr( $bakery_price_prefix ) : '$';
		include_once Bakery::getView() . 'price-setting.php';
	}
}