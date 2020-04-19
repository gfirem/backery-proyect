<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

abstract class BakeryBase
{
    public function __construct()
    {
        add_action('init', array($this, 'register_post_type'));
        add_action('admin_init', array($this, 'post_mb'));
        //add_action('save_post', array($this, 'save_post'), 10, 2);
    }

    /*
    *
    */
    public function register_post_type($name, $labels, $menu_icon, $supports, $taxonomies)
    {
        register_post_type(
            $name,
            array(
                'labels'                =>  $labels,
                'public'                => true,
                'supports'              => $supports,
                'menu_icon'             => $menu_icon,
                'taxonomies'            => $taxonomies,
                'has_archive'           => true,
                'publicly_queryable'    => false,
                'exclude_from_search'   => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'query_var'             => true,
                'hierarchical'          => false,
                'rewrite'               => array('slug' => $name),
                'capability_type'       => 'post',
            )
        );
    }

    /*
    *
    */
    public function post_mb($post_type, $fields, $title)
    {
        add_meta_box(
            $post_type . '_mb',
            $title,
            array($this, 'display_mb'),
            $post_type,
            'normal',
            'default',
            $fields
        );
    }

    public function display_mb($post, $fields)
    {
        ///$price = esc_html(get_post_meta($post->ID, '_price', true));
        //$description = esc_html(get_post_meta($post->ID, '_description', true));
        wp_nonce_field(basename(__FILE__), '_bakery_nonce');
?>
        <table class="form-table">
            <?php foreach ($fields['args'] as $field) : ?>
                <tr>
                    <?php switch ($field['type']):
                        default: ?>
                        <?php
                        case 'text': ?>
                            <th scope="row" style="width:20%!important">
                                <label for="">Price</label>
                            </th>
                            <td>
                                <input type="text" size="80" name="price" value="<?php //echo $price; 
                                                                                    ?>" class="text large-text" />
                            </td>
                            <?php break; ?>
                        <?php
                        case 'textarea': ?>
                            <th scope="row" style="width:20%!important">
                                <label for="">Description</label>
                            </th>
                            <td>
                                <textarea class="large-text"></textarea>
                            </td>
                            <?php break; ?>
                    <?php endswitch; ?>
                </tr>
            <?php endforeach; ?>
        </table>
<?php
    }


    /*
    *
    */
    public function save_post($post_id, $post_data)
    {
        if ($post_data->post_type != 'product') {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!empty($_POST['bakery_nonce']) && !wp_verify_nonce($_POST['bakery_nonce'], 'nonce_value')) {
            return;
        }

        if (!current_user_can('edit_post')) {
            return;
        }


        $b = 0;
    }
}
