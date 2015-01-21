<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Patient No.' => 'pub_id',
    	'Name' => 'first_name',  
    	'Address' => 'address',
    	'Last Visited At' => 'last_visited_at',
    	'Chief Compliants' => 'chief_compliants',
    	'Doctor' => 'Doctor'
    ),
    'cur_page' => $patients_opd->get_current_page(),
    'base_url' => '/hospital/patient_Opd',
    'order_by_field' => $patients_opd->get_field(),
    'order_by_direction' => $patients_opd->get_direction(),
    'search' => $patients_opd->get_search_term(),
    'total_rows' => $patients_opd->get_total_rows(),
    'per_page' => $patients_opd->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing OPD Patients</h2>
				<h5 style="margin-left:5px;">Showing result<?php echo ($patients_opd->get_total_rows() == 1) ? '' : 's';?> <?php echo ($patients_opd->get_page_size() > $patients_opd->get_total_rows()) ? $patients_opd->get_total_rows() : ($patients_opd->get_page_size() * ($patients_opd->get_current_page() - 1) + 1) .' - '. ($patients_opd->get_page_size() * ($patients_opd->get_current_page() - 1) + $patients_opd->get_row_per_current_page());?> of <?php echo number_format($patients_opd->get_total_rows());?></h5>
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

					<form name="search-patient" action="<?php echo base_url('patient_Opd');?>">
						
						<input style="width:20%;align:left;" class="form-control" name="search" type="text" value="<?php echo $patients_opd->get_search_term() ? $patients_opd->get_search_term() : '';?>" placeholder="Type search term..." autofocus>

						<br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>
					<hr>
					<div class="span9">
						<?php if($patients_opd->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered" style="margin-bottom:60px;">

								<?php echo $this->bspaginator->table_header();?>

								<tbody>
									<?php foreach ($patients_opd as $patient_opd) {
									 ?>
										<tr>
											<td><?php echo $patient_opd->patient->pub_id;?></td>
											<td><?php echo $patient_opd->patient->get_full_name();?></td>			
											<td><?php echo $patient_opd->patient->address;?></td>			
											<td><?php echo Patient::english_to_nepali(date('Y-m-d',strtotime($patient_opd->created_at)));?></td>
											<td><?php echo $patient_opd->chief_compliants;?>
											<td><?php echo $patient_opd->doctor;?>
											</td>

											<td style="text-align:center;width:65px;">
											<div class="btn-group">
						  						<a class="btn dropdown-toggle" style="border:1px solid #eee;" data-toggle="dropdown" href="#">
						    						Actions <span class="caret"></span>
						  						</a>
												<ul class="dropdown-menu" style="text-align:left;">

													<?php if($patient_opd->is_deleted()) { ?>
														
														<li><a href="<?php echo base_url('patient_opd/undelete/'.$patient_opd->id);?>" onclick="return confirm_undelete();">Undelete</a></li>

													<?php } else { ?>

														<li><a href="<?php echo base_url('diagnosis/opd_diagnosis/'.$patient_opd->patient->pub_id.'/'.$patient_opd->id);?>">Add Diagnosis</a></li>
														<li><a href="<?php echo base_url('patient_opd/delete/'.$patient_opd->id);?>" onclick="return confirm_delete();">Delete</a></li>

													<?php } ?>
												</ul>
											</div>
											</td>
										</tr>
									<?php }?>
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