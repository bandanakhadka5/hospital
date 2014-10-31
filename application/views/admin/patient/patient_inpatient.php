<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Pub ID' => 'pub_id',
    	'Name' => 'first_name', 
    	'Age' => 'age', 
    	'Address' => 'address',
    	'Contact Number' => 'contact_number',
    	'Date Of Admission' => 'date_of_admission',
    	'Date Of Procedure' => 'date_of_procedure',
    	'Date Of Discharge' => 'date_of_discharge',
    ),
    'cur_page' => $patients_inpatient->get_current_page(),
    'base_url' => '/hospital/patient_Inpatient',
    'order_by_field' => $patients_inpatient->get_field(),
    'order_by_direction' => $patients_inpatient->get_direction(),
    'search' => $patients_inpatient->get_search_term(),
    'total_rows' => $patients_inpatient->get_total_rows(),
    'per_page' => $patients_inpatient->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing OPD Patients</h2>
				<h5 style="margin-left:5px;">Showing result<?=($patients_inpatient->get_total_rows() == 1) ? '' : 's'?> <?=($patients_inpatient->get_page_size() > $patients_inpatient->get_total_rows()) ? $patients_inpatient->get_total_rows() : ($patients_inpatient->get_page_size() * ($patients_inpatient->get_current_page() - 1) + 1) .' - '. ($patients_inpatient->get_page_size() * ($patients_inpatient->get_current_page() - 1) + $patients_inpatient->get_row_per_current_page())?> of <?=number_format($patients_inpatient->get_total_rows())?></h5>
			</div>

			<div class="pager pull-right" style="margin-top: 5px;">
				<?=$this->bspaginator->pagination_links()?>
			</div>

			<br/><br/><br/>

			<br/><br/>
	</div>

	<br/>

	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-patient" action="<?php echo base_url('patient_Inpatient');?>">
						
						<input style="width:20%;align:left;" name="search" type="text" value="<?=$patients_inpatient->get_search_term() ? $patients_inpatient->get_search_term() : ''?>" placeholder="Type search term..." autofocus>

						<br/><br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>
					<hr>
					<div class="span9">
						<?php if($patients_inpatient->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?=$this->bspaginator->table_header()?>

								<tbody>
									<?php foreach ($patients_inpatient as $patients_inpatient){
										$patient = Patient::find_by_id($patients_inpatient->patient_id);
										if($patient){
									 ?>
										<tr>
											<td><?=$patient->pub_id?></td>
											<td><?=$patient->first_name.' '.$patient->last_name?></td>				
											<td><?=$patient->age?></td>			
											<td><?=$patient->address?></td>
											<td><?=$patient->contact_number?></td>
											<td><?=$patients_inpatient->date_of_admission?></td>
											<td><?=$patients_inpatient->date_of_procedure?>
											<td><?=$patients_inpatient->date_of_discharge?>
											</td>
											<td><button class="btn btn-success btn-sm" onclick="pass_pub_id('<?=$patient->pub_id;?>');" data-toggle="modal" data-target="#myModal">
												  View Diagnosis
												</button></td>
										</tr>
									<?php } }?>
								</tbody>
							</table>

						<?php } else { ?>
							<div class="well" style="text-align:center; padding:100px 0;">
								<p style="font-size:24px;">No Patients found.</p>
								<p style="font-size:14px;">Your patient query has not returned any valid results.</p>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>



<?php endblock() ?>

<?php end_extend() ?>