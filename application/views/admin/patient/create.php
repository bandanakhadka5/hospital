<?php extend('common/base') ?>

<?php startblock('content') ?>

	<div class="container">

	  <form class="form" role="form" method ="POST" action="<?php echo base_url('patient/create');?>">
	    <h2>Add New Patient</h2>
	    <input name='firstName' type="text" class="form-control" placeholder="FirstName" required autofocus>
	    <input name='middleName' type="text" class="form-control" placeholder="MiddleName">
	    <input name='lastName' type="text" class="form-control" placeholder="LastName" required >
	    <input name='dateOfBirth' type="date" class="form-control" placeholder="DateOfBirth">
	    <input name='age' type="text" class="form-control" placeholder="Age" required >
	    <input name='sex' type="text" class="form-control" placeholder="Sex" required >
	    <input name='email' type="email" class="form-control" placeholder="Email">

	    <input name='consultDate' type="date" class="form-control" placeholder="Date">

	    <input name='consultationType' type="text" class="form-control" placeholder="ConsultationType" required>

	    

	    <input name='sourceOfReferal' type="text" class="form-control" placeholder="SourceOfReferal">
	    <input name='informant' type="text" class="form-control" placeholder="Informant">

	    
	


<?php endblock() ?>

<?php end_extend() ?>