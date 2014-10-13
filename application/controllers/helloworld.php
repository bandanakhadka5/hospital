<?php 
	class Helloworld extends CI_Controller {


		public function index(){

			$params = array('username'=>'om','password'=>'dhoju');

			$user = User::create($params);
			$user->save();

			echo "user saved successful";

		}
	}


?>