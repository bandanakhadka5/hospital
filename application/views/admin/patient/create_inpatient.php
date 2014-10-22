<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>
	<div style="text-align:center"><h2>Add New InPatient</h2></div>
	<form class="form" role="form" method ="POST" action="<?php echo base_url('patient/create');?>">

	<?php get_extended_block();?>

	<div class="form-group" style="width:80%;">

	    <label for="AdmissionDate">Admission Date</label>
	    <input type="date" class="form-control" id="admissiondate" placeholder="Enter Date">

	</div>

	<div class="form-group" style="width:80%;">

	    <label for="ProcedureDate">ProcedureDate</label>
	    <input type="date" class="form-control" id="proceduredate" placeholder="Enter Date">

	</div>

	<div class="form-group" style="width:80%;">

	    <label for="DischargeDate">DischargeDate</label>
	    <input type="date" class="form-control" id="dischargedate" placeholder="Enter Date">

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