<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

	<?php get_extended_block();?>

	<input name='doctor' type="text" class="form-control" placeholder="Doctor">

	<input name='complaints' type="text" class="form-control" placeholder="ChiefComplaints">
	<textarea name 'complaints'></textarea>

	<input name='email' type="email" class="form-control" placeholder="Email">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
  </form>

	</div> <!-- /container -->


<?php endblock() ?>

<?php end_extend() ?>