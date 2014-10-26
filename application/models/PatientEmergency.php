<?php

include_once('Exceptions.php');

class PatientEmergency extends Patient {

	/* Table Name */
	static $table_name = 'patients_emergency';

	/* Associations */

	static $belongs_to = array(
		array(
            'patient',
            'class_name' => 'Patient',
            'foreign_key' => 'patient_id'
        ),
	);

    /* Public functions - Setters */

    public function set_date_of_consultation($date_of_consultation)
	{
        if($date_of_consultation == '' || $date_of_consultation === NULL) {
            throw new Exception("Please Enter Date of Consultation");
        }
        
    	$this->assign_attribute('date_of_consultation',$date_of_consultation);
    }

    public function set_chief_compliants($chief_compliants)
	{
    	$this->assign_attribute('chief_compliants',$chief_compliants);
    }

    public function set_patient_id($id)
    {
        $this->assign_attribute('patient_id',$id);
    }

     /* Public functions - Getters */

    public function get_date_of_consultation()
	{
    	return $this->read_attribute('date_of_consultation');
    }

    public function get_chief_compliants()
	{
    	return $this->read_attribute('chief_compliants');
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_emergency = new PatientEmergency;

		$patient_emergency->date_of_consultation = array_key_exists('date_of_consultation', $params) ? $params['date_of_consultation'] : '';
		$patient_emergency->chief_compliants = array_key_exists('chief_compliants', $params) ? $params['chief_compliants'] : '';
		$patient_emergency->active = 1;
        $patient_emergency->deleted = 0;

		$patient = Patient::create($params);
		$patient->save();

		$patient_emergency->patient_id = $patient->id;

		return $patient_emergency;
		
    }

}