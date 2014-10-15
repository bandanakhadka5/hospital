<?php

include_once('Exceptions.php');

class PatientEmergency extends Patient {

	/* Table Name */
	static $table_name = 'patient_emergency';
	static $primary_key = 'ID';

	/* Associations */

	static $belongs_to = array(
		array(
            'patient',
            'class_name' => 'Patient',
            'foreign_key' => 'patient_id'
        ),
	);

    /* Public functions - Setters */

    public function set_DateOfConsultation($date_of_consultation)
	{
    	$this->assign_attribute('DateOfConsultation',$date_of_consultation);
    }

    public function set_ChiefCompliants($chief_compliants)
	{
    	$this->assign_attribute('ChiefCompliants',$chief_compliants);
    }

     /* Public functions - Getters */

    public function get_DateOfConsultation()
	{
    	return $this->read_attribute('date_of_consultation');
    }

    public function get_ChiefCompliants()
	{
    	return $this->read_attribute('ChiefCompliants');
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_emergency = new PatientEmergency;

		$patient_emergency->DateOfConsultation = array_key_exists('date_of_consultation', $params) ? $params['date_of_consultation'] : '';
		$patient_emergency->ChiefCompliants = array_key_exists('chief_compliants', $params) ? $params['chief_compliants'] : '';
		$patient_emergency->activate();

		$patient = Patient::create($params);
		$patient->save();

		$patient_emergency->PatientID = $patient->ID;

		return $patient_emergency;
		
    }

}