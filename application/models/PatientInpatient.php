<?php

include_once('Exceptions.php');

class PatientInpatient extends Patient {

	/* Table Name */
	static $table_name = 'patients_inpatient';

	/* Associations */

	static $belongs_to = array(
		array(
            'patient',
            'class_name' => 'Patient',
            'foreign_key' => 'patient_id'
        ),
	);

	/* Public functions - Setters */

    public function set_date_of_admission($date_of_admission)
	{
        $date_of_admission = self::convert_date($date_of_admission);

        if($date_of_admission == '' || $date_of_admission === NULL) {
            throw new Exception("Please Enter Date of Admission");
        }

    	$this->assign_attribute('date_of_admission',$date_of_admission);
    }

    public function set_date_of_procedure($date_of_procedure)
	{
        $date_of_procedure = self::convert_date($date_of_procedure);
        
        if($date_of_procedure == '' || $date_of_procedure === NULL) {
            throw new Exception("Please Enter Date of procedure");
        }
        
    	$this->assign_attribute('date_of_procedure',$date_of_procedure);
    }

    public function set_date_of_discharge($date_of_discharge)
	{
    	$this->assign_attribute('date_of_discharge',$date_of_discharge);
    }

    public function set_patient_id($id)
    {
        $this->assign_attribute('patient_id',$id);
    }

     /* Public functions - Getters */

    public function get_date_of_admission()
	{
    	return $this->read_attribute('date_of_admission');
    }

    public function get_date_of_procedure()
	{
    	return $this->read_attribute('date_of_procedure');
    }

    public function get_date_of_discharge()
	{
    	return $this->read_attribute('date_of_discharge');
    }

    public function get_patient_id()
    {
        return $this->read_attribute('patient_id');
    }


    //discharge patient

    public function discharge(){

        if($this->deleted) {
            throw new PatientDischargedException("The patient has already been discharged", 1);            
        }

        $this->date_of_discharge = date('Y-m-d H:i:s');
        $this->deactivate();
        $this->delete();
        $this->save();
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_inpatient = new PatientInpatient;

		$patient_inpatient->date_of_admission = array_key_exists('date_of_admission', $params) ? $params['date_of_admission'] : '';
		$patient_inpatient->date_of_procedure = array_key_exists('date_of_procedure', $params) ? $params['date_of_procedure'] : '';
		$patient_inpatient->date_of_discharge = array_key_exists('date_of_discharge', $params) ? $params['date_of_discharge'] : '';
		
        $patient_inpatient->active = 1;
        $patient_inpatient->deleted = 0;

        if(array_key_exists('old_record_id', $params) && $params['old_record_id'] != "") {            
            
            $patient_inpatient->patient_id = $params['old_record_id'];

            $patient = Patient::find_by_id($params['old_record_id']);
            $patient->last_visited_at = date('Y-m-d H:i:s');
            $patient->save();
        }

        else {

            $patient = Patient::create($params);
            $patient->save();

            $patient_inpatient->patient_id = $patient->id;
        }

		return $patient_inpatient;		
    }
}