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
		    		    <input type="text" name="pub_id" class="form-control" id="publicid" placeholder="Enter Public ID Of Patient" <?php if(isset($pub_id)) { ?> value="<?php echo $pub_id;?>" readonly <?php } ?>>
		    		    <br/>
		    		    <label for="Doctor">Doctor</label>
		    		    <input type="text" name="doctor" class="form-control" id="doctor" placeholder="Enter Name Of Doctor" <?php if(isset($doctor)) { ?> value="<?php echo $doctor;?>" <?php } ?>>
		    		    <br/>
		    		    <label for="Consultation Type">Consultation Type</label>
		    		    <?php if(isset($consultation_type)) { ?>
		    		    <input type="text" name="consultation_type" class="form-control" id="consultation_type" value="<?php echo $consultation_type;?>" readonly>
		    		    <br/>
		    		    <?php } else { ?>
						<div class="form-group">
				          <select class="form-control" name="consultation_type">
				          	 <option value="">Select Consultation Type</option>
				             <option value="Emergency">Emergency</option>
				             <option value="OPD">OPD</option>
				             <option value="Inpatient">Inpatient</option>				             
				          </select>
				        </div>
				        <?php } ?>

				        <label for="TypeId"></label>
				        <input type="hidden" name="type_id" id="type_id" <?php if(isset($type_id)) { ?> value="<?php echo $type_id;?>" <?php } ?>>

				        <label for="Diagnosis">Diagnosis</label>
				        <input type="text" data-name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead form-control"/>
				        <input type="hidden" name="disease_id" value="<?php echo ($this->input->post('disease_id') ? $this->input->post('disease_id') : '');?>"/>
       					<input type="hidden" name="diagnosis" value="<?php echo ($this->input->post('diagnosis') ? $this->input->post('diagnosis') : '');?>"/>
       					<br/>

       					<table class="table table-bordered">
       						<tr>
       							<th style="width:30px;text-align:center;">SN</th>
       							<th style="text-align:center;">Medication</th>
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

		    		    <label for="Details">Case Summary</label>
		    		    <textarea class="form-control" rows="5" name="details"  id="details"></textarea>
		    		    <br/>

		    		    <label id="title"><h3>Add another Diagnosis</h3></label>
		    		    <a class='btn' id="plus" title="Add another Diagnosis" style="width:100px;font-size:30px;border:1px solid #eee;margin:5px;" onclick="next_diagnosis();">+</a>
       					
       					<div id="second_diagnosis">

       						<label for="Diagnosis">Diagnosis</label>
       						<input type="text" data-name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead-1 form-control"/>       						
					        <input type="hidden" name="disease_id_1" value="<?php echo ($this->input->post('disease_id_1') ? $this->input->post('disease_id_1') : '');?>"/>
	       					<input type="hidden" name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>"/>
       						<br/>

	       					<table class="table table-bordered">
       						<tr>
       							<th style="width:30px;text-align:center;">SN</th>
       							<th style="text-align:center;">Medication</th>
       							<th style="text-align:center;">Remarks</th>
       						</tr>
       						<?php for($i=1;$i<6;$i++) { ?>
       						<tr>
       							<td style="text-align:center;"><?php echo $i;?></td>
       							<td><input type="text" name="medication_<?php echo $i;?>" class="form-control"></td>
       							<td><input type="text" name="med_remarks_<?php echo $i;?>" class="form-control"></td>
       						</tr>
       						<?php } ?>
       					</table>

		    		    <label for="Details">Case Summary</label>
		    		    <textarea class="form-control" rows="5" name="details_1"  id="details_1"></textarea>

       					</div>

       					<br/>
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
	$('#title').hide();
	$('#plus').hide();
	$('#second_diagnosis').show();
}

</script>