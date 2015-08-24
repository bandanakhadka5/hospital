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

		$opd_no = $this->input->get('opd_no');

		try {

			$patient = Patient::find_by_opd_no($opd_no);

			if(!$patient) {
				throw new Exception("Data not found. Please enter correct OPD No.");
			}
		}

		catch(Exception $e) {

			$data = array('error' => $e->getMessage());

			echo json_encode($data);
			return;
		}

        $date = Patient::english_to_nepali(date('Y-m-d',strtotime($patient->date_of_birth)));

		$data = array(
					'old_record_id'=> $patient->id,
					'first_name'=>$patient->first_name,
					'last_name'=>$patient->last_name,
					'middle_name'=>$patient->middle_name,
					'age' =>$patient->age,
					'sex'=>$patient->sex,
					'date_of_birth'=>$date,
					'address'=>$patient->address,
					'email'=>$patient->email,
					'informant'=>$patient->informant,
					'contact_person'=> $patient->contact_person,
					'relation_with_patient'=>$patient->relation_with_patient,
					'source_of_referal'=>$patient->source_of_referal,
					'contact_number'=>$patient->contact_number,
                    'opd_no'=>$patient->opd_no,
					'error' => ''
				);

		echo json_encode($data);
	}

    public function ajax_return_age() {

        $dob = $this->input->get('dob');

        $date_of_birth = date_create(Patient::convert_date($dob));
        $currrent_date = date_create(date('Y-m-d'));

        $diff = date_diff($date_of_birth,$currrent_date);
        $days = $diff->format("%R%a");

        $data = array('error' => '');
        if(intval($days) < 0) {
            $data['error'] = "Invalid Date";
        }

        $data['age'] = intval($days/365);

        echo json_encode($data);
        return;
    }

	public function add_follow_up() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect('/patients');
	        }

	        $params = $this->input->post();

	        $follow_up = FollowUp::create($params);

	        $follow_up->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Follow Up was added successfully."
	        );

	        redirect('/patients');
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/patients');
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

            $patient->opd_no = $this->input->post('opd_no');
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

            redirect('/patients');
		}

		catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/patients');
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
                        );

            $data['emergency_diagnosis'] =  Diagnoses::find('all', array(
                                                'conditions' => array(
                                                    'patient_id = ? and 
                                                    consultation_type = ?',
                                                    $patient->id,
                                                    'Emergency',
                                                    ),
                                                ));

            $data['opd_diagnosis'] =  Diagnoses::find('all', array(
                                        'conditions' => array(
                                            'patient_id = ? and 
                                            consultation_type = ?',
                                            $patient->id,
                                            'OPD',
                                            ),
                                        ));

            $data['inpatient_diagnosis'] =  Diagnoses::find('all', array(
                                                'conditions' => array(
                                                    'patient_id = ? and 
                                                    consultation_type = ?',
                                                    $patient->id,
                                                    'Inpatient',
                                                    ),
                                                ));

            return $this->load_view('admin/patient/report',$data);
		}

		catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/patients');
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