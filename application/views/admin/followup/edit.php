<?php extend('common/base') ?>

<?php startblock('content') ?>

	<div style="text-align:center">
		<h3>Edit FollowUp</h3>
	</div>
	
	<br/>

	<form class="form" role="form" method ="POST" action="<?php echo base_url('follow_up/edit/'.$follow_up->id);?>">	
		<div class= "row">
			<div class="col-md-12">
				<div class="col-md-9 col-md-offset-2">
					<div class="form-group" style="width:80%;">
					    <label for="Doctor">Doctor</label>
					    <input type="text" name="doctor" value="<?php echo $follow_up->doctor;?>" class="form-control" id="doctor" placeholder="Enter Doctor's name" required>
					</div>

					<div class="form-group" style="width:80%;">
					    <label for="date">FollowUp Date</label>
					    <input type="text" name="follow_up_date" id="follow_up_date" class="form-control nepali-calendar" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d',strtotime($follow_up->follow_up_date));?>" required>
					</div>
				</div>
			</div>
	    </div>

	    <br/>
	    <div class="row">
			<div class="col-md-12">
				<div class="col-md-9 col-md-offset-2">
					<div class="form-group" style="width:80%;">
						<button id="submit" class="btn btn-lg btn-primary btn-block" onclick="return confirm_update();">Update</button>
					</div>
				</div>		
			</div>
		</div>
	</form>
</div><!-- /bootstrap --> 

<?php endblock() ?>

<?php end_extend() ?>

<script type="text/javascript">

	function confirm_update() {
		return confirm("Are you sure about the changes?");
	}

</script>