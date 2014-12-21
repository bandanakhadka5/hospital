<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosis extends BaseController {

	public function index() {
		return $this->load_view('admin/patient/diagnosis');
	}

	public function create() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect('/diagnosis');
	        }

	        $params = $this->input->post();

	        $diagnosis = Diagnoses::create($params);

	        $diagnosis->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Diagnosis was added successfully."
	        );

	        redirect('/diagnosis');
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/diagnosis');
	    }
	}
}