<?php

/**
 * Plugin Name:       Bakery
 * Plugin URI:        http://www.pixie.com.uy
 * Description:       Plugin to add functionalities required by a Bakery.
 * Version:           1.0.0
 * Author:            Vicente Scópise
 * License:           GPL-2.0+
 * Text Domain:       bakery
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class Bakery
{
    protected static $instance = null;

    /**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $slug    The string used to uniquely identify this plugin.
	 */
	protected $slug;

    /**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

    public function __construct()
    {
        $this->slug = 'bakery';
        $this->version = '1.0.0';

        add_action('plugins_loaded', array($this, 'load_textdomain'));
        require_once 'includes/class-base.php';
        require_once 'includes/class-products.php';
        //require_once 'includes/class-contacts.php';
        new BakeryProducts();
        //new BakeryContacts();
    }

    /**
     * Load the textdomain for the plugin
     *
     * @package Bakery
     * @since 1.0
     */
    public static function load_textdomain()
    {
        load_plugin_textdomain('bakery', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
Bakery::get_instance();
