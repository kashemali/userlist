<?php
/**
 * PHP 7.2 and later:
 * A simple wp plugins of userlist.
 *
 * @package     UserList
 * @author      Kashem Ali
 * @copyright   2020 Swiss Tex Group
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: UserList
 * Plugin URI:        http://123.200.16.26/wordpress/wp-content/plugins/UserList/
 * Description:       Listes User data from API and shows in pages.
 * Version:           1.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            Kashem Ali
 * Author URI:        https://bhubs.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       UserList
 */

declare(strict_types=1);
$autoloadfile=dirname(__FILE__)."/autoload.php";
if (file_exists($autoloadfile)) {
    require_once($autoloadfile);
}
use Inc\UserList;

$userList = new UserList();
$userList->Init();

register_activation_hook(__FILE__, [ $userList, 'Activate' ]);

register_deactivation_hook(__FILE__, [ $userList, 'Dectivate' ]);

register_uninstall_hook(__FILE__, [ 'UserList', 'Uninstall' ]);
