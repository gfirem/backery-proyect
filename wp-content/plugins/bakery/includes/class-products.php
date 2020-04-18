<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class BakeryProducts extends BakeryBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register_post_type($post_type, $labels = array(), $menu_icon = '', $supports = array(), $taxonomies = array())
    {
        $post_type = 'product';
        $labels = array(
            'name'                  => __('Products', 'bakery'),
            'singular_name'         => __('Product', 'bakery'),
            'add_new'               =>  __('Add New', 'bakery'),
            'add_new_item'          =>  __('Add New Product', 'bakery'),
            'edit'                  =>  __('Edit', 'bakery'),
            'edit_item'             =>  __('Edit Product', 'bakery'),
            'new_item'              =>  __('New Product', 'bakery'),
            'view'                  =>  __('View', 'bakery'),
            'view_item'             =>  __('View Product', 'bakery'),
            'search_items'          =>  __('Search Products', 'bakery'),
            'not_found'             =>  __('No Products found', 'bakery'),
            'not_found_in_trash'    =>  __('No Products found in Trash', 'bakery'),
            'parent'                =>  __('Parent Product', 'bakery'),
        );
        $menu_icon = 'dashicons-products';
        $supports = array('title', 'thumbnail');

        parent::register_post_type($post_type, $labels, $menu_icon, $supports, $taxonomies);
    }

    public function post_mb($post_type, $fields = array(), $title = '')
    {
        $post_type = 'product';
        $fields = array(
            'price' => array('title' => __('Price', 'bakery'), 'type' => 'text'),
            'description' => array('title' => __('Description', 'bakery'), 'type' => 'textarea'),
        );
        $title = __('Price options', 'bakery');
        parent::post_mb($post_type, $fields, $title);
    }

    public function save_post($post_id, $post_data)
    {
        parent::save_post($post_id, $post_data);
    }
}
