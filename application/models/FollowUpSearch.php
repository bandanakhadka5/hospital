<?php

class FollowUpSearch extends Search {

	protected $date_from = null;
	protected $date_to = null;

	public function __construct() {

		parent::__construct();
	}

	public function set_date_from($date_from = null) {

		if(!is_null($date_from)) {

			$date_from = urldecode($date_from);

			$date_from  = Patient::convert_date($date_from);
			
			if($date_from == '' || $date_from === NULL) {

			    throw new Exception("Invalid Date! Please Try Again");

			}

			
			$this->date_from = trim($date_from);
		}

		return $this;
	}

	public function set_date_to($date_to = null) {

		if(!is_null($date_to)) {

			$date_to = urldecode($date_to);

			$date_to  = Patient::convert_date($date_to);
			
			if($date_to == '' || $date_to === NULL) {

			    throw new Exception("Invalid Date! Please Try Again");

			}

			$this->date_to = trim($date_to);
		}

		return $this;
	}

	public function get_date_from() {

		return $this->date_from;
	}

	public function get_date_to() {

		return $this->date_to;
	}

	protected function build_joins() {

		return array('patient');
	}

	protected function build_conditions($options) {

		$conditions = parent::build_conditions($options, FollowUp::$table_name);

		$condition_string = $conditions[0];

		if(isset($options->from)) {

			$condition_string .= 'and '.FollowUp::$table_name.'.follow_up_date >= ? ';
			array_push($conditions, $options->from);
		}

		if(isset($options->to)) {

			$condition_string .= 'and '.FollowUp::$table_name.'.follow_up_date <= ? ';
			array_push($conditions, $options->to.' 23:59:59');
		}

		if(isset($options->search) && $options->search !== '') {

			$condition_string .= "and (
				".Patient::$table_name.".pub_id LIKE ?
					or ".Patient::$table_name.".first_name LIKE ?
					or ".Patient::$table_name.".last_name LIKE ?
					or ".Patient::$table_name.".middle_name LIKE ?
					or ".Patient::$table_name.".address LIKE ?
					or ".FollowUp::$table_name.".doctor LIKE ?
			)";
			
			array_push($conditions, '%'.$options->search.'%');
        	array_push($conditions, '%'.$options->search.'%');
        	array_push($conditions, '%'.$options->search.'%');
        	array_push($conditions, '%'.$options->search.'%');
        	array_push($conditions, '%'.$options->search.'%');
        	array_push($conditions, '%'.$options->search.'%');
		}

		$conditions[0] = $condition_string;

		return $conditions;
	}

	protected function build_options() {

		$options = parent::build_options();

		if(!is_null($this->date_from)) {

			$options->from = $this->date_from;
		}

		if(!is_null($this->date_to)) {

			$options->to = $this->date_to;
		}

		return $options;
	}

	public function execute() {

		$options = $this->build_options();
		$i = 0;

		$query = array(
			'joins' => $this->build_joins($options),
			'conditions' => $this->build_conditions($options),
			'order' => $this->get_order(),
			'limit' => $this->get_page_size(),
			'offset' => $this->build_offset(),
		);

		parent::execute(new FollowUp, $query);
	}
}