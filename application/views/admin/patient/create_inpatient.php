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
	    <input type="text" name="date_of_admission" id="admissiondate" class="form-control nepali-calendar" placeholder="yyyy-mm-dd">
	</div>

	<div class="form-group" style="width:80%;">

	    <label for="ProcedureDate">Procedure Date</label>
	    <input type="text" name="date_of_procedure" id="proceduredate" class="form-control nepali-calendar" placeholder="yyyy-mm-dd">
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