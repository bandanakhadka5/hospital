<?php

include_once('Exceptions.php');

class FollowUp extends BaseModel {

	/* Table Name */
	static $table_name = 'patient_follow_up';
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

    public function set_ConsultationType($type)
	{
    	$this->assign_attribute('ConsultationType',$type);
    }

    public function set_TypeId($id)
	{
    	$this->assign_attribute('TypeId',$id);
    }

    public function set_PatiendID($id)
    {
        if($id == ''){

            throw new BlankPatientIdException("Patiend Id cannot be blanck");
            
        }
        $this->assign_attribute('PatientId',$id);
    }

    public function set_FollowUpDate($date)
    {
        if($date == ''){

            throw new BlankFollowUpException("Please Enter The Date");
            
        }

        $this->assign_attribute('FollowUpDate',$date);
    }



     /* Public functions - Getters */

     public function get_ConsultationType()
    {
        return $this->read_attribute('ConsultationType');
     }

     public function get_TypeId($id)
    {
        return $this->read_attribute('TypeId');
     }

     public function get_PatiendID($id)
     {
         return $this->read_attribute('PatientID');
     }

     public function get_FollowUpDate($date)
     {
         return $this->read_attribute('FollowUpDate');
     }
    /* Public static functions */

    public static function create($params) {

    	$follow_up = new FollowUp;

		$follow_up->ConsultationType = array_key_exists('consultation_type', $params) ? $params['consultation_type'] : NULL;
		$follow_up->TypeId = array_key_exists('type_id', $params) ? $params['type_id'] : NULL;
        $follow_up->PatientID = array_key_exists('patient_id', $params) ? $params['patient_id'] : '';

        $follow_up->FollowUpDate = array_key_exists('follow_up_date', $params) ? $params['follow_up_date'] : '';
		$follow_up->activate();

		return $follow_up;
		
    }

}