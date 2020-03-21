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
$autoload_file=dirname(__FILE__)."/vendor/autoload.php";
if(file_exists($autoload_file)){
	require_once($autoload_file);
}
use Inc\Userlist;

$Userlist=new Userlist();
$Userlist->Init();

register_activation_hook( __FILE__, array($Userlist,"activate"));

register_deactivation_hook( __FILE__, array($Userlist,"dectivate"));

register_uninstall_hook(__FILE__, array($Userlist,"uninstall"));
?>