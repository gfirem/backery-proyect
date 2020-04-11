<?php

/**
 * Plugin Name:       Bakery
 * Plugin URI:        
 * Description:       My Plugin description
 * Version:           1.0.0
 * Author:            Vicente Scópise
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('PXE_Bakery')) :

    class PXE_Bakery
    {
        public static $version = '1.0.0';
        public static $slug = 'bakery';
        protected static $instance = NULL;


        public function __construct()
        {
            add_action( 'plugin_loaded', __CLASS__ . '::load_plugin_textdomain' );

            //Vicente
            //Test
        }

        public function load_plugin_textdomain()
        {
            load_plugin_textdomain( 
                'bakery', 
                false, 
                dirname( plugin_basename( __FILE__ ) ) . '/languages/' 
            );
        }



        public static function get_instance()
        {
            if (null === self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }
    }

    $PXE_Bakery = new PXE_Bakery;

endif;
