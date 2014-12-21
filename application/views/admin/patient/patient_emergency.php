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
						<?php if($patients_emergency->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?php echo $this->bspaginator->table_header();?>

								<tbody>
									<?php foreach ($patients_emergency as $patient_emergency){
										$patient = Patient::find_by_id($patient_emergency->patient_id);
										if($patient){
									 ?>
										<tr>
											<td><?php echo $patient->pub_id;?></td>
											<td><?php echo $patient->first_name.' '.$patient->last_name;?></td>				
											<td><?php echo $patient->age;?></td>			
											<td><?php echo $patient->address;?></td>
											<td><?php echo $patient->contact_number;?></td>
											<td><?php echo date('Y-m-d',strtotime($patient_emergency->created_at));?></td>
											<td><?php echo $patient_emergency->chief_compliants;?>
											<td><button class="btn btn-success btn-sm" onclick="pass_pub_id_and_type_id('<?php echo $patient->pub_id;?>','<?php echo $patient_emergency->id;?>');" data-toggle="modal" data-target="#myModal">
												  Add Diagnosis
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

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Diagnosis</h4>
	      </div>
	      <form class="form" role="form" method ="POST" action="<?php echo base_url('diagnosis/create');?>">
		      <div class="modal-body">
		    		<div class="form-group" style="width:100%;">
		    			
		    		    <label for="Public Id">Public Id</label>
		    		    <input type="text" name="pub_id" class="form-control" id="publicid" placeholder="Enter Public ID Of Patient">

		    		    <label for="Doctor">Doctor</label>
		    		    <input type="text" name="doctor" class="form-control" id="doctor" placeholder="Enter Name Of Doctor">

		    		    <label for="Consultation Type">Consultation Type</label>
		    		    <input type="text" name="consultation_type" class="form-control" id="consultation_type" value="Emergency" readonly>

				        <label for="Diagnosis">Diagnosis</label>
				        <input type="text" data-name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead form-control"/>
				        <input type="hidden" name="disease_id" value="<?php echo ($this->input->post('disease_id') ? $this->input->post('disease_id') : '');?>"/>
       					<input type="hidden" name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>"/>
    
		    		    <label for="Details">Details</label>
		    		    <textarea class="form-control" rows="5" name="details"  id="details"></textarea>
		    		    
		    		    <label for="TypeId"></label>
		    		    <input type="hidden" name="type_id" id="type_id" value="">
		    		    
		    		</div>

		    		<div id="message"></div>

		      </div>
		      <div class="modal-footer">
		   
		        <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
	  		</form>
	    </div>
	  </div>
	</div>



<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

	function pass_pub_id_and_type_id(pub_id,type_id){

		document.getElementById('publicid').value = pub_id;
		document.getElementById('publicid').readOnly = true;

		document.getElementById('type_id').value = type_id;
		document.getElementById('type_id').readOnly = true;
	}

</script>