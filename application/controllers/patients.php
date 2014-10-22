<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends BaseController {

	public function index() {

	}

	public function ajax_return_patient(){

		$public_id = $this->input->get('public_id');

		$patient = Patient::find_by_PubID($public_id);

	}

	
}

?>