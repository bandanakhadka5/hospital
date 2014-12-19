<?php

class Dashboard extends BaseController {

	public function index() {

        $data['patients_in_bed'] = PatientInpatient::find('all', array(
                                        'conditions' => array(
                                            'date_of_discharge is null and 
                                            deleted = ?',
                                            0
                                            ),
                                        'limit' => 10
                                        ));

        $data['follow_ups'] = FollowUp::find('all', array(
                                        'conditions' => array(
                                            'follow_up_date = ?',
                                            date('Y-m-d')
                                            ),
                                        'limit' => 10
                                        ));

        return $this->load_view('dashboard',$data);
	}
}

?>