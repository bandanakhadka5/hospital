<?php

class Dashboard extends BaseController {

	public function index() {

		$data['users'] = User::find('all');

		return $this->load_view('dashboard',$data);
	}
}

?>