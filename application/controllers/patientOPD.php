<?php

class PatientOPD extends BaseController {

	public function index() {

		$data['patient'] = Patient::find('all');

		return $this->load_view('dashboard',$data);
	}

	public function create() {          
	    try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            return $this->load_view('admin/patient/create');
	        }

	        $license = License::find_valid_by_id($this->input->post('license_id'));

	        $member = Member::find_valid_by_id_and_organisation_id(
	        	$this->input->post('member_id'),
	        	$this->current_member->organisation_id
	        );

	        $enrolment_standard = EnrolmentStandard::create(array(
	                'license' => $license, 
	                'member' => $member,
	            ));

	        if($this->input->post('send_mail') == "1") {

	            if($member->has_email()) {

		            Email::push(array(
		                'type' => 'enrolment-alert',
		                'from' => 'invitations@academyhq.com',
		                'to' => $member->email,
		                'subject' => lang('emailer.cont.process.alert', $enrolment_standard->enrolment->course->name),
		                'body' => nl2br($this->load->view(
		                    'emails/enrolments/alert', 
		                    array('enrolment' => $enrolment_standard->enrolment), 
		                    true
		                )),
		            ));
	        	}
	        }

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Enrolment in Course '".$enrolment_standard->enrolment->course->name."' was successfully created."
	        );

	        redirect(lang_url('/enrolments/'));

	    } catch(Exception $e){

	             return $this->load_view(
	                'enrolments/create',
	                array(
	                    'message'=>$e->getMessage(),
	                )
	            );
	            
	        }
	}

}

?>