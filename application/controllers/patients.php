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

        if(array_key_exists('diagnosis', $_GET)) {

            $diagnosis = $_GET['diagnosis'];
        }
        else {
            $diagnosis = null;
        }

        $patient_search = new PatientSearch();
        $patient_search ->set_order($order_by_field, $order_by_direction)
                        ->set_page($page)
                        ->set_search_term(urldecode($search));

        if($diagnosis) {
            $patient_search->set_diagnosis($diagnosis);
        }

        $patient_search->execute();

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

	public function edit($patient_id) {

		try {

			$patient = Patient::find_by_id($patient_id);

			if(!$patient) {
				throw new Exception("Invalid Patient!");				
			}

			if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->load_view('admin/patient/edit',array('patient' => $patient));
            }

			$patient->first_name = $this->input->post('first_name');
			$patient->middle_name = $this->input->post('middle_name');
			$patient->last_name = $this->input->post('last_name');
			$patient->date_of_birth = $this->input->post('date_of_birth');
			$patient->age = $this->input->post('age');
			$patient->address = $this->input->post('address');
			$patient->sex = $this->input->post('sex');
			$patient->email = $this->input->post('email');
			$patient->informant = $this->input->post('informant');
			$patient->contact_person = $this->input->post('contact_person');
			$patient->relation_with_patient = $this->input->post('relation_with_patient');
			$patient->source_of_referal = $this->input->post('source_of_referal');
			$patient->contact_number = $this->input->post('contact_number');

			$patient->save();

			$this->session->set_flashdata(
                'alert_success', 
                "Patient details edited successfully."
            );

            redirect(lang_url('/patients'));
		}

		catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect(lang_url('/patients'));
	    }
	}

	public function view_report($patient_id) {

		try {

			$patient = Patient::find_by_id($patient_id);

			if(!$patient) {
				throw new Exception("Invalid Patient!");				
			}
            
            $data = array(
            			'patient' => $patient,
            			'emergency' => $patient->emergency,
            			'opd' => $patient->opd,
            			'inpatient' => $patient->inpatient,
            			'diagnosis' => $patient->diagnosis,
            			);

            return $this->load_view('admin/patient/report',$data);
		}

		catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect(lang_url('/patients'));
	    }
	}

	public function typeahead($search = null){

        if(is_null($search)){
            return json_encode('');
        }

        $page = new Page();
        $page->set_current_page_number(1);
        $page->set_per_page(8);

        $patient_search = new PatientSearch();
        $patient_search ->set_order('first_name', 'desc')
                        ->set_search_term(urldecode($search))
                        ->set_page($page)
                        ->set_deleted(0)
                        ->execute();

        $patients = array();
        if($patient_search->get_total_rows() > 0) {
            foreach($patient_search as $patient) {
                $patients[] = array('ID' => $patient->id, 'FullIdentifier' => $patient->first_name." ".$patient->last_name);
            }
        }

        $this ->output
              ->set_content_type('application/json')
              ->set_output(json_encode($patients));
    }
}

?>