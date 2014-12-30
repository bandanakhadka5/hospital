<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Add Diagnosis</h2>
			</div>
		</div>
	</div>

	<div class="row-fluid"  style="margin-top:90px;">
		<div class="span12">
		    <form class="form" role="form" method ="POST" action="<?php echo base_url('diagnosis/create');?>">
			      
		    		<div class="form-group" style="width:80%;">

		    		    <label for="Public Id">Public Id</label>
		    		    <input type="text" name="pub_id" class="form-control" id="publicid" placeholder="Enter Public ID Of Patient">
		    		    <br/>
		    		    <label for="Doctor">Doctor</label>
		    		    <input type="text" name="doctor" class="form-control" id="doctor" placeholder="Enter Name Of Doctor">
		    		    <br/>
		    		    <label for="Consultation Type">Consultation Type</label>
						<div class="form-group">
				          <select class="form-control" name="consultation_type">
				          	 <option value="">Select Consultation Type</option>
				             <option value="Emergency">Emergency</option>
				             <option value="Inpatient">Inpatient</option>
				             <option value="OPD">OPD</option>
				          </select>
				        </div>

				        <label for="TypeId"></label>
				        <input type="hidden" name="type_id" id="type_id" value="">

				        <label for="Diagnosis">Diagnosis</label>
				        <input type="text" data-name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead form-control"/>
				        <input type="hidden" name="disease_id" value="<?php echo ($this->input->post('disease_id') ? $this->input->post('disease_id') : '');?>"/>
       					<input type="hidden" name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>"/>
       					<br/>

       					<a class='btn' id="plus" title="Add another Diagnosis" style="font-size:20px;border:1px solid #eee;margin:5px;" onclick="next_diagnosis();">+</a>
       					<div id="second_diagnosis">
       						<input type="text" data-name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead-1 form-control"/>       						
					        <input type="hidden" name="disease_id_1" value="<?php echo ($this->input->post('disease_id_1') ? $this->input->post('disease_id_1') : '');?>"/>
	       					<input type="hidden" name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>"/>
       					</div>

       					<br/>

       					<table class="table table-bordered">
       						<tr>
       							<th style="width:30px;text-align:center;">SN</th>
       							<th style="text-align:center;">Drugs</th>
       							<th style="text-align:center;">Remarks</th>
       						</tr>
       						<?php for($i=1;$i<6;$i++) { ?>
       						<tr>
       							<td style="text-align:center;"><?php echo $i;?></td>
       							<td><input type="text" name="drugs_<?php echo $i;?>" class="form-control"></td>
       							<td><input type="text" name="remarks_<?php echo $i;?>" class="form-control"></td>
       						</tr>
       						<?php } ?>
       					</table>

		    		    <label for="Details">Details</label>
		    		    <textarea class="form-control" rows="5" name="details"  id="details"></textarea>
		    		    
		    		</div>			
		      
		   
		        <button type="submit" class="btn btn-primary">Submit</button>
		  	</form>
		</div>	
	</div>

<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

$(document).ready(function() {
    $('#second_diagnosis').hide();
});

function next_diagnosis() {
	$('#plus').hide();
	$('#second_diagnosis').show();
}

</script>