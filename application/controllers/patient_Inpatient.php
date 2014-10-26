<?php

class Patient_Inpatient extends BaseController {

	public function index() {

		$data['patient'] = Patient::find('all');

		return $this->load_view('dashboard',$data);
	}

	public function create() {

	    try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            return $this->load_view('admin/patient/create_inpatient');
	        }

	        $params = $this->input->post();

	        $patient_inpatient = PatientInpatient::create($params);

	        $patient_inpatient->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Patient was successfully created."
	        );

	        redirect(lang_url('/dashboard/'));

	    }

	    catch(Exception $e) {

            return $this->load_view(
                'admin/patient/create_inpatient',
                array(
                    'message'=>$e->getMessage(),
                )
            );
            
        }
	}

}

?>