<?php

class Dashboard extends BaseController {

	public function index() {

		$data['users'] = User::find('all');

		return $this->load_view('dashboard',$data);
	}

	public function search() {

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
            $order_by_field = 'CreatedAt';
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

        $user_search = new UserSearch();
        $user_search ->set_order($order_by_field, $order_by_direction)
                     ->set_page($page)
                     ->set_search_term($search)
                     ->execute();

		return $this->load_view('test', array('users' => $user_search));
	}
}

?>