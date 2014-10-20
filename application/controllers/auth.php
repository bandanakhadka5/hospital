<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends BaseController {

    public function __construct(){
        parent::__construct(false);
    }

	public function index() {
        redirect('auth/login');
	}

    public function login() {

        if ($this->isActiveSession()) {
            redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->loadView('admin/auth/index');
        }

        try {

            $user = User::find_valid_by_username($this->input->post('username'));

            $user->login(
                $this->input->post('password')
            );

            $this->session->set_userdata(array(
                'user_id' => $user->id,
                'user_name' => $user->username,
            ));

            $this->session->set_flashdata('alert_success', "Welcome back to BGHospital.");


            redirect('/welcome');

        } catch (Exception $e) {
            return $this->loadView(
                'auth/login',
                array(
                    'message' => $e->getMessage(),
                )
            );
        }
    }

    public function logout() {

		$this->session->sess_destroy();
		redirect(lang_url('/'));
    }

    public function register() {

        if ($this->isActiveSession()) {
            redirect(lang_url('/'));
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->loadView('auth/register');
        }

        try {

            $organisation = Organisation::create(array());
            $organisation->save();

            $memberFullyRequired = MemberFullyRequired::create(array(
                'organisation' => $organisation,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'password_confirm' => $this->input->post('password_confirm'),
                'terms' => $this->input->post('terms'),
            ));

            $memberFullyRequired->is_admin = 1;
            $memberFullyRequired->is_purchaser = 1;
            $memberFullyRequired->save();

            $memberFullyRequired->auto_enrol();

            $memberFullyRequired->user->force_login();
            $memberFullyRequired->user->save();

            $this->session->set_userdata(array(
                'member_id' => $memberFullyRequired->id,
                'OrgID' => $memberFullyRequired->organisation_id
            ));

            $this->session->set_flashdata('alert_success', "Welcome to the ".$memberFullyRequired->organisation->name." Academy.");
            redirect(lang_url('/dashboard/'));

        } catch (OrganisationInstanceException $e) {

            return $this->loadView(
                'auth/register',
                array(
                    'message' => 'Organisation could not be created at this time.',
                )
            );

        } catch (Exception $e) {

            $organisation->destroy();

            return $this->loadView(
                'auth/register',
                array(
                    'message' => $e->getMessage(),
                )
            );
        }
    }

    public function join($public_id) {

        if ($this->isActiveSession()) {
            $this->session->sess_destroy();
        }

        try {

            $organisation = Organisation::find_valid_by_pub_id($public_id);

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->loadView(
                    'auth/join',
                    array('organisation' => $organisation)
                );
            }

            $memberFullyRequired = MemberFullyRequired::create(array(
                'organisation' => $organisation,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'password_confirm' => $this->input->post('password_confirm'),
                'terms' => $this->input->post('terms'),
            ));

            $memberFullyRequired->auto_enrol();

            $memberFullyRequired->user->force_login();
            $memberFullyRequired->save();

            $this->session->set_userdata(array(
                'member_id' => $memberFullyRequired->id,
                'OrgID' => $memberFullyRequired->organisation_id
            ));

            /*$enrolment_standard_auto = new EnrolmentStandardAuto();
            $enrolment_standard_auto->set_member($member);
            $enrolment_standard_auto->create_enrolments();*/

            $this->session->set_flashdata('alert_success', "Welcome to the ".$memberFullyRequired->organisation->name." Academy.");
            redirect(lang_url('/dashboard/'));

        } catch (EnrolmentStandardAutoNoLicensesExistException $e) {

            $this->session->set_flashdata('alert_success', "Welcome to the ".$memberFullyRequired->organisation->name." Academy.");
            redirect(lang_url('/dashboard/'));         

        } catch (Exception $e) {

            if(isset($organisation)) {

                return $this->loadView('auth/join', array(
                    'organisation' => $organisation,
                    'message' => $e->getMessage(),
                ));
            }

            return $this->loadView('auth/join', array(
                'message' => $e->getMessage(),
            ));
        }
    }

    public function forgotpassword() {

        if ($this->isActiveSession()) {
            $this->session->sess_destroy();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->loadView('auth/forgotpassword');
        }

        try {

            $member = Member::find_valid_registered_by_email(
                $this->input->post('email')
            );
            
            $member->user->forget_password();

            Email::push(array(
                'type' => 'password-reset',
                'from' => 'accounts@academyhq.com',
                'to' => $member->email,
                'subject' => lang('emailer.cont.process.reset', $member->organisation->name),
                'body' => nl2br($this->load->view(
                    'emails/users/password_reset', 
                    array('member' => $member), 
                    true
                )),
            ));

            return $this->loadView('auth/forgotpassword_complete');

        } catch (Exception $e) {

            return $this->loadView(
                'auth/forgotpassword',
                array(
                    'message' => $e->getMessage(),
                )
            );

        }
    }

    public function resetpassword($public_hashkey) {

        if ($this->isActiveSession()) {
            $this->session->sess_destroy();
        }

        try {

            $user = User::find_valid_by_public_hashkey($public_hashkey);

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->loadView(
                    'auth/resetpassword',
                    array('user' => $user)
                );
            }

            $user->reset_password(
                $this->input->post('new_password'), 
                $this->input->post('new_password_confirm')
            );

            $user->force_login();
            $user->save();

            $this->session->set_userdata(array(
                'member_id' => $user->member->id,
                'OrgID' => $user->member->organisation_id
            ));

            $this->session->set_flashdata('alert_success', "Welcome back to the ".$user->member->organisation->name." Academy. Your password has been successfully reset!");
            redirect('/dashboard/');

        } catch (Exception $e) {
            return $this->loadView(
                'auth/resetpassword',
                array(
                    'message' => $e->getMessage(),
                )
            );
        }
    }

    public function invite($public_hashkey) {

        if ($this->isActiveSession()) {
            $this->session->sess_destroy();
        }

        try {

            $invite = Invite::find_valid_by_public_hashkey($public_hashkey);
            $member_invite = new MemberInvite();
            $member_invite->set_member_variable($invite->member);
            $member_invite->set_invite_variable($invite);

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

                return $this->loadView('auth/invite', array(
                    'member' => $invite->member,
                ));
            }

            $member_invite->register_invite(array(
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'password' => $this->input->post('password'),
                'password_confirm' => $this->input->post('password_confirm'),
                'terms' => $this->input->post('terms'),
            ));

            $invite->member->user->force_login();
            $invite->member->user->save();

            $this->session->set_userdata(array(
                'member_id' => $invite->member->id,
                'OrgID' => $invite->member->organisation_id
            ));

            $this->session->set_flashdata('alert_success', "Welcome to the ".$invite->member->organisation->name." Academy.");
            redirect(lang_url('/dashboard/'));

        } catch(InviteNotExistsException $e){
            $this->session->set_flashdata('alert_success',$e->getMessage());
            redirect(lang_url('/auth/login'));
            

        } catch (Exception $e) {
            
            return $this->loadView('auth/invite', array(
                'member' => $invite->member,
                'message' => $e->getMessage(),
            ));
        }
    }

}