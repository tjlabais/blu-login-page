<?php
/**
 * Plugin Name:         Blu Login Page
 * GitHub URI:          tjlabais/blu-login-page
 * Description:         Full WP Login page customization
 * Version:             0.20.0
 * Requires at least:   6.0
 * Requires PHP:        8.0
 * Author:              BluPages.Net
 * Author URI:          https://blupages.net
 * License:             GPLv3 or later
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:         blu-login-page
 */

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

add_action('login_enqueue_scripts', 'custom_login_styles');
add_filter('login_headerurl', 'custom_login_logo_url');
add_filter('login_headertext', 'custom_login_logo_title');
add_filter('login_message', 'custom_login_message');
add_filter('login_errors', 'custom_login_errors');
add_action('login_footer', 'custom_lost_password_link');

function custom_login_styles() {
    wp_enqueue_style('custom-login', plugin_dir_url(__FILE__) . 'css/login-styles.css', [], '1.0.0');
}

function custom_login_logo_url() {
    return home_url();
}

function custom_login_logo_title() {
    return get_bloginfo('name');
}

function custom_login_message($message) {
    return '<h5 class="login-heading">LST Publications</h5>';
}

function custom_login_errors($error) {
    return 'Invalid credentials. Please try again.';
}

function custom_lost_password_link() {
    if (isset($_GET['action']) && in_array($_GET['action'], ['lostpassword', 'rp', 'resetpass'])) {
        return;
    }
    ?>
    <p class="custom-lost-password">
        <a href="<?php echo wp_lostpassword_url(); ?>">Forgot password?</a>
    </p>
    <?php
}