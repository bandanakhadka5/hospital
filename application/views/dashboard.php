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
								<td><?=$user->first_name?></td>
								<td><?=$user->last_name?></td>
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
							<th>First Name</th>
							<th>Last Name</th>
							<th>Address</th>
							<th>Age</th>
							<th>sex</th>
							<th>Date of Admission</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($patients_in_bed as $patient_in_bed){ 
							if(is_null($patient_in_bed->date_of_discharge)) {
							?>
							<tr>
								<td><?=$patient_in_bed->patient->first_name?></td>
								<td><?=$patient_in_bed->patient->last_name?></td>
								<td><?=$patient_in_bed->patient->address?></td>
								<td><?=$patient_in_bed->patient->age?></td>
								<td>
									<?php
									if($patient_in_bed->patient->sex == 0) 
										echo "Male";
									else echo "Female";
									?>
								</td>
								<td>
									<?php echo date('Y-m-d',strtotime($patient_in_bed->date_of_admission));?>
								</td>
							</tr>
						<?php }
						} ?>
					</tbody>
				</table>
		</div>			

	</div>
</div>

</div>

<?php endblock() ?>

<?php end_extend() ?>