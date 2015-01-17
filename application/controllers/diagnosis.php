<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosis extends BaseController {

	public function index() {
		return $this->load_view('admin/patient/diagnosis');
	}

	public function create() {
		
		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect('/diagnosis');
	        }

	        $params = $this->input->post();

	        $medication = array();
	        for($i=1;$i<=10;$i++) {
	        	if($this->input->post('drugs_'.$i) != '') {
	        		$medication[] = $this->input->post('drugs_'.$i);
	        	} 
	        }

	        $med_remarks = array();
	        for($i=1;$i<=10;$i++) {
	        	if($this->input->post('remarks_'.$i) != '') {
	        		$med_remarks[] = $this->input->post('remarks_'.$i);
	        	} 
	        }

	        $params['medication'] = serialize($medication);
	        $params['med_remarks'] = serialize($med_remarks);

	        $diagnosis = Diagnoses::create($params);
	        $diagnosis->save();

	        /*Add Second Diagnosis*/

	        if($this->input->post('diagnosis_1')) {
	        	
	        	$params['diagnosis'] = $this->input->post('diagnosis_1');

	        	$medication = array();
		        for($i=1;$i<=10;$i++) {
		        	if($this->input->post('medication_'.$i) != '') {
		        		$medication[] = $this->input->post('medication_'.$i);
		        	} 
		        }

		        $med_remarks = array();
		        for($i=1;$i<=10;$i++) {
		        	if($this->input->post('med_remarks_'.$i) != '') {
		        		$med_remarks[] = $this->input->post('med_remarks_'.$i);
		        	} 
		        }

		        $params['medication'] = serialize($medication);
		        $params['med_remarks'] = serialize($med_remarks);
		        $params['details'] = $this->input->post('details_1');

	        	$diagnosis_1 = Diagnoses::create($params);
	        	$diagnosis_1->save();
	        }

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Diagnosis was added successfully."
	        );

	        redirect('/diagnosis');
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/diagnosis');
	    }
	}

	public function emergency_diagnosis($pub_id,$type_id) {

		$data = array(
					'pub_id' => $pub_id,
					'type_id' => $type_id,
					'consultation_type' => 'Emergency',
				);

		return $this->load_view('admin/patient/diagnosis',$data);
	}

	public function opd_diagnosis($pub_id,$type_id) {

		$patient_opd = PatientOPD::find_by_id($type_id);

		$data = array(
					'pub_id' => $pub_id,
					'type_id' => $type_id,
					'consultation_type' => 'OPD',
					'doctor' => $patient_opd->doctor,
				);

		return $this->load_view('admin/patient/diagnosis',$data);
	}

	public function inpatient_diagnosis($pub_id,$type_id) {

		$data = array(
					'pub_id' => $pub_id,
					'type_id' => $type_id,
					'consultation_type' => 'Inpatient',
				);

		return $this->load_view('admin/patient/diagnosis',$data);
	}
}