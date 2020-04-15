<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryOrders extends BakeryBase{
    public function __construct(){
        parent::__construct();
    }

    public function register_post_type(){
        register_post_type('order',
            array(
                'labels'=>array('name'=>__('Orders','bakery'),
                'singular_name'=>__('Order','bakery'),
                ),
                'public'=>false,
                'menu_icon'=>'dashicons-admin-generic',
                'has_archive'=>true,
                'publicly_queryable'=>false,
                'exclude_from_search'=>true,
                'show_ui'=>true,
                'show_in_menu'=>true,
                'query_var'=>true,
                'hierarchical'=>false,
                'rewrite'=>array('slug'=>'order'),
                'capability_type'=>'post',
                'supports'=>array('title','editor','custom-fields'),
            )
        );
    }
}