<?php

include_once('Exceptions.php');

class Patient extends BaseModel {

	/* Table Name */
	static $table_name = 'patients';

	/* Associations */

	static $has_many = array(
		array(
            'emergency',
            'class_name' => 'PatientEmergency',
            'foreign_key' => 'patient_id'
        ),
        array(
            'opd',
            'class_name' => 'PatientOPD',
            'foreign_key' => 'patient_id'
        ),

        array(
            'inpatient',
            'class_name' => 'PatientInpatient',
            'foreign_key' => 'patient_id'
        ),

        array(
            'follow_up',
            'class_name' => 'FollowUp',
            'foreign_key' => 'patient_id'
        ),

        array(
            'diagnosis',
            'class_name' => 'Diagnoses',
            'foreign_key' => 'patient_id'
        ),
	);

	/* Public functions - Setters */

    public function is_pub_id_unique($pub_id) {

        if($this->is_new_record()) {
            
            if(self::exists(array(
                'pub_id' => $pub_id,
            ))) {
                throw new Exception('Public ID already exists');
            }

        } elseif(!$this->is_new_record()) {

            if(self::exists(array('conditions' => array(
                'pub_id = ? and id != ?',
                $PubID,
                $this->id,
            )))) {
                throw new Exception('Public ID already exists');
            }
        }

    }

    public function is_opd_no_unique($opd_no) {

        if($this->is_new_record()) {
            
            if(self::exists(array(
                'opd_no' => $opd_no,
            ))) {
                throw new Exception('OPD Number already exists');
            }

        } elseif(!$this->is_new_record()) {

            if(self::exists(array('conditions' => array(
                'opd_no = ? and id != ?',
                $opd_no,
                $this->id,
            )))) {
                throw new Exception('OPD Number already exists');
            }
        }

    }

    public function is_ipd_no_unique($ipd_no) {

        if($this->is_new_record()) {
            
            if(self::exists(array(
                'ipd_no' => $ipd_no,
            ))) {
                throw new Exception('IPD Number already exists');
            }

        } elseif(!$this->is_new_record()) {

            if(self::exists(array('conditions' => array(
                'ipd_no = ? and id != ?',
                $ipd_no,
                $this->id,
            )))) {
                throw new Exception('IPD Number already exists');
            }
        }

    }

    public function set_pub_id($pub_id) {

        $pub_id = strtolower(trim($pub_id));

        if(!$pub_id) {
            throw new Exception('Public ID required');;
        }

        $this->is_pub_id_unique($pub_id);

        $this->assign_attribute('pub_id', $pub_id);
    }

    public function set_opd_no($opd_no) {

        $opd_no = strtolower(trim($opd_no));

      /*  if(!$opd_no) {
            throw new Exception('OPD Number required!');;
        }*/

        $this->is_opd_no_unique($opd_no);

        $this->assign_attribute('opd_no', $opd_no);
    }

    public function set_ipd_no($ipd_no) {

        $ipd_no = strtolower(trim($ipd_no));

        /*if(!$ipd_no) {
            throw new Exception('IPD Number required!');;
        }*/

        $this->is_ipd_no_unique($ipd_no);

        $this->assign_attribute('ipd_no', $ipd_no);
    }

    public function set_first_name($first_name)
	{
        if($first_name=='')
        {
            throw new BlankFirstNameException("Please Enter First Name");              
        }

    	$this->assign_attribute('first_name',$first_name);
    }

    public function set_middle_name($middle_name)
    {
        $this->assign_attribute('middle_name',$middle_name);
    }

    public function set_last_name($last_name)
	{
        if($last_name=='')
        {
            throw new BlankLastNameException("Please Enter Last Name");                
        }

    	$this->assign_attribute('last_name',$last_name);
    }

    public function set_address($address)
    {
        if($address=='')
        {
            throw new BlankAddressException("Please Enter Address");                
        }

        $this->assign_attribute('address',$address);
    }

    public function set_age($age)
    {
        if($age=='')
        {
            throw new BlankAgeException("Please Enter Age");                
        }

        $this->assign_attribute('age',$age);
    }

    public function set_contact_number($contact_number)
    {
        $this->assign_attribute('contact_number',$contact_number);
    }

    public function set_sex($sex)
	{
        if($sex=='')
        {
            throw new BlankSexException("Please Enter Sex");                
        }

    	$this->assign_attribute('sex',$sex);
    }

    public function set_date_of_birth($date_of_birth)
    {
        if($date_of_birth) {

            $date_of_birth = self::convert_date($date_of_birth);

            /*if($date_of_birth == '' || $date_of_birth === NULL) {
                throw new Exception("Please Enter Date of Birth");
            }*/

            if($date_of_birth > date('Y-m-d')) {
                throw new Exception("Please Enter Valid Date of Birth");
            }
        }

        $this->assign_attribute('date_of_birth',$date_of_birth);
    }

    public function set_email($email)
    {
        $this->assign_attribute('email',$email);
    }

    public function set_source_of_referal($source_of_referal)
    {
        $this->assign_attribute('source_of_referal',$source_of_referal);
    }

    public function set_contact_person($contact_person)
    {
        $this->assign_attribute('contact_person',$contact_person);
    }

    public function set_relation_with_patient($relation_with_patient)
    {
        $this->assign_attribute('relation_with_patient',$relation_with_patient);
    }

    public function set_informant($informant)
    {
        $this->assign_attribute('informant',$informant);
    }

    public function set_last_visited_at($date)
    {
        $this->assign_attribute('last_visited_at',$date);
    }

    /* Public functions - Getters */

    public function get_first_name()
	{
    	return $this->read_attribute('first_name');
    }

    public function get_middle_name()
    {
        return $this->read_attribute('middle_name');
    }

    public function get_last_name()
	{
    	return $this->read_attribute('last_name');
    }

    public function get_pub_id()
    {
        return $this->read_attribute('pub_id');
    }

    public function get_opd_no()
    {
        return $this->read_attribute('opd_no');
    }

    public function get_ipd_no()
    {
        return $this->read_attribute('ipd_no');
    }

    public function get_sex()
	{
    	return $this->read_attribute('sex');
    }

    public function get_age()
    {
        return $this->read_attribute('age');
    }

    public function get_address()
    {
        return $this->read_attribute('address');
    }

    public function get_contact_number()
	{
    	return $this->read_attribute('contact_number');
    }

    public function get_date_of_birth()
    {
        return $this->read_attribute('date_of_birth');
    }

    public function get_email()
    {
        return $this->read_attribute('email');
    }

    public function get_source_of_referal()
    {
        return $this->read_attribute('source_of_referal');
    }

    public function get_contact_person()
    {
        return $this->read_attribute('contact_person');
    }

    public function get_relation_with_patient()
    {
        return $this->read_attribute('relation_with_patient');
    }

    public function get_informant()
    {
        return $this->read_attribute('informant');
    }

    public function get_last_visited_at()
    {
        return $this->read_attribute('last_visited_at');
    }

    public function get_full_name()
    {
        if($this->middle_name != '')
            return $this->first_name.' '.$this->middle_name. ' '.$this->last_name;
        else
            return $this->first_name.' '.$this->last_name;
    }

	/* Public static functions */

	public static function create($params) {

		$patient = new Patient;

        $patient->pub_id = mt_rand(1000000,9999999);
		$patient->first_name = array_key_exists('first_name', $params) ? $params['first_name'] : '';
		$patient->middle_name = array_key_exists('middle_name',$params) ? $params['middle_name'] : Null;
		$patient->last_name = array_key_exists('last_name', $params) ? $params['last_name'] : '';
		$patient->date_of_birth = array_key_exists('date_of_birth', $params) ? $params['date_of_birth'] : Null;
		$patient->age = array_key_exists('age',$params) ? $params['age'] : '';
		$patient->address = array_key_exists('address',$params) ? $params['address'] : '';
		$patient->sex = array_key_exists('sex', $params) ? $params['sex'] : '';
		$patient->email = array_key_exists('email',$params) ? $params['email'] : Null ;
		$patient->informant = array_key_exists('informant',$params) ? $params['informant'] : Null;
		$patient->contact_person = array_key_exists('contact_person', $params) ? $params['contact_person'] : Null;
		$patient->relation_with_patient = array_key_exists('relation_with_patient', $params) ? $params['relation_with_patient'] : Null;
		$patient->source_of_referal = array_key_exists('source_of_referal', $params) ? $params['source_of_referal'] : Null;
		$patient->contact_number = array_key_exists('contact_number', $params) ? $params['contact_number'] : Null;

        $patient->last_visited_at = date('Y-m-d H:i:s');
        $patient->active = 1;
        $patient->deleted = 0;
        $patient->opd_no = array_key_exists('opd_no', $params) ? $params['opd_no'] : '';
        $patient->ipd_no = array_key_exists('ipd_no', $params) ? $params['ipd_no'] : '';

		return $patient;
	}

}

?>