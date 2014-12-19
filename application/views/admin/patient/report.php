<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2><?php echo $patient->first_name." ".$patient->last_name."'s Report"?></h2>
			</div>
		</div>
	</div>

	<div class="row-fluid" style="margin-top:90px;">
		<div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Public ID: <?=$patient->pub_id?></p>
				<p style="font-size:14px;">First Name: <?=$patient->first_name?></p>
				<p style="font-size:14px;">Middle Name: <?=$patient->middle_name?></p>
				<p style="font-size:14px;">Last Name: <?=$patient->last_name?></p>
				<p style="font-size:14px;">Age: <?=$patient->age?></p>
				<p style="font-size:14px;">Sex: <?php if($patient->sex == 0) echo 'Male'; else echo 'Female';?></p>
				<p style="font-size:14px;">Address: <?=$patient->address?></p>
				<p style="font-size:14px;">Contact Number: <?=$patient->contact_number?></p>
			</div>
		</div>
	</div>

	<?php
		if(!empty($emergency)) {
		echo "<b>Emergency</b>";
		foreach ($emergency as $patient_emergency) {
	?>
	<div class="row-fluid" style="margin-top:2px;">
		<div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Date of Consultation: <?=date('Y-m-d',strtotime($patient_emergency->created_at))?></p>
				<p style="font-size:14px;">Chief Compliants: <?=$patient_emergency->chief_compliants?></p>
			</div>
		</div>
	</div>
	<?php }} ?>

	<?php
		if(!empty($opd)) {
		echo "<b>OPD</b>";
		foreach ($opd as $patient_opd) {
	?>
	<div class="row-fluid" style="margin-top:2px;">
		<div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Date of Consultation: <?=date('Y-m-d',strtotime($patient_opd->created_at))?></p>
				<p style="font-size:14px;">Chief Compliants: <?=$patient_opd->chief_compliants?></p>
				<p style="font-size:14px;">Doctor: <?=$patient_opd->doctor?></p>
			</div>
		</div>
	</div>
	<?php }} ?>

	<?php
		if(!empty($inpatient)) {
		echo "<b>Inpatient</b>";
		foreach ($inpatient as $patient_inpatient) {
	?>
	<div class="row-fluid" style="margin-top:2px;">
		<div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Date of Admission: <?=date('Y-m-d',strtotime($patient_inpatient->date_of_admission))?></p>
				<p style="font-size:14px;">Date of Procedure: <?=date('Y-m-d',strtotime($patient_inpatient->date_of_procedure))?></p>
				<p style="font-size:14px;">Date of Discharge: <?=date('Y-m-d',strtotime($patient_inpatient->date_of_discharge))?></p>
			</div>
		</div>
	</div>
	<?php }} ?>
</div>

<?php endblock() ?>

<?php end_extend() ?>