<?php
/*
* @Package: UserList
*/
declare(strict_types=1);
namespace Inc;

class UserList
{
    private $pluginsUrl;
    private $pluginstPath;
    public function __construct()
    {

         $this->pluginsUrl=plugins_url("", dirname(__FILE__));
         $this->pluginstPath=dirname(__FILE__, 2);
    }

    public function init()
    {

        $methods=[
         'userListRegisterMenu',
         'enQueue',
        ];
        foreach ($methods as $method) {
            add_action('admin_menu', [$this, $method]);
        }
    }

    public function userListRegisterMenu()
    {

         add_plugins_page('User List', 'User List', 'read', 'user-list', [$this, "userListPage"]);
    }

    public function userListPage()
    {

        include_once($this->pluginstPath.'/page.php');
    }

    public function activate()
    {

         flush_rewrite_rules();
    }

    public function deActivate()
    {

        flush_rewrite_rules();
    }

    public static function unInstall()
    {
        ///Rest code on uninstall.
    }

    public function enQueue()
    {

         wp_enqueue_style("", $this->pluginsUrl."/assets/style.css");
         wp_enqueue_style("wp_enqueue_style", "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");

          wp_enqueue_script("wp_enqueue_script", "//code.jquery.com/jquery-3.4.1.min.js");
          wp_enqueue_script("jquery-ui", "//code.jquery.com/ui/1.12.1/jquery-ui.min.js");
          wp_enqueue_script("user-list-common", $this->pluginsUrl."/assets/common.js");
    }
}
