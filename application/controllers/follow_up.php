<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow_up extends BaseController {

	public function index() {

		if(array_key_exists('page', $_GET)) {

            $cur_page = $_GET['page'];
        }
        else {
            $cur_page = 1;
        }

        $page = new Page();
        $page->set_current_page_number($cur_page);
        $page->set_per_page(20);

        if(array_key_exists('order_by_field', $_GET)) {

            $order_by_field = $_GET['order_by_field'];
        }
        else {
            $order_by_field = 'created_at';
        }

        if(array_key_exists('order_by_direction', $_GET)) {

            $order_by_direction = $_GET['order_by_direction'];
        }
        else {
            $order_by_direction = 'desc';
        }

        if(array_key_exists('search', $_GET)) {

            $search = $_GET['search'];
        }
        else {
            $search = null;
        }

        $follow_up_search = new FollowUpSearch();
        $follow_up_search ->set_order($order_by_field, $order_by_direction)
                          ->set_page($page)
                          ->set_search_term($search)
                          ->execute();

		$data['follow_ups'] = $follow_up_search;

		return $this->load_view('admin/patient/follow_up',$data);
	}

	public function create() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect(lang_url('/follow_up/'));
	        }

	        $params = $this->input->post();
	        
	        $patient = Patient::find_by_pub_id($params['pub_id']);
	        $params['patient_id'] = $patient->id;
	        $existing_follow_up = FollowUp::find_by_patient_id_and_active($patient->id,1);

	        if($existing_follow_up) {

	        	$existing_follow_up->deactivate();
	        }

	        $follow_up = FollowUp::create($params);

	        $follow_up->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Follow Up was added successfully."
	        );

	        redirect(lang_url('/patients/'));
	    }

	    catch(Exception $e) {

	    	return $this->load_view(
	                'admin/patient/index',
	                array(
	                    'message'=>$e->getMessage(),
	                )
	            );
	    }
	}

}