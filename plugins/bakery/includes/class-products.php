<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryProducts extends BakeryBase{
    public function __construct(){
        parent::__construct();
    }

    public function register_post_type(){
        register_post_type('product',
            array(
                'labels'=>array('name'=>__('Products','bakery'),
                'singular_name'=>__('Product','bakery'),
                ),
                'public'=>false,
                'menu_icon'=>'dashicons-email-alt',
                'has_archive'=>true,
                'publicly_queryable'=>false,
                'exclude_from_search'=>true,
                'show_ui'=>true,
                'show_in_menu'=>true,
                'query_var'=>true,
                'hierarchical'=>false,
                'rewrite'=>array('slug'=>'product'),
                'capability_type'=>'post',
                'supports'=>array('title','editor','custom-fields'),
            )
        );
    }
}