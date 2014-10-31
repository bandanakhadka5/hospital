<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Pub ID' => 'pub_id',
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
				<h5 style="margin-left:5px;">Showing result<?=($follow_ups->get_total_rows() == 1) ? '' : 's'?> <?=($follow_ups->get_page_size() > $follow_ups->get_total_rows()) ? $follow_ups->get_total_rows() : ($follow_ups->get_page_size() * ($follow_ups->get_current_page() - 1) + 1) .' - '. ($follow_ups->get_page_size() * ($follow_ups->get_current_page() - 1) + $follow_ups->get_row_per_current_page())?> of <?=number_format($follow_ups->get_total_rows())?></h5>
			</div>

			<div class="pager pull-right" style="margin-top: 5px;">
				<?=$this->bspaginator->pagination_links()?>
			</div>

			<br/>
	</div>

	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-patient" action="<?php echo base_url('follow_up/index');?>">
						
						<input style="width:20%;align:left;" name="search" type="text" value="<?=$follow_ups->get_search_term() ? $follow_ups->get_search_term() : ''?>" placeholder="Type search term..." autofocus>

						<br/><br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						<br/><br/>
					</form>

					<button class="btn btn-success btn-lg" onclick="clear_form_fields();" data-toggle="modal" data-target="#myModal">Add Follow Up</button>
					
					<hr>
					<div class="span9">
						<?php if($follow_ups->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?=$this->bspaginator->table_header()?>

								<tbody>
									<?php foreach ($follow_ups as $follow_up){ ?>
										<tr>
											<td><?=$follow_up->patient->pub_id?></td>
											<td><?=$follow_up->patient->first_name?></td>
											<td><?=$follow_up->patient->last_name?></td>
											<td><?=$follow_up->patient->age?></td>
											<td>
												<?php
												if($follow_up->patient->sex == 0)
													echo "Male";
												else
													echo "Female";
												?>
											</td>
											<td><?=$follow_up->patient->address?></td>
											<td><?=$follow_up->patient->contact_number?></td>
											<td><?=$follow_up->patient->last_visited_at?></td>
											<td><?=$follow_up->doctor?></td>
											<td><?=$follow_up->follow_up_date?></td>
											<td><?=$follow_up->consultation_type?></td>
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
	        <h4 class="modal-title" id="myModalLabel">Enter PubId Of Patient</h4>
	      </div>

	      <form class="form" role="form" method ="POST" action="<?php echo base_url('follow_up/create');?>">
	      <div class="modal-body">
	    		<div class="form-group" style="width:80%;">

	    		    <label for="Public Id">Public Id</label>
	    		    <input type="text" class="form-control" name="pub_id" id="publicid" placeholder="Enter Public ID Of Patient" autofocus>

	    		    <label for="Doctor">Doctor</label>
	    		    <input type="text" class="form-control" name="doctor" id="doctor" placeholder="Enter Doctor's Name">

	    		    <label for="Consultation Type">Consultation Type</label>
	    		    <input type="text" class="form-control" name="consultation_type" id="consultation_type" placeholder="Enter Consultation Type">

	    		    <label for="Follow Up Date">Follow Up Date</label>
	    		    <input type="date" class="form-control" name="follow_up_date" id="follow_up_date" placeholder="Enter Date">
	    		    
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