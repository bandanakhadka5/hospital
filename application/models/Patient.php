<?php

include_once('Exceptions.php');

class Patient extends BaseModel {

	/* Table Name */
	static $table_name = 'hospital_patient';
	static $primary_key = 'ID';

	/* Associations */

	static $has_many = array(
		array(
            'emergency',
            'class_name' => 'PatientEmergency',
            'foreign_key' => 'PatientID'
        ),
	);

    static $has_many = array(
        array(
            'opd',
            'class_name' => 'PatientOPD',
            'foreign_key' => 'PatientID'
        ),
    );

    static $has_many = array(
        array(
            'impatient',
            'class_name' => 'PatientImpatient',
            'foreign_key' => 'PatientID'
        ),
    );


	/* Public functions - Setters */

    public function is_pub_id_unique($PubID) {

        if($this->is_new_record()) {
            
            if(self::exists(array(
                'PubID' => $PubID,
            ))){
                throw new PatientPubIDExistsException;
            }

        } elseif(!$this->is_new_record()) {

            if(self::exists(array('conditions' => array(
                'PubID = ? and id != ?',
                $PubID,
                $this->id,
            )))){
                throw new PatientPubIDExistsException;
            }
        }

    }

    public function set_PubID($PubID) {

        $PubID = strtolower(trim($PubID));

        if(!$PubID) {
            throw new PatientPubIDRequiredException;
        }

        $this->is_pub_id_unique($PubID);

        $this->assign_attribute('PubID', $PubID);
    }

    public function set_FirstName($first_name)
	{
        if($first_name=='')
        {
            throw new BlankFirstNameException("First Name Required!");              
        }

    	$this->assign_attribute('FirstName',$first_name);
    }

    public function set_MiddleName($middle_name)
    {
        $this->assign_attribute('MiddleName',$middle_name);
    }

    public function set_LastName($last_name)
	{
        if($last_name=='')
        {
            throw new BlankLastNameException("Last Name Required!");                
        }

    	$this->assign_attribute('LastName',$last_name);
    }

    public function set_Address($address)
    {
        if($address=='')
        {
            throw new BlankAddressException("Address field cannot be empty!");                
        }

        $this->assign_attribute('Address',$address);
    }

    public function set_Age($age)
    {
        if($age=='')
        {
            throw new BlankAgeException("Age field cannot be empty!");                
        }

        $this->assign_attribute('Age',$age);
    }

    public function set_ContactNumber($contact_number)
    {
        if($contact_number=='')
        {
            throw new BlankContactNumberException("Contact Number required!");                
        }

        $this->assign_attribute('ContactNumber',$contact_number);
    }

    public function set_Sex($sex)
	{
        if($sex=='')
        {
            throw new BlankSexException("Sex field cannot be empty!");                
        }

    	$this->assign_attribute('Sex',$sex);
    }

    public function set_DateOfBirth($date_of_birth)
    {
        $this->assign_attribute('DateOfBirth',$date_of_birth);
    }

    public function set_Email($email)
    {
        $this->assign_attribute('Email',$email);
    }

    public function set_SourceOfReferal($source_of_referal)
    {
        $this->assign_attribute('SourceOfReferal',$source_of_referal);
    }

    public function set_ContactPerson($contact_person)
    {
        $this->assign_attribute('ContactPerson',$contact_person);
    }

    public function set_RelationWithPatient($relation_with_patient)
    {
        $this->assign_attribute('RelationWithPatient',$relation_with_patient);
    }

    public function set_Informant($informant)
    {
        $this->assign_attribute('Informant',$informant);
    }

    /* Public functions - Getters */

    public function get_FirstName()
	{
    	return $this->read_attribute('FirstName');
    }

    public function get_LastName()
	{
    	return $this->read_attribute('LastName');
    }

    public function get_Sex()
	{
    	return $this->read_attribute('Sex');
    }

    public function get_Age()
    {
        return $this->read_attribute('Age');
    }

    public function get_Address()
    {
        return $this->read_attribute('Address');
    }

    public function get_ContactNumber()
	{
    	return $this->read_attribute('ContactNumber');
    }

    public function get_DateOfBirth()
    {
        return $this->read_attribute('DateOfBirth');
    }

    public function get_Email()
    {
        return $this->read_attribute('Email');
    }

    public function get_SourceOfReferal()
    {
        return $this->read_attribute('SourceOfReferal');
    }

    public function get_ContactPerson()
    {
        return $this->read_attribute('ContactPerson');
    }

    public function get_RelationWithPatient()
    {
        return $this->read_attribute('RelationWithPatient');
    }

    public function get_Informant()
    {
        return $this->read_attribute('Informant');
    }

    public function get_LastVisitedAt()
    {
        return $this->read_attribute('LastVisitedAt');
    }

    public function get_MiddleName()
    {
        return $this->read_attribute('MiddleName');
    }

	/* Public static functions */

	public static function create($params) {

		$patient = new Patient;

        $patient->PubID = sha1(rand());
		$patient->FirstName = array_key_exists('first_name', $params) ? $params['first_name'] : '';
		$patient->MiddleName = array_key_exists('middle_name',$params) ? $params['middle_name'] : Null;
		$patient->LastName = array_key_exists('last_name', $params) ? $params['last_name'] : '';
		$patient->DateOfBirth = array_key_exists('date_of_birth', $params) ? $params['date_of_birth'] : Null;
		$patient->Age = array_key_exists('age',$params) ? $params['age'] ? '';
		$patient->Address = array_key_exists('address',$params) ? $params['address'] : '';
		$patient->Sex = array_key_exists('sex', $params) ? $params['sex'] : '';
		$patient->Email = array_key_exists('email',$params) ? $params['email'] : Null ;
		$patient->Informant = array_key_exists('informant',$params) ? $params['informant'] : Null;
		$patient->ContactPerson = array_key_exists('contact_person', $params) ? $params['contact_person'] : Null;
		$patient->RelationWithPatient = array_key_exists('relation_with_patient', $params) ? $params['relation_with_patient'] : Null;
		$patient->SourceOfReferal = array_key_exists('source_of_referal', $params) ? $params['source_of_referal'] : Null;
		$patient->ContactNumber = array_key_exists('contact_number', $params) ? $params['contact_number'] : Null;

        $patient->activate();

		return $patient;
	}

}

?>