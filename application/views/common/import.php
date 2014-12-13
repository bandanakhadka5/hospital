<?php extend('common/base') ?>

<?php startblock('content') ?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">
		    <form action="" method="post" enctype="multipart/form-data">
		        Select csv to import:
		        <input type="file" name="who_diseases" id="who_diseases">
		        Please Click To Submit
		        <input type="submit" value="Upload" name="submit">
		    </form>
		</div>	
	</div>

	

<?php endblock() ?>

<?php end_extend() ?>