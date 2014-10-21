<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">
	<hr>
	<hr>
	<div class="row-fluid">
	<div class="span8 pull-left">
		<h3>Users List</h3>

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user){ ?>
					<tr>
						<td><?=$user->firstname?></td>
						<td><?=$user->lastname?></td>
						<td><?=$user->username?></td>
						<td><?=$user->email?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

</div>

<?php endblock() ?>

<?php end_extend() ?>