<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$price               = get_post_meta( get_the_ID(), 'price', true );
$bakery_price_prefix = get_option( 'bakery_price_prefix' );
$bakery_price_prefix = ! empty( $bakery_price_prefix ) ? esc_attr( $bakery_price_prefix ) : '$';
$price_string        = $bakery_price_prefix . ' ' . $price;
?>
<div id="product-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> <?php generate_do_microdata( 'product' ); ?>>
    <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" style="width:100%">
    <h1><?php echo esc_attr( get_the_title() ); ?></h1>
    <p class="price"><?php echo esc_attr( $price_string ); ?></p>
    <p><?php echo esc_attr( get_the_content() ); ?></p>
    <p>
        <button><?php echo __( 'Add to checkout', 'bakery' ); ?></button>
    </p>
</div><!-- #product-## -->
