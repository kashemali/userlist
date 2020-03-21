<?php
/**
 * Class Userlist_Test
 *
 * @package Userlist
 */

/**
 * Userlist test case.
 */
 $autoload_file=dirname(__FILE__,2)."/vendor/autoload.php";
if(file_exists($autoload_file)){
	require_once($autoload_file);
}
use Inc\EndpointUser;
class Userlist_Test extends WP_UnitTestCase {
	var $endpoint;
	public function setUp()
	    {
		parent::setUp();
		$this->endpoint="https://jsonplaceholder.typicode.com/users/";
		$this->users = new EndpointUser($this->endpoint);
	    }
	public function test_GetAllUser() {
		
		$alluser=json_decode($this->users->GetAll());
		
		$this->assertEquals( count($alluser),10 );
	}
	public function test_SingleUser() {
		foreach(array(1,2,3) as $id){
		$singleuser=json_decode($this->users->GetbyId($id));
		
		$this->assertEquals($id,$singleuser->id);
	}

			
	}
}
