<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Pub ID' => 'pub_id',
    	'Name' => 'first_name',
    	'Age' => 'age', 
    	'Sex' => 'sex',
    	'Address' => 'address',
    	'Contact Number' => 'contact_number',
    	'Last Visited At' => 'last_visited_at',
    ),
    'cur_page' => $patients->get_current_page(),
    'base_url' => '/hospital/patients/index',
    'order_by_field' => $patients->get_field(),
    'order_by_direction' => $patients->get_direction(),
    'search' => $patients->get_search_term(),
    'diagnosis' => $patients->get_diagnosis(),
    'total_rows' => $patients->get_total_rows(),
    'per_page' => $patients->get_page_size(),
);

$this->bspaginator->config($config);

?>

<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing Patients</h2>
				<h5 style="margin-left:5px;">Showing result<?php echo ($patients->get_total_rows() == 1) ? '' : 's';?> <?php echo ($patients->get_page_size() > $patients->get_total_rows()) ? $patients->get_total_rows() : ($patients->get_page_size() * ($patients->get_current_page() - 1) + 1) .' - '. ($patients->get_page_size() * ($patients->get_current_page() - 1) + $patients->get_row_per_current_page());?> of <?php echo number_format($patients->get_total_rows());?></h5>
			</div>

			<div class="pager pull-right" style="margin-top: 5px;">
				<?php echo $this->bspaginator->pagination_links();?>
			</div>

			<br/>
		</div>
	</div>

	<br/>

	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">

				<form name="search-patient" action="<?php echo base_url('patients/index');?>">
					<div class="row-fluid">
						<div class="col-lg-12" style="margin-bottom:2%;margin-top:20px%;">
							<div class="col-lg-3">
								<label for="Search Term">Search Term</label>
								<input style="" class="form-control" name="search" type="text" value="<?php echo $patients->get_search_term() ? $patients->get_search_term() : '';?>" placeholder="Type search term..." autofocus>
							</div>
							
							<div class="col-lg-7">
								<label for="diagnosis">Diagnosis</label>
								<input type="text" data-name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead form-control"/>
		       					<input type="hidden" name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>"/>
							</div>

							<div class="">
								<label for="search"></label>
								<button type="submit" class="btn btn-success" style="margin-top:2.3%;"><i class="icon-search"></i>Search</button>
							</div>

						</div>
					</div>
					<br>

				</form>
					<hr>
					<div class="span9">
						<?php if($patients->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?php echo $this->bspaginator->table_header();?>

								<tbody>
									<?php foreach ($patients as $patient){ ?>
										<tr>
											<td><?php echo $patient->pub_id;?></td>
											<td><?php echo $patient->get_full_name();?></td>
											<td><?php echo $patient->age;?></td>
											<td>
												<?php
												if($patient->sex == 0)
													echo "Male";
												else
													echo "Female";
												?>
											</td>
											<td><?php echo $patient->address;?></td>
											<td><?php echo $patient->contact_number;?></td>
											<td><?php echo Patient::english_to_nepali(date('Y-m-d',strtotime($patient->last_visited_at)));?></td>
											
											<td style="text-align:center;width:65px;">
											<div class="btn-group">
						  						<a class="btn dropdown-toggle" style="border:1px solid #eee;" data-toggle="dropdown" href="#">
						    						Actions <span class="caret"></span>
						  						</a>
												<ul class="dropdown-menu" style="text-align:left;">	
													<li><a href="<?php echo base_url('patients/edit/'.$patient->id);?>">Edit</a></li>
													<li><a onclick="pass_pub_id('<?php echo $patient->pub_id;?>');" data-toggle="modal" data-target="#myModal">Add Follow Up</a></li>
													<li><a href="<?php echo base_url('patients/view_report/'.$patient->id);?>">View Report</a></li>
												</ul>
											</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">Enter PubId Of Patient</h4>
							      </div>

							      <form class="form" role="form" method ="POST" action="<?php echo base_url('patients/add_follow_up');?>">
							      <div class="modal-body">
							    		<div class="form-group" style="width:80%;">

							    		    <label for="Public Id">Public Id</label>
							    		    <input type="text" class="form-control" name="pub_id" id="publicid" placeholder="Enter Public ID Of Patient">

							    		    <label for="Doctor">Doctor</label>
							    		    <input type="text" class="form-control" name="doctor" id="doctor" placeholder="Enter Doctor's Name">

							    		    <label for="Consultation Type">Consultation Type</label>
							    		    <select class="form-control" name="consultation_type">
									          	<option value="">Select Consultation Type</option>
									            <option value="Emergency">Emergency</option>
									            <option value="Inpatient">Inpatient</option>
									            <option value="OPD">OPD</option>
									        </select>

							    		    <label for="Follow Up Date">Follow Up Date</label>
							    		    <input type="text" name="follow_up_date" id="follow_up_date" class="form-control nepali-calendar" placeholder="yyyy-mm-dd">
							    		</div>

							    		<div id="message"></div>

							      </div>
							      <div class="modal-footer">
							   
							        <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
							        <button type="submit" class="btn btn-primary">Add Follow Up</button>
							      </div>
							    </form>	
						</div>
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

<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

	function pass_pub_id(pub_id) {

		document.getElementById('publicid').value = pub_id;
		document.getElementById('publicid').readOnly = true;
	}
</script>