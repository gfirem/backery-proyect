<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryACF {
	public function __construct() {
		add_action('acf/init', array( $this, 'acf_init'));
	}

	public function acf_init() {
		acf_update_setting('google_api_key', 'AIzaSyBsdKI6RGdyRxU7Kmns3J8WvjP8Sw1Tc0M');
	}
}