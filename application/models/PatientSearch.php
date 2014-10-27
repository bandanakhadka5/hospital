<?php

class PatientSearch extends Search {

	public function __construct() {

		parent::__construct();
	}

	protected function build_joins() {

		return array(
				'LEFT JOIN patients_emergency emergency ON (patients.id = emergency.patient_id)',
				'LEFT JOIN patients_opd opd ON (patients.id = opd.patient_id)',
				'LEFT JOIN patients_inpatient inpatient ON (patients.id = inpatient.patient_id)',
			);
	}

	protected function build_conditions($options) {

		$conditions = parent::build_conditions($options, Patient::$table_name);

		$condition_string = $conditions[0];

		if(isset($options->search) && $options->search !== '') {

			$condition_string .= "and (
				".Patient::$table_name.".pub_id LIKE ?
					or ".Patient::$table_name.".first_name LIKE ?
					or ".Patient::$table_name.".last_name LIKE ?
					or ".Patient::$table_name.".middle_name LIKE ?
					or ".Patient::$table_name.".address LIKE ?
			)";
			
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

		//print_r($query);exit;

		parent::execute(new Patient, $query);
	}
}