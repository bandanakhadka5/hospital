<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Pub ID' => 'pub_id',
    	'Name' => 'first_name', 
    	'Address' => 'address',
    	'Contact Number' => 'contact_number',
    	'Date Of Consultation' => 'date_of_consultation',
    	'Chief Compliants' => 'chief_complaints'
    ),
    'cur_page' => $patients_emergency->get_current_page(),
    'base_url' => '/hospital/patient_Emergency',
    'order_by_field' => $patients_emergency->get_field(),
    'order_by_direction' => $patients_emergency->get_direction(),
    'search' => $patients_emergency->get_search_term(),
    'total_rows' => $patients_emergency->get_total_rows(),
    'per_page' => $patients_emergency->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing Emergency Patients</h2>
				<h5 style="margin-left:5px;">Showing result<?php echo ($patients_emergency->get_total_rows() == 1) ? '' : 's';?> <?php echo ($patients_emergency->get_page_size() > $patients_emergency->get_total_rows()) ? $patients_emergency->get_total_rows() : ($patients_emergency->get_page_size() * ($patients_emergency->get_current_page() - 1) + 1) .' - '. ($patients_emergency->get_page_size() * ($patients_emergency->get_current_page() - 1) + $patients_emergency->get_row_per_current_page());?> of <?php echo number_format($patients_emergency->get_total_rows());?></h5>
			</div>

			<div class="pager pull-right" style="margin-top: 5px;">
				<?php echo $this->bspaginator->pagination_links();?>
			</div>

			<br/>
	</div>

	<br/>

	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-patient" action="<?php echo base_url('patient_emergency');?>">
						
						<input style="width:20%;align:left;" class="form-control" name="search" type="text" value="<?php echo $patients_emergency->get_search_term() ? $patients_emergency->get_search_term() : '';?>" placeholder="Type search term..." autofocus>

						<br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>
					<hr>
					<div class="span9">
						<?php if($patients_emergency->get_total_rows() > 0) { ?>

						<div class="table-container">
							<table class="table table-striped table-bordered" style="margin-bottom:60px;">

								<?php echo $this->bspaginator->table_header();?>

								<tbody>
									<?php foreach ($patients_emergency as $patient_emergency) {
									 ?>
										<tr>
											<td><?php echo $patient_emergency->patient->pub_id;?></td>
											<td><?php echo $patient_emergency->patient->get_full_name();?></td>														
											<td><?php echo $patient_emergency->patient->address;?></td>
											<td><?php echo $patient_emergency->patient->contact_number;?></td>
											<td><?php echo Patient::english_to_nepali(date('Y-m-d',strtotime($patient_emergency->created_at)));?></td>
											<td><?php echo $patient_emergency->chief_compliants;?></td>

											<td style="text-align:center;width:65px;">
											<div class="btn-group">
						  						<a class="btn dropdown-toggle" style="border:1px solid #eee;" data-toggle="dropdown" href="#">
						    						Actions <span class="caret"></span>
						  						</a>
												<ul class="dropdown-menu" style="text-align:left;">

													<?php if($patient_emergency->is_deleted()) { ?>
														
														<li><a href="<?php echo base_url('patient_emergency/undelete/'.$patient_emergency->id);?>" onclick="return confirm_undelete();">Undelete</a></li>

													<?php } else { ?>
														
														<li><a href="<?php echo base_url('diagnosis/emergency_diagnosis/'.$patient_emergency->patient->pub_id.'/'.$patient_emergency->id);?>">Add Diagnosis</a></li>
														<li><a href="<?php echo base_url('patient_emergency/delete/'.$patient_emergency->id);?>" onclick="return confirm_delete();">Delete</a></li>

													<?php } ?>
												</ul>
											</div>
										</td>
										</tr>
									<?php } ?>
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

<script type="text/javascript">

	function confirm_delete() {
		return confirm('Are you sure you want to delete the patient?');
	}

	function confirm_undelete() {
		return confirm('Are you sure you want to undelete the patient?');
	}

</script>