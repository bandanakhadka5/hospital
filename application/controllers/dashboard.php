<?php

class Dashboard extends BaseController {

	public function index() {

		return $this->loadView('dashboard');
	}
}

?>