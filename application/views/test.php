<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'First Name' => 'first_name', 
    	'Last Name' => 'last_name',
    	'Username' => 'username', 
    	'Email' => 'email',
    ),
    'cur_page' => $users->get_current_page(),
    'base_url' => '/hospital/dashboard/search',
    'order_by_field' => $users->get_field(),
    'order_by_direction' => $users->get_direction(),
    'search' => $users->get_search_term(),
    'total_rows' => $users->get_total_rows(),
    'per_page' => $users->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing Users</h2>
				<h5 style="margin-left:5px;">Showing result<?=($users->get_total_rows() == 1) ? '' : 's'?> <?=($users->get_page_size() > $users->get_total_rows()) ? $users->get_total_rows() : ($users->get_page_size() * ($users->get_current_page() - 1) + 1) .' - '. ($users->get_page_size() * ($users->get_current_page() - 1) + $users->get_row_per_current_page())?> of <?=number_format($users->get_total_rows())?></h5>
			</div>

			<div class="pull-right" style="margin-top: 5px;">
				<?=$this->bspaginator->pagination_links()?>
			</div>

			<br/><br/><br/>

			<br/><br/>
	</div>

	<br/>

	<div class="row-fluid" style="margin-top:90px;">

		<div class="span12">
			<div class="row-fluid">
				<div class="span3" style="border: 1px solid #eee; padding-left: 20px; padding-right: 20px;">

					<form name="search-user" action="<?php echo base_url('dashboard/search');?>">
						
						<input style="width:20%;align:left;" name="search" type="text" value="<?=$users->get_search_term() ? $users->get_search_term() : ''?>" placeholder="Type search term..." autofocus>

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
											<td><?=$user->first_name?></td>
											<td><?=$user->last_name?></td>
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