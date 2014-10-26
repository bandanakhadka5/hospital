<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient_Emergency extends BaseController {

	public function index() {

		$data['patient'] = Patient::find('all');

		return $this->load_view('dashboard',$data);
	}

	public function create() { 

	    try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            return $this->load_view('admin/patient/create_emergency');
	        }

	        $params = $this->input->post();

	        $patient_emergency = PatientEmergency::create($params);

	        $patient_emergency->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Patient was successfully created."
	        );

	        redirect(lang_url('/dashboard/'));

	    }

	    catch(Exception $e) {

            return $this->load_view(
                'admin/patient/create_emergency',
                array(
                    'message'=>$e->getMessage(),
                )
            );            
        }
	}

}

?>