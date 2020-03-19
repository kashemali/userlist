<?php
/*
* @Package: UserList
*/
namespace Inc;
class Userlist {
     var $plugins_path;
     function __construct(){
          $this->plugins_url=plugins_url("",dirname(__FILE__));
     }
     function Init(){
         $methods=array(
          'userlist_register_menu',
          'Enquee'
                        );
         foreach($methods as $method){
          
          add_action( 'admin_menu', array($this,$method) );
         }
     }
     function userlist_register_menu() {
          add_plugins_page( 'User List', 'User List', 'read', 'user-list',array($this,"userlist_page"));
     }
     function userlist_page() {
    	include_once( 'page.php'  );
    }
     function Activate(){
          flush_rewrite_rules();
       }
     function Dectivate(){
          flush_rewrite_rules();
     }
     function Uninstall() {
          return false;
      }
     function Enquee(){
          wp_enqueue_style("",$this->plugins_url."/assets/style.css");
          wp_enqueue_style("wp_enqueue_style","//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
           
           wp_enqueue_script("wp_enqueue_script","//code.jquery.com/jquery-3.4.1.min.js");
           wp_enqueue_script("jquery-ui","//code.jquery.com/ui/1.12.1/jquery-ui.min.js");
           wp_enqueue_script("user-list-common",$this->plugins_url."/assets/common.js");
     }

}