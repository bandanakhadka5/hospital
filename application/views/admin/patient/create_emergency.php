<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

		<div style="text-align:center"><h3>Add New Emergency Patient
			<!-- Button trigger modal -->
			<button class="btn btn-success btn-lg" onclick="clear_form_fields();" data-toggle="modal" data-target="#myModal">
			  Existing Patient
			</button>
		</h3></div>
		
		<form class="form" role="form" method ="POST" action="<?php echo base_url('patient_emergency/create');?>">

		<?php get_extended_block();?>

		<div class="form-group" style="width:80%;">

		    <label for="ConsultationDate">ConsultationDate</label>
		    <input type="date" name="date_of_consultation" class="form-control" id="consultationdate" placeholder="Enter Date">

		</div>

		<div class="form-group" style="width:80%;">
			
		    <label for="Complaints">Complaints</label>
		    <input type="text" name="chief_compliants" class="form-control" id="complaints" placeholder="Enter Complaints">

		</div>

	  </form>


	</div> <!-- /bootstrap -->
	</div><!-- /row -->





	<div class="row">
		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-2">
				<button id="submit" class="btn btn-lg btn-primary btn-block" >Create</button>
			</div>
		
		</div>
	</div>
</div><!-- /bootstrap -->


<?php endblock() ?>

<?php end_extend() ?>

