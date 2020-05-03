<?php

/**
* Plugin Name: Sacsi Login by ajax
*/

function sacsilogin_shortcode($atts = [], $content = null)
{

    // $strAtt = print_r($atts,true);
    // $strContent = print_r($atts, true);
    // // do something to $content
    // $contentFinal = <<<HTML
    // <h2>Atributos </h2>
    // {$strAtt}
    // <h2>Contenido </h2>
    // {$content}
    // HTML;

    $lostpassword_url = wp_lostpassword_url();
    $nonce_field = wp_nonce_field('ajax-login-nonce', 'security', false, false);
$contentFinal = <<<HTML
<form id="login" method="post">
    <h2>Site Login</h2>
    <p class="status"></p>
    <input id="username" type="text" name="username" placeholder="User@email.com">
    <input id="password" type="password" name="password" placeholder="Your password">
    <input class="submit_button" type="submit" value="Login" name="submit">
    {$nonce_field}
</form>
HTML;


    // always return
    return $contentFinal;
}
add_shortcode('sacsilogin', 'sacsilogin_shortcode');

function sacsilogin_load_scripts() {

// create my own version codes
$my_js_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/sacsilogin.js' ));
wp_enqueue_script('sacsilogin_js', plugins_url('js/sacsilogin.js', __FILE__ ), array('jquery'), $my_js_ver );

    wp_localize_script('sacsilogin_js', 'ajax_login_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'extradata' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));
}

add_action('wp_enqueue_scripts', 'sacsilogin_load_scripts');


// Enable the user with no privileges to run ajax_login() in AJAX
//WPpress wp_ajax_nopriv_<anyaction> -> <anyaction> must be a hidden value as part of the form
add_action('wp_ajax_nopriv_ajaxlogin', 'server_ajax_login');
function server_ajax_login()
{

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
    }

    die();
}