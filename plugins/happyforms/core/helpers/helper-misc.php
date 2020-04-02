<?php

if ( ! function_exists( 'happyforms_get_part_label' ) ):
/**
 * Get a non-empty label for the part.
 *
 * @since 1.0
 *
 * @param array $part_data The part data to retrieve the label for.
 *
 * @return string
 */
function happyforms_get_part_label( $part_data ) {
	return ! empty( $part_data['label'] ) ? $part_data['label'] : $part_data['id'];
}

endif;

if ( ! function_exists( 'happyforms_get_csv_header' ) ):
/**
 * Get a non-empty CSV header for the part.
 *
 * @param array $part The part data to retrieve the label for.
 *
 * @return string
 */
function happyforms_get_csv_header( $part ) {
	$part_label = $part['label'];
	$part_id = $part['id'];
	$header = ! empty( $part['label'] ) ? $part_label : "Blank [{$part_id}]";

	return $header;
}

endif;

if ( ! function_exists( 'happyforms_get_csv_value' ) ):
/**
 * Get a CSV response value.
 *
 * @param array $message The message data to retrieve the value for.
 * @param array $part    The part data relative to the current value.
 *
 * @return string
 */
function happyforms_get_csv_value( $value, $message, $part, $form ) {
	$value = happyforms_get_message_part_value( $value, $part, 'csv' );
	$value = htmlspecialchars_decode( $value );
	$value = apply_filters( 'happyforms_get_csv_value', $value, $message, $part, $form );

	return $value;
}

endif;

if ( ! function_exists( 'happyforms_get_message_part_value' ) ):
/**
 * Get the part submission value in a readable format.
 *
 * @since 1.0
 *
 * @param mixed  $value       The original submission value.
 * @param array  $part        Current part data.
 * @param string $destination An optional destination slug.
 *
 * @return string
 */
function happyforms_get_message_part_value( $value, $part = array(), $destination = '' ) {
	$original_value = $value;

	if ( is_string( $value ) ) {
		$value = maybe_unserialize( $value );
	}

	if ( is_array( $value ) ) {
		$value = array_filter( array_values( $value ) );
		$value = implode( ', ', $value );
	}

	$value = wp_unslash( $value );

	$value = apply_filters( 'happyforms_message_part_value', $value, $original_value, $part, $destination );

	return $value;
}

endif;

if ( ! function_exists( 'happyforms_the_message_part_value' ) ):

function happyforms_the_message_part_value( $value, $part = array(), $destination = '' ) {
	$value = happyforms_get_message_part_value( $value, $part, $destination );

	echo $value;
}

endif;

if ( ! function_exists( 'happyforms_stringify_part_value' ) ):
/**
 * Transforms a part value into a string.
 *
 * @since 1.0
 *
 * @param mixed $value The original submission value.
 * @param array $part  Current part data.
 * @param array $form  Current form data.
 *
 * @return string
 */
function happyforms_stringify_part_value( $value, $part, $form ) {
	$value = apply_filters( 'happyforms_stringify_part_value', $value, $part, $form );
	$value = maybe_serialize( $value );

	return $value;
}

endif;

if ( ! function_exists( 'happyforms_customizer_url' ) ):
/**
 * Get a formatted url for the Customize screen,
 * complete with a return url.
 *
 * @since 1.0
 *
 * @param string $return_url The url to return to after
 *                           the Customize screen is closed.
 *
 * @return string
 */
function happyforms_customizer_url( $return_url = '' ) {
	if ( '' === $return_url ) {
		$return_url = urlencode( add_query_arg( null, null ) );
	}

	$customize_url = add_query_arg( array(
		'return' => $return_url,
		'happyforms' => 1,
	), 'customize.php' );

	return $customize_url;
}

endif;

if ( ! function_exists( 'happyforms_get_form_edit_link' ) ):
/**
 * Get the admin edit url for a HappyForm post.
 *
 * @since 1.0
 *
 * @param string|int $id         The form ID.
 * @param string     $return_url The url to return to after
 *                               the Customize screen is closed.
 *
 * @return string
 */
function happyforms_get_form_edit_link( $id, $return_url = '', $step = '' ) {
	$return_url = empty( $return_url ) ? happyforms_get_all_form_link() : $return_url;
	$base_url = add_query_arg( array(
		'form_id' => $id,
	), happyforms_customizer_url( $return_url ) );
	$step = in_array( $step, array( 'build', 'setup', 'style' ) ) ? $step : 'build';
	$url = "{$base_url}#{$step}";

	return $url;
}

endif;

if ( ! function_exists( 'happyforms_get_all_form_link' ) ):
/**
 * Get the url of the All Forms admin screen.
 *
 * @since 1.0
 *
 * @return string
 */
function happyforms_get_all_form_link() {
	return admin_url( 'edit.php?post_type=' . happyforms_get_form_controller()->post_type );
}

endif;

if ( ! function_exists( 'happyforms_admin_footer' ) ):
/**
 * Output the Happyforms rating admin footer.
 *
 * @since 1.0
 *
 * @return string
 */
function happyforms_admin_footer() {
	?>
	<span id="footer-thankyou">
		<?php _e( 'Thank you for creating with', HAPPYFORMS_TEXT_DOMAIN ); ?> <a href="https://happyforms.me/" target="_blank">HappyForms</a>.
	</span>
	<?php
}

endif;

if ( ! function_exists( 'happyforms_get_countries' ) ):
/**
 * Outputs an array of country names.
 *
 * @since 1.1
 *
 * @return void
 */
function happyforms_get_countries() {
	return array(
		__( 'Afghanistan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Albania', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Algeria', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'American Samoa', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Andorra', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Angola', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Anguilla', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Antarctica', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Antigua and Barbuda', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Argentina', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Armenia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Aruba', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Australia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Austria', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Azerbaijan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bahamas', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bahrain', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bangladesh', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Barbados', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Belarus', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Belgium', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Belize', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Benin', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bermuda', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bhutan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bolivia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bosnia and Herzegowina', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Botswana', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bouvet Island', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Brazil', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'British Indian Ocean Territory', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Brunei Darussalam', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Bulgaria', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Burkina Faso', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Burundi', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cambodia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cameroon', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Canada', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cape Verde', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cayman Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Central African Republic', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Chad', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Chile', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'China', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Christmas Island', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cocos (Keeling) Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Colombia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Comoros', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Congo', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Congo, the Democratic Republic of the', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cook Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Costa Rica', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ivory Coast', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Croatia (Hrvatska)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cuba', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Cyprus', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Czech Republic', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Denmark', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Djibouti', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Dominica', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Dominican Republic', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'East Timor', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ecuador', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Egypt', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'El Salvador', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Equatorial Guinea', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Eritrea', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Estonia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ethiopia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Falkland Islands (Malvinas)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Faroe Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Fiji', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Finland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'France', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'France Metropolitan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'French Guiana', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'French Polynesia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'French Southern Territories', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Gabon', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Gambia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Georgia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Germany', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ghana', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Gibraltar', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Greece', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Greenland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Grenada', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guadeloupe', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guam', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guatemala', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guinea', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guinea-Bissau', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Guyana', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Haiti', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Heard and Mc Donald Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Holy See (Vatican City State)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Honduras', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Hong Kong', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Hungary', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Iceland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'India', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Indonesia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Iran (Islamic Republic of)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Iraq', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ireland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Israel', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Italy', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Jamaica', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Japan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Jordan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Kazakhstan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Kenya', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Kiribati', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Korea, Democratic People\'s Republic of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Korea, Republic of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Kuwait', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Kyrgyzstan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Lao, People\'s Democratic Republic', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Latvia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Lebanon', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Lesotho', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Liberia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Libyan Arab Jamahiriya', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Liechtenstein', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Lithuania', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Luxembourg', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Macau', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Macedonia, The Former Yugoslav Republic of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Madagascar', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Malawi', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Malaysia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Maldives', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mali', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Malta', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Marshall Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Martinique', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mauritania', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mauritius', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mayotte', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mexico', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Micronesia, Federated States of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Moldova, Republic of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Monaco', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mongolia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Montserrat', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Morocco', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Mozambique', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Myanmar', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Namibia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Nauru', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Nepal', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Netherlands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Netherlands Antilles', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'New Caledonia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'New Zealand', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Nicaragua', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Niger', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Nigeria', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Niue', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Norfolk Island', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Northern Mariana Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Norway', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Oman', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Pakistan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Palau', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Panama', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Papua New Guinea', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Paraguay', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Peru', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Philippines', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Pitcairn', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Poland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Portugal', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Puerto Rico', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Qatar', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Reunion', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Romania', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Russian Federation', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Rwanda', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Saint Kitts and Nevis', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Saint Lucia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Saint Vincent and the Grenadines', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Samoa', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'San Marino', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Sao Tome and Principe', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Saudi Arabia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Senegal', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Seychelles', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Sierra Leone', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Singapore', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Slovakia (Slovak Republic)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Slovenia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Solomon Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Somalia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'South Africa', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'South Georgia and the South Sandwich Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Spain', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Sri Lanka', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'St. Helena', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'St. Pierre and Miquelon', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Sudan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Suriname', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Svalbard and Jan Mayen Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Swaziland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Sweden', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Switzerland', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Syrian Arab Republic', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Taiwan, Province of China', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tajikistan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tanzania, United Republic of', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Thailand', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Togo', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tokelau', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tonga', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Trinidad and Tobago', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tunisia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Turkey', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Turkmenistan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Turks and Caicos Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Tuvalu', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Uganda', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Ukraine', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'United Arab Emirates', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'United Kingdom', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'United States', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'United States Minor Outlying Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Uruguay', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Uzbekistan', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Vanuatu', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Venezuela', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Vietnam', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Virgin Islands (British)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Virgin Islands (U.S.)', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Wallis and Futuna Islands', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Western Sahara', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Yemen', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Yugoslavia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Zambia', HAPPYFORMS_TEXT_DOMAIN ),
		__( 'Zimbabwe', HAPPYFORMS_TEXT_DOMAIN ),
	);
}

endif;

if ( ! function_exists( 'happyforms_is_preview' ) ):
/**
 * Returns whether or not we're previewing a HappyForm.
 *
 * @since 1.3
 *
 * @return void
 */
function happyforms_is_preview() {
	$post_type = happyforms_get_form_controller()->post_type;
	$is_happyform = get_post_type() === $post_type;
	$happyform_parameter = isset( $_POST['happyforms'] );

	// Preview frame
	if ( $is_happyform && is_customize_preview() ) {
		return true;
	}

	// Ajax calls
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX && $happyform_parameter ) {
		return true;
	}

	return false;
}

endif;

if ( ! function_exists( 'happyforms_get_email_part_label' ) ):

function happyforms_get_email_part_label( $message, $part = array(), $form = array() ) {
	$label = happyforms_get_part_label( $part );
	$label = apply_filters( 'happyforms_email_part_label', $label, $message, $part, $form );

	return $label;
}

endif;

if ( ! function_exists( 'happyforms_get_email_part_value' ) ):

function happyforms_get_email_part_value( $message, $part = array(), $form = array(), $context = '' ) {
	$parts = $message['parts'];
	$part_id = $part['id'];
	$value = happyforms_get_message_part_value( $parts[$part_id], $part, 'email' );
	$value = apply_filters( 'happyforms_email_part_value', $value, $message, $part, $form, $context );

	return $value;
}

endif;

if ( ! function_exists( 'happyforms_email_is_part_visible' ) ):

function happyforms_email_is_part_visible( $part = array(), $form = array(), $response = array() ) {
	$visible = apply_filters( 'happyforms_email_part_visible', true, $part, $form, $response );

	return $visible;
}

endif;

if ( ! function_exists( 'happyforms_owner_email_template_path' ) ):

function happyforms_owner_email_template_path() {
	$path = happyforms_get_include_folder() . '/templates/email-owner.php';
	$path = apply_filters( 'happyforms_owner_email_template_path', $path );

	return $path;
}

endif;

if ( ! function_exists( 'happyforms_user_email_template_path' ) ):

function happyforms_user_email_template_path() {
	$path = happyforms_get_include_folder() . '/templates/email-user.php';
	$path = apply_filters( 'happyforms_user_email_template_path', $path );

	return $path;
}

endif;

if ( ! function_exists( 'happyforms_is_preview_context' ) ) :

function happyforms_is_preview_context() {
	$preview = is_customize_preview();
	$block = happyforms_is_block_context();

	return $preview || $block;
}

endif;

if ( ! function_exists( 'happyforms_is_block_context' ) ) :

function happyforms_is_block_context() {
	$is_block = defined( 'REST_REQUEST' ) && REST_REQUEST;

	return $is_block;
}

endif;

if ( ! function_exists( 'happyforms_is_gutenberg' ) ):

function happyforms_is_gutenberg() {
	global $wp_version;

	$is_50 = version_compare( $wp_version, '5.0-alpha', '>=' );
	$is_plugin = is_plugin_active( 'gutenberg/gutenberg.php' );
	$is_gutenberg = $is_50 || $is_plugin;

	return $is_gutenberg;
}

endif;

if ( ! function_exists( 'happyforms_update_meta' ) ):

function happyforms_update_meta( $post_id, $meta_key, $meta_value, $prev_value = '' ) {
	$meta_key = "_happyforms_{$meta_key}";

	return update_post_meta( $post_id, $meta_key, $meta_value, $prev_value );
}

endif;

if ( ! function_exists( 'happyforms_get_meta' ) ):

function happyforms_get_meta( $post_id, $key = '', $single = false ) {
	$key = "_happyforms_{$key}";

	return get_post_meta( $post_id, $key, $single );
}

endif;

if ( ! function_exists( 'happyforms_unprefix_meta' ) ):

function happyforms_unprefix_meta( $meta ) {
	$meta = $meta ? $meta : array();
	$meta = array_map( 'reset', $meta );
	$meta = array_map( 'maybe_unserialize', $meta );
	$prefixed_meta = array();
	$unprefixed_meta = array();

	foreach( $meta as $key => $value ) {
		if ( false !== strpos( $key, '_happyforms_' ) ) {
			$unprefixed_key = str_replace( '_happyforms_', '', $key );
			$prefixed_meta[$unprefixed_key] = $value;
		} else {
			$unprefixed_meta[$key] = $value;
		}
	}

	foreach( $unprefixed_meta as $key => $value ) {
		if ( ! isset( $prefixed_meta[$key] ) ) {
			$prefixed_meta[$key] = $value;
		}
	}

	return $prefixed_meta;
}

endif;

if ( ! function_exists( 'happyforms_prefix_meta' ) ):

function happyforms_prefix_meta( $meta ) {
	foreach( $meta as $key => $value ) {
		$prefixed_key = "_happyforms_{$key}";
		$meta[$prefixed_key] = $value;
		unset( $meta[$key] );
	}

	return $meta;
}

endif;

if ( ! function_exists( 'happyforms_get_message_title' ) ):

function happyforms_get_message_title( $message_id ) {
	$title = sprintf( __( 'Response #%s', HAPPYFORMS_TEXT_DOMAIN ), $message_id );

	return $title;
}

endif;

if ( ! function_exists( 'happyforms_explode_value' ) ):

function happyforms_explode_value( $value, $separator = '' ) {
	$value = explode( ',', $value );
	$value = array_map( 'trim', $value );
	$value = array_filter( $value );

	return $value;
}

endif;

if ( ! function_exists( 'happyforms_customize_get_current_form' ) ):

function happyforms_customize_get_current_form() {
	$form = HappyForms()->customize->get_current_form();

	if ( is_array( $form ) ) {
		return $form;
	}
}

endif;

if ( ! function_exists( 'happyforms_get_part_customize_fields' ) ):

function happyforms_get_part_customize_fields( $fields, $type ) {
	return apply_filters( "happyforms_part_customize_fields_{$type}", $fields );
}

endif;

if ( ! function_exists( 'happyforms_get_part_customize_template_path' ) ):

function happyforms_get_part_customize_template_path( $template, $type ) {
	return apply_filters( "happyforms_part_customize_template_path_{$type}", $template );
}

endif;

if ( ! function_exists( 'happyforms_get_part_frontend_template_path' ) ):

function happyforms_get_part_frontend_template_path( $template, $type ) {
	return apply_filters( "happyforms_part_frontend_template_path_{$type}", $template );
}

endif;

if ( ! function_exists( 'happyforms_get_php_locales' ) ):

function happyforms_get_php_locales( $code = '' ) {
	$locales = array(
		'af' => __( 'Afrikaans', HAPPYFORMS_TEXT_DOMAIN ),
		'ak' => __( 'Akan', HAPPYFORMS_TEXT_DOMAIN ),
		'sq' => __( 'Albanian', HAPPYFORMS_TEXT_DOMAIN ),
		'arq' => __( 'Algerian Arabic', HAPPYFORMS_TEXT_DOMAIN ),
		'am' => __( 'Amharic', HAPPYFORMS_TEXT_DOMAIN ),
		'ar' => __( 'Arabic', HAPPYFORMS_TEXT_DOMAIN ),
		'hy' => __( 'Armenian', HAPPYFORMS_TEXT_DOMAIN ),
		'rup' => __( 'Aromanian', HAPPYFORMS_TEXT_DOMAIN ),
		'frp' => __( 'Arpitan', HAPPYFORMS_TEXT_DOMAIN ),
		'as' => __( 'Assamese', HAPPYFORMS_TEXT_DOMAIN ),
		'az' => __( 'Azerbaijani', HAPPYFORMS_TEXT_DOMAIN ),
		'bcc' => __( 'Balochi Southern', HAPPYFORMS_TEXT_DOMAIN ),
		'ba' => __( 'Bashkir', HAPPYFORMS_TEXT_DOMAIN ),
		'eu' => __( 'Basque', HAPPYFORMS_TEXT_DOMAIN ),
		'bel' => __( 'Belarusian', HAPPYFORMS_TEXT_DOMAIN ),
		'bn' => __( 'Bengali', HAPPYFORMS_TEXT_DOMAIN ),
		'bs' => __( 'Bosnian', HAPPYFORMS_TEXT_DOMAIN ),
		'br' => __( 'Breton', HAPPYFORMS_TEXT_DOMAIN ),
		'bg' => __( 'Bulgarian', HAPPYFORMS_TEXT_DOMAIN ),
		'ca' => __( 'Catalan', HAPPYFORMS_TEXT_DOMAIN ),
		'ceb' => __( 'Cebuano', HAPPYFORMS_TEXT_DOMAIN ),
		'zh' => __( 'Chinese', HAPPYFORMS_TEXT_DOMAIN ),
		'co' => __( 'Corsican', HAPPYFORMS_TEXT_DOMAIN ),
		'hr' => __( 'Croatian', HAPPYFORMS_TEXT_DOMAIN ),
		'cs' => __( 'Czech', HAPPYFORMS_TEXT_DOMAIN ),
		'da' => __( 'Danish', HAPPYFORMS_TEXT_DOMAIN ),
		'dv' => __( 'Dhivehi', HAPPYFORMS_TEXT_DOMAIN ),
		'nl' => __( 'Dutch', HAPPYFORMS_TEXT_DOMAIN ),
		'dzo' => __( 'Dzongkha', HAPPYFORMS_TEXT_DOMAIN ),
		'en' => __( 'English', HAPPYFORMS_TEXT_DOMAIN ),
		'eo' => __( 'Esperanto', HAPPYFORMS_TEXT_DOMAIN ),
		'et' => __( 'Estonian', HAPPYFORMS_TEXT_DOMAIN ),
		'fo' => __( 'Faroese', HAPPYFORMS_TEXT_DOMAIN ),
		'fi' => __( 'Finnish', HAPPYFORMS_TEXT_DOMAIN ),
		'fr' => __( 'French', HAPPYFORMS_TEXT_DOMAIN ),
		'fy' => __( 'Frisian', HAPPYFORMS_TEXT_DOMAIN ),
		'fur' => __( 'Friulian', HAPPYFORMS_TEXT_DOMAIN ),
		'fuc' => __( 'Fulah', HAPPYFORMS_TEXT_DOMAIN ),
		'gl' => __( 'Galician', HAPPYFORMS_TEXT_DOMAIN ),
		'ka' => __( 'Georgian', HAPPYFORMS_TEXT_DOMAIN ),
		'de' => __( 'German', HAPPYFORMS_TEXT_DOMAIN ),
		'el' => __( 'Greek', HAPPYFORMS_TEXT_DOMAIN ),
		'kal' => __( 'Greenlandic', HAPPYFORMS_TEXT_DOMAIN ),
		'gn' => __( 'Guaraní', HAPPYFORMS_TEXT_DOMAIN ),
		'gu' => __( 'Gujarati', HAPPYFORMS_TEXT_DOMAIN ),
		'haw' => __( 'Hawaiian', HAPPYFORMS_TEXT_DOMAIN ),
		'haz' => __( 'Hazaragi', HAPPYFORMS_TEXT_DOMAIN ),
		'he' => __( 'Hebrew', HAPPYFORMS_TEXT_DOMAIN ),
		'hi' => __( 'Hindi', HAPPYFORMS_TEXT_DOMAIN ),
		'hu' => __( 'Hungarian', HAPPYFORMS_TEXT_DOMAIN ),
		'is' => __( 'Icelandic', HAPPYFORMS_TEXT_DOMAIN ),
		'ido' => __( 'Ido', HAPPYFORMS_TEXT_DOMAIN ),
		'id' => __( 'Indonesian', HAPPYFORMS_TEXT_DOMAIN ),
		'ga' => __( 'Irish', HAPPYFORMS_TEXT_DOMAIN ),
		'it' => __( 'Italian', HAPPYFORMS_TEXT_DOMAIN ),
		'ja' => __( 'Japanese', HAPPYFORMS_TEXT_DOMAIN ),
		'jv' => __( 'Javanese', HAPPYFORMS_TEXT_DOMAIN ),
		'kab' => __( 'Kabyle', HAPPYFORMS_TEXT_DOMAIN ),
		'kn' => __( 'Kannada', HAPPYFORMS_TEXT_DOMAIN ),
		'kk' => __( 'Kazakh', HAPPYFORMS_TEXT_DOMAIN ),
		'km' => __( 'Khmer', HAPPYFORMS_TEXT_DOMAIN ),
		'kin' => __( 'Kinyarwanda', HAPPYFORMS_TEXT_DOMAIN ),
		'ky' => __( 'Kirghiz', HAPPYFORMS_TEXT_DOMAIN ),
		'ko' => __( 'Korean', HAPPYFORMS_TEXT_DOMAIN ),
		'ckb' => __( 'Kurdish', HAPPYFORMS_TEXT_DOMAIN ),
		'lo' => __( 'Lao', HAPPYFORMS_TEXT_DOMAIN ),
		'lv' => __( 'Latvian', HAPPYFORMS_TEXT_DOMAIN ),
		'li' => __( 'Limburgish', HAPPYFORMS_TEXT_DOMAIN ),
		'lin' => __( 'Lingala', HAPPYFORMS_TEXT_DOMAIN ),
		'lt' => __( 'Lithuanian', HAPPYFORMS_TEXT_DOMAIN ),
		'lb' => __( 'Luxembourgish', HAPPYFORMS_TEXT_DOMAIN ),
		'mk' => __( 'Macedonian', HAPPYFORMS_TEXT_DOMAIN ),
		'mg' => __( 'Malagasy', HAPPYFORMS_TEXT_DOMAIN ),
		'ms' => __( 'Malay', HAPPYFORMS_TEXT_DOMAIN ),
		'ml' => __( 'Malayalam', HAPPYFORMS_TEXT_DOMAIN ),
		'mri' => __( 'Maori', HAPPYFORMS_TEXT_DOMAIN ),
		'mr' => __( 'Marathi', HAPPYFORMS_TEXT_DOMAIN ),
		'xmf' => __( 'Mingrelian', HAPPYFORMS_TEXT_DOMAIN ),
		'mn' => __( 'Mongolian', HAPPYFORMS_TEXT_DOMAIN ),
		'me' => __( 'Montenegrin', HAPPYFORMS_TEXT_DOMAIN ),
		'ary' => __( 'Moroccan Arabic', HAPPYFORMS_TEXT_DOMAIN ),
		'mya' => __( 'Myanmar (Burmese)', HAPPYFORMS_TEXT_DOMAIN ),
		'ne' => __( 'Nepali', HAPPYFORMS_TEXT_DOMAIN ),
		'nb' => __( 'Norwegian (Bokmål)', HAPPYFORMS_TEXT_DOMAIN ),
		'nn' => __( 'Norwegian (Nynorsk)', HAPPYFORMS_TEXT_DOMAIN ),
		'oci' => __( 'Occitan', HAPPYFORMS_TEXT_DOMAIN ),
		'ory' => __( 'Oriya', HAPPYFORMS_TEXT_DOMAIN ),
		'os' => __( 'Ossetic', HAPPYFORMS_TEXT_DOMAIN ),
		'ps' => __( 'Pashto', HAPPYFORMS_TEXT_DOMAIN ),
		'fa' => __( 'Persian', HAPPYFORMS_TEXT_DOMAIN ),
		'pl' => __( 'Polish', HAPPYFORMS_TEXT_DOMAIN ),
		'pt' => __( 'Portuguese', HAPPYFORMS_TEXT_DOMAIN ),
		'pa' => __( 'Punjabi', HAPPYFORMS_TEXT_DOMAIN ),
		'rhg' => __( 'Rohingya', HAPPYFORMS_TEXT_DOMAIN ),
		'ro' => __( 'Romanian', HAPPYFORMS_TEXT_DOMAIN ),
		'roh' => __( 'Romansh Vallader', HAPPYFORMS_TEXT_DOMAIN ),
		'ru' => __( 'Russian', HAPPYFORMS_TEXT_DOMAIN ),
		'rue' => __( 'Rusyn', HAPPYFORMS_TEXT_DOMAIN ),
		'sah' => __( 'Sakha', HAPPYFORMS_TEXT_DOMAIN ),
		'sa' => __( 'Sanskrit', HAPPYFORMS_TEXT_DOMAIN ),
		'srd' => __( 'Sardinian', HAPPYFORMS_TEXT_DOMAIN ),
		'gd' => __( 'Scottish Gaelic', HAPPYFORMS_TEXT_DOMAIN ),
		'sr' => __( 'Serbian', HAPPYFORMS_TEXT_DOMAIN ),
		'szl' => __( 'Silesian', HAPPYFORMS_TEXT_DOMAIN ),
		'snd' => __( 'Sindhi', HAPPYFORMS_TEXT_DOMAIN ),
		'si' => __( 'Sinhala', HAPPYFORMS_TEXT_DOMAIN ),
		'sk' => __( 'Slovak', HAPPYFORMS_TEXT_DOMAIN ),
		'sl' => __( 'Slovenian', HAPPYFORMS_TEXT_DOMAIN ),
		'so' => __( 'Somali', HAPPYFORMS_TEXT_DOMAIN ),
		'azb' => __( 'South Azerbaijani', HAPPYFORMS_TEXT_DOMAIN ),
		'es' => __( 'Spanish', HAPPYFORMS_TEXT_DOMAIN ),
		'su' => __( 'Sundanese', HAPPYFORMS_TEXT_DOMAIN ),
		'sw' => __( 'Swahili', HAPPYFORMS_TEXT_DOMAIN ),
		'sv' => __( 'Swedish', HAPPYFORMS_TEXT_DOMAIN ),
		'gsw' => __( 'Swiss German', HAPPYFORMS_TEXT_DOMAIN ),
		'tl' => __( 'Tagalog', HAPPYFORMS_TEXT_DOMAIN ),
		'tah' => __( 'Tahitian', HAPPYFORMS_TEXT_DOMAIN ),
		'tg' => __( 'Tajik', HAPPYFORMS_TEXT_DOMAIN ),
		'tzm' => __( 'Tamazight', HAPPYFORMS_TEXT_DOMAIN ),
		'ta' => __( 'Tamil', HAPPYFORMS_TEXT_DOMAIN ),
		'tt' => __( 'Tatar', HAPPYFORMS_TEXT_DOMAIN ),
		'te' => __( 'Telugu', HAPPYFORMS_TEXT_DOMAIN ),
		'th' => __( 'Thai', HAPPYFORMS_TEXT_DOMAIN ),
		'bo' => __( 'Tibetan', HAPPYFORMS_TEXT_DOMAIN ),
		'tir' => __( 'Tigrinya', HAPPYFORMS_TEXT_DOMAIN ),
		'tr' => __( 'Turkish', HAPPYFORMS_TEXT_DOMAIN ),
		'tuk' => __( 'Turkmen', HAPPYFORMS_TEXT_DOMAIN ),
		'twd' => __( 'Tweants', HAPPYFORMS_TEXT_DOMAIN ),
		'ug' => __( 'Uighur', HAPPYFORMS_TEXT_DOMAIN ),
		'uk' => __( 'Ukrainian', HAPPYFORMS_TEXT_DOMAIN ),
		'ur' => __( 'Urdu', HAPPYFORMS_TEXT_DOMAIN ),
		'uz' => __( 'Uzbek', HAPPYFORMS_TEXT_DOMAIN ),
		'vi' => __( 'Vietnamese', HAPPYFORMS_TEXT_DOMAIN ),
		'wa' => __( 'Walloon', HAPPYFORMS_TEXT_DOMAIN ),
		'cy' => __( 'Welsh', HAPPYFORMS_TEXT_DOMAIN ),
		'yor' => __( 'Yoruba', HAPPYFORMS_TEXT_DOMAIN ),
	);

	if ( empty( $code ) ) {
		return $locales;
	}

	$code = strtolower( $code );

	if ( isset( $locales[$code] ) ) {
		return $locales[$code];
	}

	$code = reset( explode( '-', $code ) );

	if ( isset( $locales[$code] ) ) {
		return $locales[$code];
	}

	return '';
}

endif;

if ( ! function_exists( 'happyforms_customize_part_footer' ) ):

function happyforms_customize_part_footer() {
	$template = happyforms_get_core_folder() . '/templates/customize-form-part-footer.php';
	$template = apply_filters( 'happyforms_part_customize_footer_template_path', $template );

	$html = '';

	ob_start();
		require( $template );
	$html = ob_get_clean();

	echo $html;
}

endif;

if ( ! function_exists( 'happyforms_customize_part_logic' ) ) :

function happyforms_customize_part_logic() {
	$template_path = happyforms_get_core_folder() . '/templates/customize-form-part-logic.php';

	$template_path = apply_filters( 'happyforms_customize_part_logic_template_path', $template_path );

	ob_start();
		require( $template_path );
	$template_html = ob_get_clean();

	echo $template_html;
}

endif;

if ( ! function_exists( 'happyforms_customize_part_width_control' ) ) :

function happyforms_customize_part_width_control() {
	?>
	<p>
		<label for="<%= instance.id %>_width"><?php _e( 'Width', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
		<select id="<%= instance.id %>_width" name="width" data-bind="width" class="widefat">
			<option value="full"<%= (instance.width == 'full') ? ' selected' : '' %>><?php _e( 'Full', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="half"<%= (instance.width == 'half') ? ' selected' : '' %>><?php _e( 'Half', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="third"<%= (instance.width == 'third') ? ' selected' : '' %>><?php _e( 'Third', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="quarter"<%= (instance.width == 'quarter') ? ' selected' : '' %>><?php _e( 'Quarter', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="auto"<%= (instance.width == 'auto') ? ' selected' : '' %>><?php _e( 'Auto', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
		</select>
	</p>
	<p class="width-options" style="display: none">
		<label>
			<input type="checkbox" class="checkbox apply-all-check" value="" data-apply-to="width" /> <?php _e( 'Apply to all parts', HAPPYFORMS_TEXT_DOMAIN ); ?>
		</label>
	</p>
	<?php
}

endif;

if ( ! function_exists( 'happyforms_get_validation_message' ) ) :

function happyforms_get_validation_message( $message_key ) {
	$validation_messages = happyforms_validation_messages();

	return $validation_messages->get_message( $message_key );
}

endif;
