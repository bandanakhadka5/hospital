<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class SessionController extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if (!$this->isActiveSession()){
            return redirect('/auth/login#f=/' . $this->uri->uri_string());
        }

    }

    public function _remap($method, $params = array()){
        if (method_exists($this, $method)){
            return call_user_func_array(array($this, $method), $params);
        }
        $this->loadView('static/404');
    }

    public function isActiveSession(){
        return ($this->session->userdata('user_id') != '');
    }

    public function getSessionData(){
        return $this->session->userdata;
    }

    public function loadView($template, $data = array(), $return_view = false){
        $data = (array) $data;

        /*$data['IsActiveSession'] = $this->isActiveSession();
        $data['Language'] = $this->language;
        $data['LanguageCode'] = $this->language_code;
        $data['IsIndex'] = count($this->uri->segment_array()) < 2;

        $preferred_domain = $this->input->cookie('preferred_domain');

        $data['branding_organisation'] = Organisation::find_by_domain($preferred_domain);

        $data = array_merge($this->getSessionData(), $data);*/

        return $this->load->view($template, $data, $return_view);
    }
}