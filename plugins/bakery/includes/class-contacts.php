<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BakeryContacts extends BakeryBase{
    function __construct(){
        parent::__construct();
        add_action('acf/save_post',array($this,'override_post_title'),20);
    }

    function register_post_type(){
        register_post_type('contact',
            array(
                'labels'=>array('name'=>__('Contacts','bakery'),
                'singular_name'=>__('Contact','bakery'),
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
                'rewrite'=>array('slug'=>'contact'),
                'capability_type'=>'post',
                'supports'=>array('custom-fields'),
            )
        );
    }

    public function override_post_title($post_id){
        $post_type = get_post_type($post_id);
        if('contact'==$post_type){
            $first_name = get_field('name',$post_id);
            $last_name = get_field('last_name',$post_id);

            $title = $first_name.' '.$last_name;

            $data = array(
                'ID'=>$post_id,
                'post_title'=>$title,
                'post_name'=>sanitize_title($title),
            );

            wp_update_post($data);
        }
    }
    
}
