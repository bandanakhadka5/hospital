<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient_Emergency extends BaseController {

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

        $patient_emergency_search = new PatientEmergencySearch();
        $patient_emergency_search ->set_order($order_by_field, $order_by_direction)
                        ->set_page($page)
                        ->set_search_term($search)
                        ->execute();

		$data['patients_emergency'] = $patient_emergency_search;

		return $this->load_view('admin/patient/patient_emergency',$data);
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

	        redirect('/patient_emergency');

	    }

	    catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/patient_emergency/create');
        }
	}
}

?>