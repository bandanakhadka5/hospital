<?php

include_once('Exceptions.php');

class PatientImpatient extends Patient {

	/* Table Name */
	static $table_name = 'patient_impatient';
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

    public function set_DateOfAdmission($date_of_admission)
	{
    	$this->assign_attribute('DateOfAdmission',$date_of_admission);
    }

    public function set_DateOfProcedure($date_of_procedure)
	{
    	$this->assign_attribute('DateOfProcedure',$date_of_procedure);
    }

    public function set_DateOfDischarge($date_of_discharge)
	{
    	$this->assign_attribute('DateOfDischarge',$date_of_discharge);
    }

     /* Public functions - Getters */

    public function get_DateOfAdmission()
	{
    	return $this->read_attribute('DateOfAdmission');
    }

    public function get_DateOfProcedure()
	{
    	return $this->read_attribute('DateOfProcedure');
    }

    public function get_DateOfDischarge()
	{
    	return $this->read_attribute('DateOfDischarge');
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_impatient = new PatientImpatient;

		$patient_impatient->DateOfAdmission = array_key_exists('date_of_admission', $params) ? $params['date_of_consultation'] : '';
		$patient_impatient->DateOfProcedure = array_key_exists('date_of_procedure', $params) ? $params['date_of_procedure'] : '';
		$patient_impatient->DateOfDischarge = array_key_exists('date_of_discharge', $params) ? $params['date_of_discharge'] : '';
		$patient_impatient->activate();

		$patient = Patient::create($params);
		$patient->save();

		$patient_impatient->PatientID = $patient->ID;

		return $patient_impatient;
		
    }
}