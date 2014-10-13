<?php

/*	include_once('Exceptions.php');*/

	class Patient extends ActiveRecord_Base {

		/* Table Name */
		static $table_name = 'hospital_patient';

		/* Associations */

	/*	static $has_one = array(
			array(
	            'member',
	            'class_name' => 'Member',
	            'foreign_key' => 'user_id'
	        ),
		);*/

	 	/* Observers */

		/* Validations */

		/* Public functions - Setters */

	    private function is_username_available($username) {

	    	if($this->is_new_record()) {

				if(self::exists(array('username' => $username))) { 
					throw new UserUsernameExistsException('The username entered already exists.'); 
				}

	    	} else {

				if(self::exists(array(
					'conditions' => array(
						'username = ?  and id != ?', 
						$username, 
						$this->id
					)
				))) { 
					throw new UserUsernameExistsException('The username entered already exists.'); 
				}

	    	}

	    }

		public function set_username($username){

			$username = strtolower(trim($username));

			if($username == '') {
				echo "no username entered";
				exit;
	            //throw new UserUsernameFieldRequiredException('The username field is required.');
	        }

			$this->is_username_available($username);

			$this->assign_attribute('username', $username);
		}

		public function set_password($password){

			$password = trim($password);

			if($password == '') {
				throw new UserPasswordFieldRequiredException('The password field is required.');
			}

			$encrypt_password = $this->encrypt_new_password($password);
	        $this->assign_attribute('password', $encrypt_password);
	    }

		/* Public functions - Getters */

		/* Private functions - General */

		/* Public functions - General */

	    private function encrypt_new_password($password) {
	    	$salt = dechex(mt_rand(0, 1048576));
			return 'sha1$'.$salt.'$'.sha1($salt.$password);
	    }

	    private function encrypt_existing_password($password) {
	    	$password_elements = explode('$', $this->password);
	    	return $password_elements[0].'$'.$password_elements[1].'$'.sha1($password_elements[1].$password);
	    }

		private function generate_new_password_reset_key() {
			$this->public_hashkey = sha1(rand());
		}

		public function is_password($password) {
			return ($this->password == $this->encrypt_existing_password($password));
		}

		public function login($password) {

			if(!$this->is_password($password)) {
				throw new UserPasswordInvalidException('The username/password combination is not valid.');
			}

			if($this->member->organisation->is_deleted) {
	            throw new OrganisationDeletedException('This members organisation has been deleted');
	        }

			if(!$this->member->organisation->is_active) {
	            throw new OrganisationInactiveException('This members organisation is no longer active');
	        }

			$this->last_login_at = date('Y-m-d H:i:s');
			$this->save();
		}

		public function force_login() {

			$this->last_login_at = date('Y-m-d H:i:s');
			$this->save();
		}

		public function change_password($current_password, $new_password, $new_password_confirm) {

			if(!$this->is_password($current_password)) {
				throw new UserPasswordInvalidException('The password entered does not match the current password.');
			}

			$this->reset_password($new_password, $new_password_confirm);
		}

		public function reset_password($new_password, $new_password_confirm) {

			if($new_password == '') {
				throw new UserPasswordConfirmationException('Please enter a new password.');
			}

			if($new_password !== $new_password_confirm) {
				throw new UserPasswordConfirmationException('The password confirmation entered does not match.');
			}

			$this->password = $new_password;
			$this->public_hashkey = null;
		}

		public function forget_password() {
			$this->generate_new_password_reset_key();
			$this->save();
		}

		/* Public static functions */

		public static function create($params) {

			$patient = new Patient;

			$patient->firstname = array_key_exists('firstname', $params) ? $params['firstname'] : '';
			$patient->middlename = array_key_exists('middlename',$params) ? $params['middlename'] : Null;
			$patient->lastname = array_key_exists('lastname', $params) ? $params['lastname'] : '';
			$patient->dateofbirth = array_key_exists('dateofbirth', $params) ? $params['dateofbirth'] : Null;
			$patient->age = array_key_exists('age',$params) ? $params['age'] ? '';
			$patient->address = array_key_exists('address',$params) ? $params['address'] : '';
			$patient->sex = array_key_exists('sex', $params) ? $params['sex'] : '';
			$patient->email = array_key_exists('email',$params) ? $params['email'] : Null ;
			$patient->dateofconsultation = array_key_exists('dateofconsultation', $params) ? $params['dateofconsultation'] : '';
			$patient->typeofconsultation = array_key_exists('type', $params) ? $params['type'] : '';
			$patient->informant = array_key_exists('informant',$params) ? $params['informant'] : Null;
			$patient->contactperson = array_key_exists('contact', $params) ? $params['contact'] : Null;
			$patient->relation = array_key_exists('relation', $params) ? $params['relation'] : Null;
			$patient->sourceofreferal = array_key_exists('source', $params) ? $params['source'] : Null;
			$patient->contactnumber = array_key_exists('contactnumber', $params) ? $params['contactnumber'] : Null;
			$patient->publicid;

			return $patient;
		}

		public static function __callStatic($method, $args) {

			if (substr($method,0,13) === 'find_valid_by') {
				$attributes = substr($method,14);
				$options['conditions'] = ActiveRecord\SQLBuilder::create_conditions_from_underscored_string(static::connection(),$attributes,$args,static::$alias_attribute);

				$user = static::find('first',$options);

				self::check_user_is_valid($user);

				return $user;
			}

			return parent::__callStatic($method, $args);
		}

		private static function check_user_is_valid($user) {

			if(!$user instanceOf User) {
				throw new UserNotExistsException('The username entered does not exist');
			}

			if(!$user->member) {
				throw new UserInvalidException('The username entered does not exist');
			}

			if($user->member->is_deleted()) {
				throw new UserDeletedException('This user has been deleted');
			}

			if(!$user->member->is_active()) {
				throw new UserInactiveException('This user has been deactivated');
			}

		}

	}

?>