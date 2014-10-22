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
	    		    <input type="text" class="form-control" onclick="reset();" id="public_id" placeholder="Enter PublicId Of Patient">

	    		</div>

	    		<div id="message"></div>

	      </div>
	      <div class="modal-footer">
	   
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" onclick="fill_form();" class="btn btn-primary">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-2">
				<button id="submit" class="btn btn-lg btn-primary btn-block" type="submit" >Create</button>
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
		
		var public_id = document.getElementById('public_id');
		if (public_id =='') {

			document.getElementById('message').innerHTML = '<h5 style="color:red">Sorry! Please Enter Valid Public Id</h5>';
		}else{

			document.getElementById('message').innerHTML = "<h5 style='color:green;margin-left:2%;'>Finding Patient .....</h5>";

			var xmlhttp;
			var response; 
			
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			}
			else {// code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange=function() {
			    
			    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			        
			        response = xmlhttp.responseText;

			        if(response == '1') {

			            document.forms["memberValidationForm"].submit();
			        } 
			         else {
			            document.getElementById('invalid_code').innerHTML = "<h5 style='color:red;margin-left:2%;'> Invalid Code </h5>";
			        }
			    }
			}

			xmlhttp.open("GET","/en/verify/mobile/ajax_verify_auth_code/?code="+code, true);
			xmlhttp.send();
		}



	}

</script>
