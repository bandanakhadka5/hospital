<?php

class Patient_Opd extends BaseController {

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

		        $patient_opd_search = new PatientOPDSearch();
		        $patient_opd_search ->set_order($order_by_field, $order_by_direction)
		                        ->set_page($page)
		                        ->set_search_term($search)
		                        ->execute();

				$data['patients_opd'] = $patient_opd_search;

				return $this->load_view('admin/patient/patient_opd',$data);

	}

	public function create() {          
	    try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            return $this->load_view('admin/patient/create_opd');
	        }

	        $params = $this->input->post();

	        $patient_opd = PatientOPD::create($params);

	        $patient_opd->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Patient was successfully created."
	        );

	        redirect('/patient_opd');

	    }

	    catch(Exception $e) {
	    	
	    	$this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/patient_opd/create');        
	    }
	}

	public function delete($patient_opd_id) {

        try {

            $patient_opd = PatientOPD::find_by_id($patient_opd_id);

            if(!$patient_opd) {
                throw new Exception("Invalid Patient!");            
            }

            $patient_opd->delete();
            $patient_opd->save();

            $this->session->set_flashdata(
                'alert_success', 
                "Patient is deleted."
            );
            redirect('/patient_opd');
        }

        catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/patient_opd');
        }
    }

    public function undelete($patient_opd_id) {

        try {

            $patient_opd = PatientOPD::find_by_id($patient_opd_id);

            if(!$patient_opd) {
                throw new Exception("Invalid Patient!");            
            }

            $patient_opd->undelete();
            $patient_opd->save();

            $this->session->set_flashdata(
                'alert_success', 
                "Patient is undeleted."
            );
            redirect('/patient_opd');
        }

        catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/patient_opd');
        }
    }
}

?>