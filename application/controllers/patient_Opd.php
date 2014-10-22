<?php

class Patient_Opd extends BaseController {

	public function index() {

		$data['patient'] = Patient::find('all');

		return $this->load_view('dashboard',$data);
	}

	public function create() {          
	    try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            return $this->load_view('admin/patient/create_opd');
	        }

	        $params = $this->input->post();

	        $patient = Patient::create($params);

	        $patient->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Patient was successfully created."
	        );

	        redirect(lang_url('/dashboard/'));

	    } catch(Exception $e){

	             return $this->load_view(
	                'admin/patient/create_opd',
	                array(
	                    'message'=>$e->getMessage(),
	                )
	            );
	            
	        }
	}

}

?>