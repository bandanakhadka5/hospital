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
    	'Last Visited At' => 'last_visited_at'
    ),
    'cur_page' => $patients->get_current_page(),
    'base_url' => '/hospital/patients/index',
    'order_by_field' => $patients->get_field(),
    'order_by_direction' => $patients->get_direction(),
    'search' => $patients->get_search_term(),
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
				<h5 style="margin-left:5px;">Showing result<?=($patients->get_total_rows() == 1) ? '' : 's'?> <?=($patients->get_page_size() > $patients->get_total_rows()) ? $patients->get_total_rows() : ($patients->get_page_size() * ($patients->get_current_page() - 1) + 1) .' - '. ($patients->get_page_size() * ($patients->get_current_page() - 1) + $patients->get_row_per_current_page())?> of <?=number_format($patients->get_total_rows())?></h5>
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

					<form name="search-patient" action="<?php echo base_url('patients/index');?>">
						
						<input style="width:20%;align:left;" name="search" type="text" value="<?=$patients->get_search_term() ? $patients->get_search_term() : ''?>" placeholder="Type search term..." autofocus>

						<br/><br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>
					<hr>
					<div class="span9">
						<?php if($patients->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?=$this->bspaginator->table_header()?>

								<tbody>
									<?php foreach ($patients as $patient){ ?>
										<tr>
											<td><?=$patient->pub_id?></td>
											<td><?=$patient->first_name?></td>
											<td><?=$patient->last_name?></td>
											<td><?=$patient->age?></td>
											<td>
												<?php
												if($patient->sex == 0)
													echo "Male";
												else
													echo "Female";
												?>
											</td>
											<td><?=$patient->address?></td>
											<td><?=$patient->contact_number?></td>
											<td><?=$patient->last_visited_at?></td>
											<td><button class="btn btn-success btn-sm" onclick="pass_pub_id('<?=$patient->pub_id;?>');" data-toggle="modal" data-target="#myModal">
												  Add Followup
												</button></td>
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
							      <div class="modal-body">
							    		<div class="form-group" style="width:80%;">
							    			
							    		    <label for="Public Id">Public Id</label>
							    		    <input type="text" class="form-control" id="publicid" placeholder="Enter Public ID Of Patient">
							    		    
							    		</div>

							    		<div id="message"></div>

							      </div>
							      <div class="modal-footer">
							   
							        <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
							        <button type="button" class="btn btn-primary">Submit</button>
							      </div>
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


	}
</script>