<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosis extends BaseController {

	public function index() {

		/*if(array_key_exists('page', $_GET)) {

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

		return $this->load_view('admin/patient/follow_up',$data);*/

		return $this->load_view('admin/patient/diagnosis');
	}

	public function create() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect(lang_url('/diagnosis/'));
	        }

	        $params = $this->input->post();

	        $diagnosis = Diagnoses::create($params);

	        $diagnosis->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Diagnosis was added successfully."
	        );

	        redirect('diagnosis/');
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect(lang_url('/diagnosis'));
	    }
	}
}