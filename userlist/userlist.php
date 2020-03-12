<?php
/**
 * Plugin Name: UserList
 * Plugin URI:        http://123.200.16.26/wordpress/wp-content/plugins/userlist/
 * Description:       Listes User data from API and shows in pages.
 * Version:           1.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            Kashem Ali
 * Author URI:        https://bhubs.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       userlist
 */



function userlist_register_menu() {
	add_plugins_page( 'User List', 'User List', 'read', 'user-list','userlist_page');
}

add_action( 'admin_menu', 'userlist_register_menu' );

function userlist_page() {
    	include_once( 'page.php'  );
    }
add_action('load-index.php', 'userlist_page');

function page() {
	wp_redirect( admin_url( 'plugins.php?page=user-list' ) );

}

function userlist_install() {
    page();
}
register_activation_hook( __FILE__, 'userlist_install' );

function userlist_deactivation() {
    return false;
}
register_deactivation_hook( __FILE__, 'userlist_deactivation' );

function userlist_uninstall() {
    return false;
}
register_uninstall_hook(__FILE__, 'userlist_uninstall');
?>