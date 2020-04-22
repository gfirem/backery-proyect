<?php
/*
 * Plugin Name: Bakery
 * Description: Customize your Bakery
 * Version: 1.0.0
 * Author: Workshop
 * License: GPLv2 or later
 * Text Domain: bakery
 *****************************************************************************
 *
 * This script is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ****************************************************************************
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bakery {

	public static $version='1.0.0';
	public static $slug='bakery';

	protected static $instance = null;
	protected static $view = null;

	public function __construct() {
		self::$view = dirname( __FILE__ ) . '/views/';
		add_action('plugins_loaded', array($this,'load_plugin_textdomain'));
		require_once 'includes/class-acf.php';
		new BakeryACF();
		require_once 'includes/class-base.php';
		require_once 'includes/class-contacts.php';
		require_once 'includes/class-products.php';
		require_once 'includes/class-orders.php';
		new BakeryContacts();
		new BakeryProducts();
		new BakeryOrders();
	}

	/**
	 * Get View path
	 *
	 * @return string
	 */
	public static function getView() {
		return self::$view;
	}

	/**
	 * Load the textdomain for the plugin
	 *
	 * @package Bakery
	 * @since 1.0
	 */
	public function load_plugin_textdomain(){
		load_plugin_textdomain('bakery',false,dirname(plugin_basename(__FILE__)).'/languages/');
	}

	public static function error_log($message){
		if(!empty($message)){
			error_log(self::getSlug().'--'.$message);
		}
	}

	/**
	 * Get plugin version
	 *
	 * @return string
	 */
	static function getVersion() {
		return self::$version;
	}

	/**
	 * Get plugins slug
	 *
	 * @return string
	 */
	static function getSlug() {
		return self::$slug;
		
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


}

Bakery::get_instance();