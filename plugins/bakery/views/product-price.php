<p>
    <label for="price"><strong><?php _e( 'Price', 'bakery' ); ?></strong> (&nbsp;<?php echo esc_attr($bakery_price_prefix); ?>&nbsp;) </label>
    <input type="number" step="any" class="bakery-price" min="1" name="price" id="price" value="<?php echo $price; ?>"/>
</p>