<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class BakeryContacts extends BakeryBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register_post_type($post_type, $labels = array(), $menu_icon = '', $supports, $taxonomies = array()){
        $post_type = 'contact';
        $labels = array(
            'name'                  => __('Contacts', 'bakery'),
            'singular_name'         => __('Contact', 'bakery'),
            'add_new'               =>  __('Add New', 'bakery'),
            'add_new_item'          =>  __('Add New Contact', 'bakery'),
            'edit'                  =>  __('Edit', 'bakery'),
            'edit_item'             =>  __('Edit Contact', 'bakery'),
            'new_item'              =>  __('New Contact', 'bakery'),
            'view'                  =>  __('View', 'bakery'),
            'view_item'             =>  __('View Contact', 'bakery'),
            'search_items'          =>  __('Search Contacts', 'bakery'),
            'not_found'             =>  __('No Contacts found', 'bakery'),
            'not_found_in_trash'    =>  __('No Contacts found in Trash', 'bakery'),
            'parent'                =>  __('Parent Contact', 'bakery'),
        );
        $menu_icon = 'dashicons-admin-users';

        parent::register_post_type($post_type, $labels, $menu_icon, $supports, $taxonomies);
    }
}
