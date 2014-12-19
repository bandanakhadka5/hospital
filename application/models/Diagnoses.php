<?php

include_once('Exceptions.php');

class Diagnoses extends BaseModel {

	/* Table Name */
	static $table_name = 'diagnosis';

	/* Associations */

	static $belongs_to = array(
		array(
            'patient',
            'class_name' => 'Patient',
            'foreign_key' => 'patient_id'
        ),
	);

    /* Public functions - Setters */

    public function set_doctor($doctor)
    {
        if($doctor == '') {
            throw new Exception("Doctor's name is required.");            
        }

        $this->assign_attribute('doctor', $doctor);
    }

    public function set_consultation_type($type)
	{
        if($type == '') {
            throw new Exception("Consultation Type is required.");            
        }

    	$this->assign_attribute('consultation_type',$type);
    }

    public function set_type_id($id)
	{
        if($id == ''){
            throw new Exception("Please register Patient to Respective Department");
        }
    	$this->assign_attribute('type_id',$id);
    }

    public function set_patient_id($id)
    {
        if($id == '') {

            throw new BlankPatientIdException("Patient Id cannot be blank");            
        }

        $this->assign_attribute('patient_id',$id);
    }

    public function set_diagnosis($diagnosis)
    {
        if($diagnosis == '') {

            throw new BlankDiagnosisException("Diagnosis Not Acceptable");
        }

        $this->assign_attribute('diagnosis',$diagnosis);
    }

    public function set_details($details) {

        $this->assign_attribute('details', $details);
    }

     /* Public functions - Getters */

     public function get_doctor()
     {
        return $this->read_attribute('doctor');
     }

    public function get_consultation_type()
    {
        return $this->read_attribute('consultation_type');
    }

    public function get_type_id()
    {
        return $this->read_attribute('type_id');
    }

    public function get_patient_id()
    {
        return $this->read_attribute('patient_id');
    }

    public function get_diagnosis()
    {
        return $this->read_attribute('diagnosis');
    }

    public function get_details()
    {
        return $this->read_attribute('details');
    }

    private function find_type_id($type,$patient) {

        $model_name = 'Patient'.$type;

        $type_patient = $model_name::all(array('conditions' => array('patient_id = ?', $patient->id),'order' => 'created_at desc', 'limit' => 1));

        if(empty($type_patient)) {            
            throw new Exception("Please register Patient to Respective Department");            
        }

        foreach ($type_patient as $patient) {
           return $patient->id; 
        }
    }

    private function find_patient($pub_id) {

        $patient = Patient::find_by_pub_id($pub_id);

        if(!$patient) {
            throw new Exception("No Patient With The Given PubID");            
        }

        return $patient;
    }

    /* Public static functions */

    public static function create($params) {

    	$diagnosis = new Diagnoses;

        $diagnosis->doctor = array_key_exists('doctor', $params) ? $params['doctor'] : '';
		$diagnosis->consultation_type = array_key_exists('consultation_type', $params) ? $params['consultation_type'] : '';

        $patient = $diagnosis->find_patient(trim($params['pub_id']));

        if($params['type_id'] == '') {
            $type_id = $diagnosis->find_type_id($params['consultation_type'],$patient);            
        }

        else {
            $type_id = $params['type_id'];
        }
		
        $diagnosis->type_id = $type_id;
        $diagnosis->patient_id = $patient->id;
        $diagnosis->diagnosis = array_key_exists('diagnosis', $params) ? $params['diagnosis'] : '';
        $diagnosis->details = array_key_exists('details', $params) ? $params['details'] : '';
		
        $diagnosis->active = 1;
        $diagnosis->deleted = 0;

		return $diagnosis;		
    }
}