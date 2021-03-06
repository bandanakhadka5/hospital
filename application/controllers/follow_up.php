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

        if(array_key_exists('date_from', $_GET)) {

            $date_from = ($_GET['date_from'] != '') ? $_GET['date_from'] : null;
        }
        else {
            $date_from = null;
        }

        if(array_key_exists('date_to', $_GET)) {

            $date_to = ($_GET['date_to'] != '') ? $_GET['date_to'] : null;
        }
        else {
            $date_to = null;
        }

        $follow_up_search = new FollowUpSearch();
        try
        {

            $follow_up_search ->set_order($order_by_field, $order_by_direction)
                              ->set_page($page)
                              ->set_search_term($search)
                              ->set_date_from($date_from)
                              ->set_date_to($date_to)
                              ->execute();    
        
		    $data['follow_ups'] = $follow_up_search;

		     return $this->load_view('admin/followup/follow_up',$data);

        } catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/follow_up');
        }
	}

	public function create() {

		try {

	        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	            redirect('/follow_up');
	        }

	        $params = $this->input->post();

	        $follow_up = FollowUp::create($params);

	        $follow_up->save();

	        $this->session->set_flashdata(
	        	'alert_success', 
	        	"Follow Up was added successfully."
	        );

	        redirect('/follow_up');
	    }

	    catch(Exception $e) {

	    	$this->session->set_flashdata('alert_error', $e->getMessage());
	    	redirect('/follow_up');
	    }
	}

    public function edit($follow_up_id) {

        try {

            $follow_up = FollowUp::find_by_id($follow_up_id);

            if(!$follow_up) {
                throw new Exception("Invalid Followup!");                
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->load_view('admin/followup/edit',array('follow_up' => $follow_up));
            }
            
            $follow_up->follow_up_date = $this->input->post('follow_up_date');
            $follow_up->doctor = $this->input->post('doctor');            

            $follow_up->save();

            $this->session->set_flashdata(
                'alert_success', 
                "Follow Up details edited successfully."
            );

            redirect('/follow_up');
        }

        catch(Exception $e) {

            $this->session->set_flashdata('alert_error', $e->getMessage());
            redirect('/follow_up');
        }
    }
}