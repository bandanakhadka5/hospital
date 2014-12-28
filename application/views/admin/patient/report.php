<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">
	<div class="row">
		<div class="pull-right">
			Phone Number: 061522222
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">	
			<div class="col-xs-6 col-xs-push-4">
				<h1>BG HOSPITAL</h1>
			</div>			
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row-fluid">
		<div class="span12">	
			<div class="col-xs-6 col-xs-push-4">
				<h5 style="margin-left:8%">Matepani-12,Pokhara</h5>
			</div>
		</div>
	</div>
	<div class="row-fluid" style="margin-top:8%;">

		<div class= "col-xs-4">
			<p><b>Name:</b> <?php echo $patient->get_full_name();?></p>
			<p><b>Age:</b> <?php echo $patient->age;?> </p>
		</div>

		<div class= "col-xs-4">
			<p style="font-size:14px;"><b>Address:</b> <?php echo $patient->address;?></p>
		</div>

		<div class= "col-xs-4">
			<p style="font-size:14px;"><b>Public ID:</b> <?php echo $patient->pub_id;?></p>
			<p style="font-size:14px;"><b>Sex:</b> <?php if($patient->sex == 0) echo 'Male'; else echo 'Female';?></p>
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
				<p style="font-size:14px;">Date of Consultation: <?php echo date('Y-m-d',strtotime($patient_emergency->created_at));?></p>
				<p style="font-size:14px;">Chief Compliants: <?php echo $patient_emergency->chief_compliants;?></p>			
			</div>
		</div>
	</div>
	<?php }
	    if(!empty($emergency_diagnosis)) {

			foreach ($emergency_diagnosis as $diagnosis) { ?>

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Diagnosis: <?php echo $diagnosis->diagnosis;?></p>
				<p style="font-size:14px;">Details: <?php echo $diagnosis->details;?></p>
				<p style="font-size:14px;">Date: <?php echo date('Y-m-d',strtotime($diagnosis->created_at));?></p>
			</div>
			<?php
			}	
		}
	}
	?>

	<?php
		if(!empty($opd)) {
		echo "<b>OPD</b>";
		foreach ($opd as $patient_opd) {
	?>
	<div class="row-fluid" style="margin-top:2px;">
		<div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Date of Consultation: <?php echo date('Y-m-d',strtotime($patient_opd->created_at));?></p>
				<p style="font-size:14px;">Chief Compliants: <?php echo $patient_opd->chief_compliants;?></p>
				<p style="font-size:14px;">Doctor: <?php echo $patient_opd->doctor;?></p>			
			</div>
		</div>
	</div>
	<?php }
	
	if(!empty($opd_diagnosis)) {

			foreach ($opd_diagnosis as $diagnosis) { ?>

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Diagnosis: <?php echo $diagnosis->diagnosis;?></p>
				<p style="font-size:14px;">Details: <?php echo $diagnosis->details;?></p>
				<p style="font-size:14px;">Date: <?php echo date('Y-m-d',strtotime($diagnosis->created_at));?></p>			
			</div>
			<?php
			}	
		}

	} ?>

	<?php
		if(!empty($inpatient)) {
		echo "<b>Inpatient</b>";
		foreach ($inpatient as $patient_inpatient) {
	?>
	<div class="row-fluid" style="margin-top:2px;">
		<div class="span12">
			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Date of Admission: <?php echo date('Y-m-d',strtotime($patient_inpatient->date_of_admission));?></p>
				<p style="font-size:14px;">Date of Procedure: <?php echo date('Y-m-d',strtotime($patient_inpatient->date_of_procedure));?></p>
				<p style="font-size:14px;">Date of Discharge: <?php echo date('Y-m-d',strtotime($patient_inpatient->date_of_discharge));?></p>
			</div>
		</div>
	</div>
	<?php }

	if(!empty($inpatient_diagnosis)) {

			foreach ($inpatient_diagnosis as $diagnosis) { ?>

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Diagnosis: <?php echo $diagnosis->diagnosis;?></p>
				<p style="font-size:14px;">Details: <?php echo $diagnosis->details;?></p>
				<p style="font-size:14px;">Date: <?php echo date('Y-m-d',strtotime($diagnosis->created_at));?></p>	
			</div>
			<?php
			}	
		}
	}
	?>
	<br/>
	<p>______________________</p>
	<p>Doctor's Signature</p>

	
	<input type="button" id="print_out" class="btn btn-primary" value="Print" onclick="print_page();"/>
</div>

<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

$(function(){

	$('#print_out').bind('click', function() {

		$('#print_out').hide();
		
		window.print();

		if (confirm('Click OK if you have printed the voucher.')) {

			window.location = "<?php echo base_url('patients') ?>"
		}

		$('#print_out').show();
		
	})
});

		
</script>