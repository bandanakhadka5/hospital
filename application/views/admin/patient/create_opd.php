<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

		<div style="text-align:center"><h2>Add New  OPD Patient</h2></div>
		<form class="form" role="form" method ="POST" action="<?php echo base_url('patient_opd/create');?>">
			<?php get_extended_block();?>

			<div class="form-group" style="width:80%;">
				
			    <label for="email">Email</label>
			    <input type="email" class="form-control" id="email" placeholder="Enter Email">

			</div>

			<div class="form-group" style="width:80%;">
				
			    <label for="Doctor">Doctor</label>
			    <input type="text" class="form-control" id="doctor" placeholder="Enter Doctor's Name">

			</div>

			<div class="form-group" style="width:80%;">
				
			    <label for="Complaints">Complaints</label>
			    <input type="text" class="form-control" id="complaints" placeholder="Enter Complaints">

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