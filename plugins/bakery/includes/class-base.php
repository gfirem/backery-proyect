<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class BakeryBase{

    public function __construct(){
        add_action('init',array($this,'register_post_type'));
    }

    abstract public function register_post_type();
    
}