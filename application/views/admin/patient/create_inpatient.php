<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>
	
	<form class="form" role="form" method ="POST" action="<?php echo base_url('patient/create');?>">

	<?php get_extended_block();?>

	<input name='admissionDate' type="date" class="form-control" placeholder="Admission Date">

	<input name='procedureDate' type="date" class="form-control" placeholder="Date Of Procedure">

	<input name='dischargeDate' type="date" class="form-control" placeholder="Date Of Discharge">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
  </form>

	</div> <!-- /container -->


<?php endblock() ?>

<?php end_extend() ?>