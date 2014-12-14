<?php extend('common/base') ?>

<?php startblock('content') ?>

	<form class="form" role="form" method ="POST" action="<?php echo base_url('patients/edit/'.$patient->id);?>">	
	<div class= "row">
		<div class = "col-md-12">

			<div class="col-md-4 col-md-offset-2">

			    <div class="form-group" style="width:80%;">
			        <label for="FirstName">FirstName</label>
			        <input type="text" name="first_name" value="<?=$patient->first_name?>" class="form-control" id="firstname" placeholder="Enter FirstName" required>
			    </div>

			    <div class="form-group" style="width:80%;">
			     
			        <label for="MiddleName">MiddleName</label>
			        <input type="text" name="middle_name" value="<?=$patient->middle_name?>" class="form-control" id="middlename" placeholder="Enter MiddleName">
			    </div>
			    
			    <div class="form-group" style="width:80%;">
			        <label for="LastName">LastName</label>
			        <input type="text" name="last_name" value="<?=$patient->last_name?>" class="form-control" id="lastname" placeholder="Enter LastName">
			    </div>

			    <div class="form-group" style="width:80%;">

			        <label for="DateOfBirth">DateOfBirth</label>
			        <input type="date" name="date_of_birth"  value="<?php echo date('Y-m-d',strtotime($patient->date_of_birth));?>" class="form-control" id="dateofbirth" placeholder="Enter Date">

			    </div>
			    <div class="form-group" style="width:80%;">

			        <label for="Age">Age</label>
			        <input type="text" name="age" value="<?=$patient->age?>" class="form-control" id="age" placeholder="Enter Age">

			    </div>

			    <div class="form-group" style="width:80%;">
			    	
			        <label for="Sex">Sex</label>
			        <select name="sex" id="sex" class="form-control">
			        	<option value="">Please Select One</option>
			        	<option value="0" <?php if($patient->sex == 0) { ?> selected <?php } ?>>Male</option>
			        	<option value="1" <?php if($patient->sex == 1) { ?> selected <?php } ?>>Female</option>
			        </select>
			        
			    </div>
    		 </div>

    		<div class="col-md-6">

    		 	<div class="form-group" style="width:80%;">
			    	
			        <label for="Address">Address</label>
			        <input type="text" name="address" value="<?=$patient->address?>" class="form-control" id="address" placeholder="Enter Address">

			    </div>

			    <div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="sourceofreferal">Source Of Referal</label>
    		 	    <input type="text" name="source_of_referal" value="<?=$patient->source_of_referal?>" class="form-control" id="source" placeholder="Enter Source of Referal">

    		 	</div>
	   
    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="informant">Informant</label>
    		 	    <input type="text" name="informant" value="<?=$patient->informant?>" class="form-control" id="informant" placeholder="Enter Informant">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="contact">Contact Number</label>
    		 	    <input type="number" name="contact_number" value="<?=$patient->contact_number?>" class="form-control" id="contactnumber" placeholder="Enter Contact Number">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="informant">Contact Person</label>
    		 	    <input type="text" name="contact_person" value="<?=$patient->contact_person?>" class="form-control" id="contactperson" placeholder="Enter Contact Person">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="relation">Relation with Patient</label>
    		 	    <input type="text" name="relation_with_patient" value="<?=$patient->relation_with_patient?>" class="form-control" id="relation" placeholder="Enter Relation">

    		 	</div>
    		</div>
    	</div>
    </div>

    <br/>
    <div class="row">
		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-2">
				<button id="submit" class="btn btn-lg btn-primary btn-block" >Update</button>
			</div>		
		</div>
	</div>
</form>
</div><!-- /bootstrap --> 

<?php endblock() ?>

<?php end_extend() ?>