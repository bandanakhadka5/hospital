<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>
	<div style="text-align:center">
		<h3>Add New InPatient
			<button class="btn btn-success btn-lg" onclick="clear_form_fields();" data-toggle="modal" data-target="#myModal">
			  Existing Patient
			</button>
		</h3>
	</div>
	<form class="form" role="form" method ="POST" action="<?php echo base_url('patient_inpatient/create');?>">

	<?php get_extended_block();?>

	<div class="form-group" style="width:80%;">

	    <label for="AdmissionDate">Admission Date</label>
	    <input name="date_of_admission" type="text" class="form-control nepali-calendar" id="admissiondate" placeholder="Enter Date">

	</div>

	<div class="form-group" style="width:80%;">

	    <label for="ProcedureDate">ProcedureDate</label>
	    <input name="date_of_procedure" type="text" class="form-control nepali-calendar" id="proceduredate" placeholder="Enter Date">

	</div>

	<div class="form-group" style="width:80%;">

	    <label for="DischargeDate">DischargeDate</label>
	    <input type="text" name="date_of_discharge" class="form-control nepali-calendar" id="dischargedate" placeholder="Enter Date">

	</div>

  </form>

  		</div> <!-- /bootstrap -->
  	</div><!-- /row -->

  	<div class="row">
  		<div class="col-md-12">
  			<div class="col-md-9 col-md-offset-2">
  				<button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
  			</div>
  		
  		</div>
  	</div>
  </div><!-- /bootstrap -->


<?php endblock() ?>

<?php end_extend() ?>