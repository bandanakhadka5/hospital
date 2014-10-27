<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

		<div style="text-align:center">
			<h1>Add New  OPD Patient
				<button class="btn btn-success btn-lg" onclick="clear_form_fields();" data-toggle="modal" data-target="#myModal">
				  Existing Patient
				</button>
			</h1>
		</div>
		<form class="form" role="form" method ="POST" action="<?php echo base_url('patient_opd/create');?>">
			<?php get_extended_block();?>

			<div class="form-group" style="width:80%;">
				
			    <label for="email">Email</label>
			    <input name="email" type="email" class="form-control" id="email" placeholder="Enter Email">

			</div>

			<div class="form-group" style="width:80%;">

			    <label for="ConsultationDate">ConsultationDate</label>
			    <input type="date" name="date_of_consultation" class="form-control" id="consultationdate" placeholder="Enter Date">

			</div>

			<div class="form-group" style="width:80%;">
				
			    <label for="Doctor">Doctor</label>
			    <input name="doctor" type="text" class="form-control" id="doctor" placeholder="Enter Doctor's Name">

			</div>

			<div class="form-group" style="width:80%;">
				
			    <label for="Complaints">Complaints</label>
			    <input name="chief_compliants" type="text" class="form-control" id="complaints" placeholder="Enter Complaints">

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