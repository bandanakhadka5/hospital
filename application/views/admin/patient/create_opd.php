<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

	<input name='doctor' type="text" class="form-control" placeholder="Doctor">

	<input name='complaints' type="text" class="form-control" placeholder="ChiefComplaints">
	<textarea name 'complaints'></textarea>

	<input name='email' type="email" class="form-control" placeholder="Email">


<?php endblock() ?>

<?php end_extend() ?>