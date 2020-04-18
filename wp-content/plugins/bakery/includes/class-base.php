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
        add_action('save_post', array($this, 'save_post'), 10, 2);
    }

    /*
    *
    */
    public function register_post_type($post_type, $labels, $menu_icon, $supports, $taxonomies)
    {
        register_post_type(
            $post_type,
            array(
                'labels'                =>  $labels,
                'public'                => false,
                'menu_icon'             => $menu_icon,
                'has_archive'           => true,
                'publicly_queryable'    => false,
                'exclude_from_search'   => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'query_var'             => true,
                'hierarchical'          => false,
                'rewrite'               => array('slug' => $post_type),
                'capability_type'       => 'post',
                'supports'              => $supports,
                'taxonomies'            => $taxonomies,
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
            'advanced',
            'default',
            $fields
        );
    }

    public function display_mb($post, $fields)
    {
        $price = esc_html(get_post_meta($post->ID, '_price', true));
        $description = esc_html(get_post_meta($post->ID, '_description', true)); ?>
        <table>
            <?php foreach ($fields['args'] as $field) : ?>
                <tr>
                    <?php if ($field['type'] === 'text') : ?>
                        <td style="width: 100%">Price</td>
                        <td><input type="text" size="80" name="price" value="<?php echo $price; ?>" /></td>
                    <?php elseif ($field['type'] === 'textarea') : ?>
                        <td style="width: 100%">Description</td>
                        <td>
                            <textarea rows="1" cols="40"></textarea>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table> <?php
                }


                /*
    *
    */
                public function save_post($post_id, $post_data)
                {
                    $b = 0;
                }
            }
