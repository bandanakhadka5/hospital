<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">
	
	<div class="row-fluid">
		<div class="span12">	
			<div class="col-xs-6 col-xs-push-4">
				<h1>BG HOSPITAL</h1>

			</div>
		</div>
	</div>

	<!-- <div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2><?php echo $patient->first_name." ".$patient->last_name."'s Report"?></h2>
			</div>
		</div>
	</div> -->

	<div class="row-fluid" style="margin-top:120px;">
		<!-- <div class="span12">

			<div class="well" style="margin-left=2px;">
				<p style="font-size:14px;">Public ID: <?=$patient->pub_id?></p>
				<p style="font-size:14px;">First Name: <?=$patient->first_name?></p>
				<p style="font-size:14px;">Middle Name: <?=$patient->middle_name?></p>
				<p style="font-size:14px;">Last Name: <?=$patient->last_name?></p>
				<p style="font-size:14px;">Age: <?=$patient->age?></p>
				<p style="font-size:14px;">Sex: <?php //if($patient->sex == 0) echo 'Male'; else echo 'Female';?></p>
				<p style="font-size:14px;">Address: <?=$patient->address?></p>
				<p style="font-size:14px;">Contact Number: <?=$patient->contact_number?></p>
			</div>
		</div> -->

		<div class= "col-xs-4">
			<p><b>Full Name:</b> <?php echo $patient->first_name." ".$patient->last_name;?></p>
			<p><b>Age:</b> <?=$patient->age?> </p>
		</div>

		<div class= "col-xs-4">
			<p style="font-size:14px;"><b>Address:</b> <?=$patient->address?></p>
		</div>

		<div class= "col-xs-4">
			<p style="font-size:14px;"><b>Public ID:</b> <?=$patient->pub_id?></p>
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
				<p style="font-size:14px;">Date of Consultation: <?=date('Y-m-d',strtotime($patient_emergency->created_at))?></p>
				<p style="font-size:14px;">Chief Compliants: <?=$patient_emergency->chief_compliants?></p>
	
				<?php 

					$diagnosis =  Diagnoses::find_by_consultation_type_and_type_id('Emergency',$patient_emergency->id); 
					if($diagnosis){

						echo "<p>". $diagnosis->diagnosis ."</p>";	
						echo "<p>". $diagnosis->details ."</p>";

					}
					
				?>
			
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
				
				<?php 
				
					$diagnosis =  Diagnoses::find_by_consultation_type_and_type_id('OPD',$patient_opd->id); 
					if($diagnosis){

						echo "<p>". $diagnosis->diagnosis ."</p>";
						echo "<p>". $diagnosis->details ."</p>";

					}
					
				?>
				
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
				
				<?php 
				
					$diagnosis =  Diagnoses::find_by_consultation_type_and_type_id('Inpatient',$patient_inpatient->id); 
					if($diagnosis){

						echo "<p>". $diagnosis->diagnosis ."</p>";
						echo "<p>". $diagnosis->details ."</p>";


					}
					
				?>
				
			</div>
		</div>
	</div>
	<?php }} ?>
	
	<input type="button" id="print_out" class="btn btn-primary" value="Print" onclick="print_page();"/>
</div>

<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

$(function(){

	$('#print_out').bind('click', function() {

		window.print();

		if (confirm('Click OK if you have printed the voucher.')) {

			$.ajax({
				
				url: '<?php echo site_url('remittance/remsess')?>',
				type: 'POST', 
				success: function(e){window.location = '<?php 
								echo file_exists(APPPATH.'modules/privilegecard')?site_url('privilegecard/issueCard/'.$remitter->getId()):site_url();
								?>';},
				error: function(e){}
					
			});

		}
		
	})
});

	//function print_page() {
		//alert('hello');
		//window.print();

		//if (confirm('Click OK if you have printed the voucher.')) {

			/*$.ajax({
				
				url: '<?php echo site_url('remittance/remsess')?>',
				type: 'POST', 
				success: function(e){window.location = '<?php 
								echo file_exists(APPPATH.'modules/privilegecard')?site_url('privilegecard/issueCard/'.$remitter->getId()):site_url();
								?>';},
				error: function(e){}
					
			});*/

		//}
	//}
		
</script>