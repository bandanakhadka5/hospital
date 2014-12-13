<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_who_diseases extends BaseController {

	public function index() {

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            return $this->load_view('common/import');

		}

		$connection = WhoDiseases::connection();

		try {


			$connection->transaction();

			if (empty($_FILES["who_diseases"])) {
			    
			    throw new Exception("Empty file");
			    
			}
				

			$file = $_FILES["who_diseases"]['tmp_name'];

			$file_handle = fopen($file, "r");

			while (!feof($file_handle) ) {

				$line_of_text = fgetcsv($file_handle);

				if($line_of_text[0] != NULL){

					$disease = WhoDiseases::create($line_of_text[0]);
					$disease->save();
				}


			}
			
			$connection->commit();
			

		} catch (Exception $e) {

			$connection->rollback();
			echo $e->getMessage();
		}
	}



}