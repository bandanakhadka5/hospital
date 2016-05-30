<?php

include_once('Exceptions.php');

class FollowUp extends BaseModel {

	/* Table Name */
	static $table_name = 'patient_follow_ups';

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
    	$this->assign_attribute('type_id',$id);
    }

    public function set_patient_id($id)
    {
        if($id == '') {
            throw new BlankPatientIdException("Patiend Id cannot be blank");            
        }

        $this->assign_attribute('patient_id',$id);
    }

    public function set_follow_up_date($date)
    {
        if($date == '') {
            throw new BlankFollowUpException("Please Enter The Date");
        }

        $date = self::convert_date($date);
        
        if($date < date("Y-m-d")) {
            throw new Exception("Please enter a valid date for follow up");                
        }

        $this->assign_attribute('follow_up_date',$date);
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

    public function get_follow_up_date()
    {
        return $this->read_attribute('follow_up_date');
    }


    /*Private functions*/

    private function find_patient($pub_id) {

        $patient = Patient::find_by_pub_id($pub_id);

        if(!$patient) {
            throw new Exception("Patient with the provided Patient No. not found.");       
        }

        return $patient->id;
    }

    private function check_existing_follow_up($patient_id) {

        $existing_follow_up = self::find_by_patient_id_and_active($patient_id,1);

        if($existing_follow_up) {
            $existing_follow_up->deactivate();
        }

        return;
    }

    /* Public static functions */

    public static function create($params) {

    	$follow_up = new FollowUp;

        $pub_id = array_key_exists('pub_id', $params) ? $params['pub_id'] : NULL;
        $patient_id = self::find_patient($pub_id);

        $follow_up->patient_id = $patient_id;
        $follow_up->doctor = array_key_exists('doctor', $params) ? $params['doctor'] : NULL;
		$follow_up->consultation_type = array_key_exists('consultation_type', $params) ? $params['consultation_type'] : NULL;
		$follow_up->type_id = array_key_exists('type_id', $params) ? $params['type_id'] : NULL;
        $follow_up->follow_up_date = array_key_exists('follow_up_date', $params) ? $params['follow_up_date'] : '';
		
        $follow_up->active = 1;
        $follow_up->deleted = 0;

        self::check_existing_follow_up($patient_id);

		return $follow_up;
		
    }
}