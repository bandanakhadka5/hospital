<?php

include_once('Exceptions.php');

class PatientOPD extends Patient {

	/* Table Name */
	static $table_name = 'patients_opd';

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
        $date_of_consultation = self::convert_date($date_of_consultation);
        
        if($date_of_consultation == '' || $date_of_consultation === NULL) {
            throw new Exception("Please Enter Date of Consultation");
        }
        
    	$this->assign_attribute('date_of_consultation',$date_of_consultation);
    }

    public function set_chief_compliants($chief_compliants)
	{
    	$this->assign_attribute('chief_compliants',$chief_compliants);
    }

    public function set_doctor($doctor)
	{
        if($doctor == '')
        {
            throw new BlankDoctorException("You Must Mention The Doctor");
        }

    	$this->assign_attribute('doctor',$doctor);
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

    public function get_doctor()
	{
    	return $this->read_attribute('doctor');
    }

    public function get_patient_id()
    {
        return $this->read_attribute('patient_id');
    }

    /* Public static functions */

    public static function create($params) {

    	$patient_opd = new PatientOPD;

		$patient_opd->date_of_consultation = array_key_exists('date_of_consultation', $params) ? $params['date_of_consultation'] : '';
		$patient_opd->chief_compliants = array_key_exists('chief_compliants', $params) ? $params['chief_compliants'] : '';
		$patient_opd->doctor = array_key_exists('doctor', $params) ? $params['doctor'] : '';
		
        $patient_opd->active = 1;
        $patient_opd->deleted = 0;

        if(array_key_exists('old_record_id', $params) && $params['old_record_id'] != "") {
            
            $patient_opd->patient_id = $params['old_record_id'];

            $patient = Patient::find_by_id($params['old_record_id']);
            $patient->last_visited_at = date('Y-m-d H:i:s');
            $patient->save();
        }

        else {

            $patient = Patient::create($params);
            $patient->save();

            $patient_opd->patient_id = $patient->id;
        }

		return $patient_opd;		
    }
}