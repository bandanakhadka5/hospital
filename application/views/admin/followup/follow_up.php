<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Patient No.' => 'pub_id',
    	'OPD No.' => 'opd_no',
    	'IPD No.' => 'ipd_no',
    	'First Name' => 'first_name', 
    	'Last Name' => 'last_name',
    	'Age' => 'age', 
    	'Sex' => 'sex',
    	'Address' => 'address',
    	'Contact Number' => 'contact_number',
    	'Last Visited At' => 'last_visited_at',
    	'Doctor' => 'doctor',
    	'FollowUp Date' => 'follow_up_date',
    	'Consultation Type' => 'consultation_type'
    ),
    'cur_page' => $follow_ups->get_current_page(),
    'base_url' => '/hospital/follow_up/index',
    'order_by_field' => $follow_ups->get_field(),
    'order_by_direction' => $follow_ups->get_direction(),
    'search' => $follow_ups->get_search_term(),
    'date_from' => $follow_ups->get_date_from(),
    'date_to' => $follow_ups->get_date_to(),
    'total_rows' => $follow_ups->get_total_rows(),
    'per_page' => $follow_ups->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing Patients' Follow Ups</h2>
				<h5 style="margin-left:5px;">Showing result<?php echo ($follow_ups->get_total_rows() == 1) ? '' : 's';?> <?php echo ($follow_ups->get_page_size() > $follow_ups->get_total_rows()) ? $follow_ups->get_total_rows() : ($follow_ups->get_page_size() * ($follow_ups->get_current_page() - 1) + 1) .' - '. ($follow_ups->get_page_size() * ($follow_ups->get_current_page() - 1) + $follow_ups->get_row_per_current_page());?> of <?php echo number_format($follow_ups->get_total_rows());?></h5>
			</div>

			<div class="pager pull-right" style="margin-top: 5px;">
				<?php echo $this->bspaginator->pagination_links();?>
			</div>

			<br/>
	</div>

	<div class="row-fluid" style="margin-top:90px;">
		<button class="btn btn-success" class="pull-right" onclick="clear_form_fields();" style="margin-bottom:10px;" data-toggle="modal" data-target="#myModal">Add Follow Up</button>
		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-patient" action="<?php echo base_url('follow_up/index');?>">
						<div class="row-fluid">
							<div class="col-lg-12" style="margin-bottom:2%;margin-top:20px%;">
								<div class="col-lg-3">
									<label for="Search Term">Search Term</label>
									<input style="" class="form-control" name="search" type="text" value="<?php echo $follow_ups->get_search_term() ? $follow_ups->get_search_term() : '';?>" placeholder="Type search term..." autofocus>
								</div>
								
								<div class="col-lg-4">
									<label for="datefrom">Date From</label>
									<input type="text" value="<?php echo $follow_ups->get_date_from() ? Patient::english_to_nepali($follow_ups->get_date_from()) : '';?>" name="date_from" id="date_from" class="form-control nepali-calendar" placeholder="yyyy-mm-dd">
								</div>
								<div class="col-lg-4">
									<label for="dateto">Date To</label>
									<input type="text" value="<?php echo $follow_ups->get_date_to() ? Patient::english_to_nepali($follow_ups->get_date_to()) : '';?>" name="date_to" id="date_to" class="form-control nepali-calendar" placeholder="yyyy-mm-dd">
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
						<?php if($follow_ups->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?php echo $this->bspaginator->table_header();?>

								<tbody>
									<?php foreach ($follow_ups as $follow_up){ ?>
										<tr>
											<td><?php echo $follow_up->patient->pub_id;?></td>
											<td><?php echo $follow_up->patient->opd_no;?></td>
											<td><?php echo $follow_up->patient->ipd_no;?></td>
											<td><?php echo $follow_up->patient->first_name;?></td>
											<td><?php echo $follow_up->patient->last_name;?></td>
											<td><?php echo $follow_up->patient->age;?></td>
											<td>
												<?php
												if($follow_up->patient->sex == 0)
													echo "Male";
												else
													echo "Female";
												?>
											</td>
											<td><?php echo $follow_up->patient->address;?></td>
											<td><?php echo $follow_up->patient->contact_number;?></td>
											<td><?php echo Patient::english_to_nepali(date('Y-m-d',strtotime($follow_up->patient->last_visited_at)));?></td>
											<td><?php echo $follow_up->doctor;?></td>
											<td><?php echo Patient::english_to_nepali(date('Y-m-d',strtotime($follow_up->follow_up_date)));?></td>
											<td><?php echo $follow_up->consultation_type;?></td>
											<td><a href="<?php echo base_url('follow_up/edit/'.$follow_up->id);?>"><button class="btn btn-success btn-sm">Edit</button></a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php } else { ?>
							<div class="well" style="text-align:center; padding:100px 0;">
								<p style="font-size:24px;">No Follow ups found.</p>
								<p style="font-size:14px;">Your follow up query has not returned any valid results.</p>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Follow Up</h4>
	      </div>

	      <form class="form" role="form" method ="POST" action="<?php echo base_url('follow_up/create');?>">
	      <div class="modal-body">
	    		<div class="form-group" style="width:80%;">

	    		    <label for="pub_id">Patient No.</label>
	    		    <input type="text" class="form-control" name="pub_id" id="pub_id" placeholder="Enter Patient No." autofocus>

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
	    		    <input type="text" name="follow_up_date" id="follow_up_date" class="form-control" placeholder="yyyy-mm-dd">
	    		</div>

	    		<div id="message"></div>

	      </div>
	      <div class="modal-footer">
	   
	        <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add Follow Up</button>
	      </div>
	    </form>	
	</div>
</div>

<?php endblock() ?>

<?php end_extend() ?>