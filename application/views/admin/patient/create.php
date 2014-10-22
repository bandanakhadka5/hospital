<?php extend('common/base') ?>

<?php startblock('content') ?>
	
	<div class= "row">
		<div class = "col-md-12">

			<div class="col-md-4 col-md-offset-2">

			    <div class="form-group" style="width:80%;">
			        <label for="FirstName">FirstName</label>
			        <input type="text" name="first_name" class="form-control" id="firstname" placeholder="Enter FirstName" required autofocus>
			    </div>

			    <div class="form-group" style="width:80%;">
			     
			        <label for="MiddleName">MiddleName</label>
			        <input type="text" name="middle_name" class="form-control" id="middlename" placeholder="Enter MiddleName">
			    </div>
			    
			    <div class="form-group" style="width:80%;">
			        <label for="LastName">LastName</label>
			        <input type="text" name="last_name" class="form-control" id="lastname" placeholder="Enter LastName">
			    </div>

			    <div class="form-group" style="width:80%;">

			        <label for="DateOfBirth">DateOfBirth</label>
			        <input type="date" name="date_of_birth" class="form-control" id="dateofbirth" placeholder="Enter Date">

			    </div>
			    <div class="form-group" style="width:80%;">

			        <label for="Age">Age</label>
			        <input type="text" name="age" class="form-control" id="age" placeholder="Enter Age">

			    </div>

			    <div class="form-group" style="width:80%;">
			    	
			        <label for="Sex">Sex</label>
			        <input type="text" name="sex" class="form-control" id="sex" placeholder="Enter Sex">

			    </div>

			    <div class="form-group" style="width:80%;">
			    	
			        <label for="Address">Address</label>
			        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">

			    </div>


    		 </div>

    		 <div class="col-md-6">
	   
    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="sourceofreferal">Source Of Referal</label>
    		 	    <input type="text" name="source_of_referal" class="form-control" id="source" placeholder="Enter Source of Referal">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="informant">Informant</label>
    		 	    <input type="text" name="informant" class="form-control" id="informant" placeholder="Enter Informant">

    		 	</div>



<?php endblock() ?>

<?php end_extend() ?>