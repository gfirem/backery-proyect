<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_query;

$target_cat = ( ! empty( $wp_query ) && ! empty( $wp_query->query_vars['pagename'] ) && $wp_query->query_vars['pagename'] !== 'products' ) ? $wp_query->query_vars['pagename'] : false;

get_header(); ?>

    <div id="product-list" <?php generate_do_element_classes( 'content' ); ?>>
        <main id="main" <?php generate_do_element_classes( 'main', 'products' ); ?>>

			<?php
			if ( empty( $target_cat ) ) {
				get_template_part( 'products', 'cat-all' );
			} else {
				get_template_part( 'products', 'cat-single' );
			}

			?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

get_footer();
