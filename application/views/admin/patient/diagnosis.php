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

		    		    <label for="Public Id">Patient No.</label>
		    		    <input type="text" name="pub_id" class="form-control" id="publicid" placeholder="Enter Patient No." <?php if(isset($pub_id)) { ?> value="<?php echo $pub_id;?>" readonly <?php } ?>>
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
       						<?php for($i=1;$i<=10;$i++) { ?>
       						<tr id="row<?php echo $i;?>">
       							<td style="text-align:center;"><?php echo $i;?></td>
       							<td><input type="text" name="drugs_<?php echo $i;?>" class="form-control"></td>
       							<td><input type="text" name="remarks_<?php echo $i;?>" class="form-control"></td>
       						</tr>
       						<?php } ?>
       					</table>

       					<a class='btn' id="next" title="Add another Medication" style="width:200px;border:1px solid #eee;margin:5px;" onclick="next_row();">Add another Medication</a>
		    		    
		    		    <br/>
		    		    <label for="Details">Case Summary</label>
		    		    <textarea class="form-control" rows="5" name="details"  id="details"></textarea>
		    		    <br/>
		    		    
		    		    <label id="title"><h3>Add another Diagnosis</h3></label>
		    		    <a class='btn' id="plus" title="Add another Diagnosis" style="width:100px;font-size:30px;border:1px solid #eee;margin:5px;" onclick="next_diagnosis();">+</a>
       					
       					<div id="second_diagnosis">

       						<label class="checkbox">
					        <input type="checkbox" checked="checked" id="check"> Use Typeahead
					        </label>

       						<label for="Diagnosis">Diagnosis</label>

       						<div id="option1">
       						<input type="text" data-name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>" placeholder="Type disease name..." data-provide="typeahead" class="disease-typeahead-1 form-control"/>       						
					        <input type="hidden" name="disease_id_1" value="<?php echo ($this->input->post('disease_id_1') ? $this->input->post('disease_id_1') : '');?>"/>
	       					<input type="hidden" name="diagnosis_1" value="<?php echo ($this->input->post('diagnosis_1') ? $this->input->post('diagnosis_1') : '');?>"/>
       						</div>

       						<div id="option2">
       						<input class="form-control" type="text" id="diagnosis_2" name="diagnosis_2" placeholder="Enter Diagnosis Name">
       						</div>

       						<br/>

	       					<table class="table table-bordered">
       						<tr>
       							<th style="width:30px;text-align:center;">SN</th>
       							<th style="text-align:center;">Medication</th>
       							<th style="text-align:center;">Remarks</th>
       						</tr>
       						<?php for($i=1;$i<=10;$i++) { ?>
       						<tr id="rows_<?php echo $i;?>">
       							<td style="text-align:center;"><?php echo $i;?></td>
       							<td><input type="text" name="medication_<?php echo $i;?>" class="form-control"></td>
       							<td><input type="text" name="med_remarks_<?php echo $i;?>" class="form-control"></td>
       						</tr>
       						<?php } ?>
       					</table>
       					<a class='btn' id="next_1" title="Add another Medication" style="width:200px;border:1px solid #eee;margin:5px;" onclick="show_next_row();">Add another Medication</a>
       					<br/>

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

	for(var i = 6; i<=10; i++) {
		$('#row'+i).hide();
		$('#rows_'+i).hide();
	}

    $('#second_diagnosis').hide();
    $('#option2').hide();
    
    $('#check').change(function () {

	    if($('#check').prop('checked')) {
	    	$('#option2').hide();
	    	$('#option1').show();
	    	$('#diagnosis_2').val('');
	    }

	    else {
	    	$('#option1').hide();
	    	$('#option2').show();
	    	$('#diagnosis_1').val('');
	    }
	 });
});

function next_diagnosis() {

	$('#title').hide();
	$('#plus').hide();

	$('#second_diagnosis').show();
}

var ii = 6;
function next_row() {
	$('#row'+ii).show();
	ii++;

	if(ii == 11) {
		$('#next').hide();
	}
}

var j = 6;
function show_next_row() {
	$('#rows_'+j).show();
	j++;

	if(j == 11) {
		$('#next_1').hide();
	}
}

</script>