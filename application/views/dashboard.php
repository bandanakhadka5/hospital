<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">
	<div class="row-fluid">
	<div class="col-md-12">
		<div class="col-md-6">
			

			<h3>Today's Follow Ups</h3>

			<?php if(isset($patient)) {?>

			<div class="clearfix"></div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Full Name</th>
							<th>PatientId</th>
							<th>Last Visited Date</th>
							<th>Contact Number</th>
						</tr>
					</thead>
					<tbody>
						<?php  foreach ($users as $user){ ?>
							<tr>
								<td><?=$user->firstname?></td>
								<td><?=$user->lastname?></td>
								<td><?=$user->username?></td>
								<td><?=$user->email?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php }else echo "NO PATIENT"?>
		</div>
			
		

		<div class="col-md-6">

			<h3>Patient's In Bed</h3>
			
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Full Name</th>
							<th>PatientId</th>
							<th>Last Visited Date</th>
							<th>Contact Number</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user){ ?>
							<tr>
								<td><?=$user->firstname?></td>
								<td><?=$user->lastname?></td>
								<td><?=$user->username?></td>
								<td><?=$user->email?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
		</div>			

	</div>
</div>

</div>

<?php endblock() ?>

<?php end_extend() ?>