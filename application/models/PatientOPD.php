<?php

include_once('Exceptions.php');

class PatientOPD extends Patient {

	/* Table Name */
	static $table_name = 'patient_opd';
	static $primary_key = 'ID';

	/* Associations */

	static $belongs_to = array(
		array(
            'patient',
            'class_name' => 'Patient',
            'foreign_key' => 'PatientID'
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

    public function set_Doctor($doctor)
	{
    	$this->assign_attribute('Doctor',$doctor);
    }

    public function set_PatiendID($id)
    {
        $this->assign_attribute('PatientId',$id);
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

    public function get_Doctor()
	{
    	return $this->read_attribute('Doctor');
    }

    public function get_PatientID()
    {
        return $this->read_attribute('PatientID');
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_opd = new PatientOPD;

		$patient_opd->DateOfConsultation = array_key_exists('date_of_consultation', $params) ? $params['date_of_consultation'] : '';
		$patient_opd->ChiefCompliants = array_key_exists('chief_compliants', $params) ? $params['chief_compliants'] : '';
		$patient_opd->Doctor = array_key_exists('doctor', $params) ? $params['doctor'] : '';
		$patient_opd->activate();

		$patient = Patient::create($params);
		$patient->save();

		$patient_opd->PatientID = $patient->ID;

		return $patient_opd;
		
    }
}