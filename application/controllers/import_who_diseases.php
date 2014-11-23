<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_who_diseases extends BaseController {

	public function index() {

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            return $this->load_view('adm');

		}

		$connection = Member::connection();

		try {

			$connection->transaction();

			$this->create_members_from_params();

			$i = 1;
			foreach ($this->members as $member) {

				$this->member_auto_enrol($i,$member);
				$i++;
			}	

			if ($this->has_errors()){
				throw new MemberImporterMemberAutoEnrolExcepiton('There were error importing members');
			}

			$this->create_profile_members();

			if($this->profile_members) {

				foreach ($this->profile_members as $profile_member) {

					$this->profile_auto_enrol($this->profile_member_index[$profile_member->id],$profile_member);
				}
			}			

			if ($this->has_errors()){
				throw new MemberImporterProfileAutoEnrolExcepiton('There were error importing members');
			}	
			
			$connection->commit();

		} catch (Exception $e) {

			$connection->rollback();
			throw $e;
		}
	}



}