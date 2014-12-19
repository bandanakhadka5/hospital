<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diseases extends BaseController {

	public function typeahead($search = null){

        if(is_null($search)){
            return json_encode('');
        }

        $page = new Page();
        $page->set_current_page_number(1);
        $page->set_per_page(8);

        $disease_search = new DiseaseSearch();
        $disease_search ->set_order('name', 'desc')
                        ->set_search_term(urldecode($search))
                        ->set_page($page)
                        ->execute();

        $diseases = array();
        if($disease_search->get_total_rows() > 0) {
            foreach($disease_search as $disease) {
                $diseases[] = array('ID' => $disease->id, 'FullIdentifier' => $disease->name);
            }
        }

        $this ->output
              ->set_content_type('application/json')
              ->set_output(json_encode($diseases));
    }
}

?>