<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends BaseController {

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

        $patient_search = new PatientSearch();
        $patient_search ->set_order($order_by_field, $order_by_direction)
                        ->set_page($page)
                        ->set_search_term($search)
                        ->execute();

		$data['patients'] = $patient_search;

		return $this->load_view('admin/patient/index',$data);

	}

	public function ajax_return_patient(){

		$public_id = $this->input->get('pubid');

		try {

			$patient = Patient::find_by_pub_id($public_id);

			if(!$patient) {
				throw new Exception("Data not found. Please enter correct Public ID.");
			}
		}

		catch(Exception $e) {

			$data = array('error' => $e->getMessage());

			echo json_encode($data);
			return;
		}

		$data = array(
					'old_record_id'=> $patient->id,
					'first_name'=>$patient->first_name,
					'last_name'=>$patient->last_name,
					'middle_name'=>$patient->middle_name,
					'age' =>$patient->age,
					'sex'=>$patient->sex,
					'date_of_birth'=>$patient->date_of_birth,
					'address'=>$patient->address,
					'email'=>$patient->email,
					'informant'=>$patient->informant,
					'contact_person'=> $patient->contact_person,
					'relation_with_patient'=>$patient->relation_with_patient,
					'source_of_referal'=>$patient->source_of_referal,
					'contact_number'=>$patient->contact_number,
					'error' => ''
				);

/*		$data = array(
					'first_name'=>isset($patient->first_name) ?  $patient->first_name :'',
					'last_name'=>isset($patient->last_name) ? $patient->last_name :'',
					'middle_name'=>isset($patient->middle_name) ? $patient->middle_name :'',
					'age' =>isset($patient->age) ? $patient->age :'',
					'sex'=>isset($patient->sex) ? $patient->sex :'',
					'date_of_birth'=>isset($patient->date_of_birth) ? $patient->date_of_birth :'',
					'address'=>isset($patient->address) ? $patient->address :'',
					'email'=>isset($patient->email) ? $patient->email :'',
					'informant'=>isset($patient->informant) ? $patient->informant :'',
					'contact_person'=> isset($patient->contact_person) ? $patient->contact_person :'',
					'relation_with_patient'=>isset($patient->relation_with_patient) ? $patient->relation_with_patient :'',
					'source_of_referal'=>isset($patient->source_of_referal) ? $patient->source_of_referal :'',
					'contact_number'=>isset($patient->contact_number) ? $patient->contact_number :'',
				);*/

		//print_r($data); exit();

		echo json_encode($data);
	}

	public function add_follow_up() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect(lang_url('/patients/'));
	        }

	        $params = $this->input->post();

	        $follow_up = FollowUp::create($params);

	        $follow_up->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Follow Up was added successfully."
	        );

	        redirect(lang_url('/patients/'));
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect(lang_url('/patients'));
	    }
	} 
}

?>