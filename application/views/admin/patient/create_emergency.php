<?php extend('admin/patient/create') ?>

<?php startblock('content') ?>

		<div style="text-align:center"><h1>Add New Emergency Patient
			<!-- Button trigger modal -->
			<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
			  Existing Patient
			</button>
		</h1></div>
		
		<form class="form" role="form" method ="POST" action="<?php echo base_url('patient/create');?>">

		<?php get_extended_block();?>

		<div class="form-group" style="width:80%;">

		    <label for="ConsultationDate">ConsultationDate</label>
		    <input type="date" class="form-control" id="consultationdate" placeholder="Enter Date">

		</div>

		<div class="form-group" style="width:80%;">
			
		    <label for="Complaints">Complaints</label>
		    <input type="text" class="form-control" id="complaints" placeholder="Enter Complaints">

		</div>

	  </form>


	</div> <!-- /bootstrap -->
	</div><!-- /row -->



	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Enter PubId Of Patient</h4>
	      </div>
	      <div class="modal-body">
	    		<div class="form-group" style="width:80%;">
	    			
	    		    <label for="Public Id">Public Id</label>
	    		    <input type="text" class="form-control" id="publicid" placeholder="Enter PublicId Of Patient">

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

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-2">
				<button id="submit" class="btn btn-lg btn-primary btn-block" >Create</button>
			</div>
		
		</div>
	</div>
</div><!-- /bootstrap -->


<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">


	function reset() {

	    document.getElementById('message').innerHTML = "";
	    
	}

	function fill_form(){
		
		var pubid = document.getElementById('publicid').value;
		if (pubid == '') {

			document.getElementById('message').innerHTML = '<h5 style="color:red">Sorry! Please Enter Valid Public Id</h5>';

		}else{

			document.getElementById('message').innerHTML = "<h5 style='color:green;margin-left:2%;'>Finding Patient .....</h5>";
			
				$.ajax({
					type: "GET",
			
					url: "<?php echo base_url('patients/ajax_return_patient')?>"+"?pubid="+pubid,
					success: function(result){// result is in json 

			           var patient = JSON.parse(result);

			           document.getElementById('firstname').value = patient['first_name'];
			           document.getElementById('middlename').value = patient['middle_name'];
			           document.getElementById('lastname').value = patient['last_name'];
			           document.getElementById('age').value = patient['age'];
			           document.getElementById('address').value = patient['address'];
			           document.getElementById('dateofbirth').value = patient['date_of_birth'];
			           document.getElementById('email').value = patient['email'];
			           document.getElementById('source').value = patient['source_of_referal'];
			           document.getElementById('informant').value = patient['informant'];
			           document.getElementById('sex').value = patient['sex'];
			           //document.getElementById('contact_person').value = patient['contact_person'];
			           alert('aaaaa');
			           document.getElementById('message').innerHTML = " ";
			           //$("#close_modal").trigger('click');


					},
					// Generic Ajax Error for webapp
					error: function (xhr, ajaxOptions, thrownError){

						alert(thrownError);
					}
				});


		}


	}

</script>
