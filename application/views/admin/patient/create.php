<?php extend('common/base') ?>

<?php startblock('content') ?>
	
	<div class= "row">
		<div class = "col-md-12">

			<div class="col-md-4 col-md-offset-2">

			    <div class="form-group" style="width:80%;">
			        <label for="FirstName">First Name</label>
			        <input type="text" name="first_name" class="form-control" id="firstname" placeholder="Enter FirstName" required autofocus>
			    </div>

			    <div class="form-group" style="width:80%;">
			     
			        <label for="MiddleName">Middle Name</label>
			        <input type="text" name="middle_name" class="form-control" id="middlename" placeholder="Enter MiddleName">
			    </div>
			    
			    <div class="form-group" style="width:80%;">
			        <label for="LastName">Last Name</label>
			        <input type="text" name="last_name" class="form-control" id="lastname" placeholder="Enter LastName">
			    </div>
			    <div id="error"></div>
			    <div class="form-group" style="width:80%;">

			        <label for="DateOfBirth">Date of Birth</label>
			        <input type="text" name="date_of_birth" class="form-control nepali-calendar" id="dateofbirth" placeholder="yyyy-mm-dd" onblur="find_age();">

			    </div>
			    <div class="form-group" style="width:80%;">

			        <label for="Age">Age</label>
			        <input type="number" min="0" name="age" class="form-control" id="age" placeholder="Enter Age">

			    </div>

			    <div class="form-group" style="width:80%;">
			    	
			        <label for="Sex">Sex</label>
			        <select name="sex" id="sex" class="form-control">
			        	<option value="">Please Select One</option>
			        	<option value="0">Male</option>
			        	<option value="1">Female</option>
			        </select>
			        
			    </div>

			    <div class="form-group" style="width:80%;">
			    	
			        <label for="Address">Address</label>
			        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">

			    </div>

			    <div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="sourceofreferal">Source of Referal</label>
    		 	    <input type="text" name="source_of_referal" class="form-control" id="source" placeholder="Enter Source of Referal">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="opdno">OPD No.</label>
    		 	    <input type="text" name="opd_no" class="form-control" id="opdno" placeholder="Enter OPD No.">

    		 	</div>

    		 </div>

    		<div class="col-md-6">

    			<div class="form-group" style="width:80%;">
    				
    			    <label for="ipdno">IPD No.</label>
    			    <input type="text" name="ipd_no" class="form-control" id="ipdno" placeholder="Enter IPD No.">

    			</div>
	   
    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="informant">Informant</label>
    		 	    <input type="text" name="informant" class="form-control" id="informant" placeholder="Enter Informant">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="contact">Contact Number</label>
    		 	    <input type="number" name="contact_number" class="form-control" id="contactnumber" placeholder="Enter Contact Number">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="informant">Contact Person</label>
    		 	    <input type="text" name="contact_person" class="form-control" id="contactperson" placeholder="Enter Contact Person">

    		 	</div>

    		 	<div class="form-group" style="width:80%;">
    		 		
    		 	    <label for="relation">Relation with Patient</label>
    		 	    <input type="text" name="relation_with_patient" class="form-control" id="relation" placeholder="Enter Relation">

    		 	</div>

    		 	<input type="hidden" id="old_record_id" name="old_record_id" value="">

    		 	<!-- Modal -->
    		 	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    		 	  <div class="modal-dialog">
    		 	    <div class="modal-content">
    		 	      <div class="modal-header">
    		 	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    		 	        <h4 class="modal-title" id="myModalLabel">Enter Patient No.</h4>
    		 	      </div>
    		 	      <div class="modal-body">
    		 	    		<div class="form-group" style="width:80%;">    		 	    			
    		 	    		    <label for="Public Id">Patient No.</label>
    		 	    		    <input type="text" class="form-control" id="publicid" placeholder="Enter Patient No.">
    		 	    		</div>

    		 	    		<div id="message"></div>

    		 	      </div>
    		 	      <div class="modal-footer">
    		 	   
    		 	        <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
    		 	        <button type="button" onclick="fill_form();" class="btn btn-primary">Submit</button>
    		 	      </div>
    		 	    </div>
    		 	  </div>
    		 	</div>



<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

	function clear_form_fields() {		

		document.getElementById('firstname').readOnly = false;
		document.getElementById('middlename').readOnly = false;
		document.getElementById('lastname').readOnly = false;
		document.getElementById('age').readOnly = false;
		document.getElementById('address').readOnly = false;
		document.getElementById('dateofbirth').readOnly = false;
		document.getElementById('source').readOnly = false;
		document.getElementById('informant').readOnly = false;
		document.getElementById('sex').readOnly = false;
		document.getElementById('opdno').readOnly = false;
		document.getElementById('ipdno').readOnly = false;

		//set the attribute to true for existing record
		document.getElementById('old_record_id').value = " ";

		document.getElementById('firstname').value = "";
       	document.getElementById('middlename').value = "";
       	document.getElementById('lastname').value = "";
       	document.getElementById('age').value ="";
       	document.getElementById('address').value = "";
       	document.getElementById('dateofbirth').value = "";
       	document.getElementById('source').value = "";
       	document.getElementById('informant').value = "";
       	document.getElementById('sex').value = "";
       	document.getElementById('opdno').value = "";
       	document.getElementById('ipdno').value = "";
	}

	function reset() {
	    document.getElementById('message').innerHTML = "";	    
	}

	$( "#publicid" ).focus(function() {
	  	document.getElementById('message').innerHTML = "";
	});

	function fill_form() {
		
		var pubid = document.getElementById('publicid').value;

		if (opd_no == '') {
			document.getElementById('message').innerHTML = '<h5 style="color:red">Sorry! Please Enter Valid OPD No.</h5>';
		}
		else {

			document.getElementById('message').innerHTML = "<h5 style='color:green;margin-left:2%;'>Finding Patient .....</h5>";
			
				$.ajax({
					type: "GET",
			
					url: "<?php echo base_url('patients/ajax_return_patient')?>"+"?pubid="+pubid,
					success: function(result){// result is in json

			           var patient = JSON.parse(result);

			           if(patient['error'] != '') {
			           	document.getElementById('message').innerHTML = "<h5 style='color:red;margin-left:2%;'>" + patient['error'] + "</h5>";
			           }

			           else {

				           document.getElementById('firstname').value = patient['first_name'];
				           document.getElementById('middlename').value = patient['middle_name'];
				           document.getElementById('lastname').value = patient['last_name'];
				           document.getElementById('age').value = patient['age'];
				           document.getElementById('address').value = patient['address'];
				           document.getElementById('dateofbirth').value = patient['date_of_birth'];
				           document.getElementById('source').value = patient['source_of_referal'];
				           document.getElementById('informant').value = patient['informant'];
				           document.getElementById('sex').value = patient['sex'];
				           document.getElementById('opdno').value = patient['opd_no'];

				           //set the oldrecord id for existing record
				           document.getElementById('old_record_id').value = patient['old_record_id'];

				           document.getElementById('message').innerHTML = " ";

				           $("#close_modal").trigger('click');

				           document.getElementById('firstname').readOnly = true;
				           document.getElementById('middlename').readOnly = true;
				           document.getElementById('lastname').readOnly = true;
				           document.getElementById('age').readOnly = true;
				           document.getElementById('address').readOnly = true;
				           document.getElementById('dateofbirth').readOnly = true;
				           //document.getElementById('source').readOnly = true;
				           document.getElementById('informant').readOnly = true;
				           document.getElementById('sex').readOnly = true;
				           document.getElementById('opdno').readOnly = true;
				           document.getElementById('ipdno').readOnly = true;

				       }
					},

					// Generic Ajax Error for webapp
					error: function (xhr, ajaxOptions, thrownError) {
						 $("#close_modal").trigger('click');
					}
				});
		}
	}

	function find_age() {

		var dob = document.getElementById('dateofbirth').value;
		document.getElementById('error').innerHTML = "";

		$.ajax ({

			type: "GET",			
			url: "<?php echo base_url('patients/ajax_return_age')?>"+"?dob="+dob,
			success: function(result) {
				var result = JSON.parse(result);

	            if(result['error'] != '') {
	           		document.getElementById('error').innerHTML = "<h5 style='color:red;margin-left:2%;'>" + result['error'] + "</h5>";
	           	}
	            else {
					document.getElementById('age').value = result['age'];
				}
			}
		});
	}

</script>
