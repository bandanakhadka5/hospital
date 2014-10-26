<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends BaseController {

	public function index() {

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
}

?>