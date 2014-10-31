<?php

class Patient_Inpatient extends BaseController {

	public function index() {

		if(array_key_exists('page', $_GET)) {

            $cur_page = $_GET['page'];
        }
        else {
            $cur_page = 1;
        }

        $page = new Page();
        $page->set_current_page_number($cur_page);
        $page->set_per_page(20);

        if(array_key_exists('order_by_field', $_GET)) {

            $order_by_field = $_GET['order_by_field'];
        }
        else {
            $order_by_field = 'created_at';
        }

        if(array_key_exists('order_by_direction', $_GET)) {

            $order_by_direction = $_GET['order_by_direction'];
        }
        else {
            $order_by_direction = 'desc';
        }

        if(array_key_exists('search', $_GET)) {

            $search = $_GET['search'];
        }
        else {
            $search = null;
        }

        $patient_inpatient_search = new PatientInpatientSearch();
        $patient_inpatient_search ->set_order($order_by_field, $order_by_direction)
                        ->set_page($page)
                        ->set_search_term($search)
                        ->execute();

		$data['patients_inpatient'] = $patient_inpatient_search;

		return $this->load_view('admin/patient/patient_inpatient',$data);
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

	        redirect(lang_url('/patient_inpatient/'));

	    }

	    catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect(lang_url('/patient_inpatient/create'));
        }
	}

	public function discharge_patient(){

		
	}

}

?>