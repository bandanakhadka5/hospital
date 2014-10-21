<?php extend('common/base') ?>

<?php startblock('content') ?>

<div class="container">
	<hr>
	<hr>


	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-user" action="<?php echo base_url('dashboard/search');?>">
						
						<input style="width:20%;align:left;" name="search_term" type="text" value="<?=$users->get_search_term() ? $users->get_search_term() : ''?>" placeholder="Type search term...">

						<br/><br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>

					<div class="span9">
						<h3>Users List</h3>
						<?php if($users->get_total_rows() > 0){ ?>
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
						<?php } else { ?>
							<div class="well" style="text-align:center; padding:100px 0;">
								<p style="font-size:24px;">No Users found.</p>
								<p style="font-size:14px;">Your User query has not returned any valid results.</p>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php endblock() ?>

<?php end_extend() ?>