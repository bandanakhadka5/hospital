<?php extend('common/base') ?>

<?php startblock('content') ?>

<?php

$config = array(
    'headers' => (object) array(
    	'Pub ID' => 'pub_id',
    	'First Name' => 'first_name', 
    	'Last Name' => 'last_name',
    	'Age' => 'age', 
    	'Sex' => 'sex',
    	'Address' => 'address',
    	'Contact Number' => 'contact_number',
    	'Last Visited At' => 'last_visited_at'
    ),
    'cur_page' => $patients->get_current_page(),
    'base_url' => '/hospital/patients/index',
    'order_by_field' => $patients->get_field(),
    'order_by_direction' => $patients->get_direction(),
    'search' => $patients->get_search_term(),
    'total_rows' => $patients->get_total_rows(),
    'per_page' => $patients->get_page_size(),
);

$this->bspaginator->config($config);

?>


<div class="container">

	<div class="row-fluid">
		<div class="span12">

			<div class="pull-left">
				<h2>Listing Patients</h2>
				<h5 style="margin-left:5px;">Showing result<?=($patients->get_total_rows() == 1) ? '' : 's'?> <?=($patients->get_page_size() > $patients->get_total_rows()) ? $patients->get_total_rows() : ($patients->get_page_size() * ($patients->get_current_page() - 1) + 1) .' - '. ($patients->get_page_size() * ($patients->get_current_page() - 1) + $patients->get_row_per_current_page())?> of <?=number_format($patients->get_total_rows())?></h5>
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

					<form name="search-patient" action="<?php echo base_url('patients/index');?>">
						
						<input style="width:20%;align:left;" name="search" type="text" value="<?=$patients->get_search_term() ? $patients->get_search_term() : ''?>" placeholder="Type search term..." autofocus>

						<br/><br/>
						
						<button type="submit" class="btn btn-success" style="width:20%;align:left;"><i class="icon-search icon-white"></i>Search</button>
						
					</form>
					<hr>
					<div class="span9">
						<?php if($patients->get_total_rows() > 0){ ?>

						<div class="table-container">
							<table class="table table-striped table-bordered">

								<?=$this->bspaginator->table_header()?>

								<tbody>
									<?php foreach ($patients as $patient){ ?>
										<tr>
											<td><?=$patient->pub_id?></td>
											<td><?=$patient->first_name?></td>
											<td><?=$patient->last_name?></td>
											<td><?=$patient->age?></td>
											<td>
												<?php
												if($patient->sex == 0)
													echo "Male";
												else
													echo "Female";
												?>
											</td>
											<td><?=$patient->address?></td>
											<td><?=$patient->contact_number?></td>
											<td><?=$patient->last_visited_at?></td>
											<td><a>Add Follow up</a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php } else { ?>
							<div class="well" style="text-align:center; padding:100px 0;">
								<p style="font-size:24px;">No Patients found.</p>
								<p style="font-size:14px;">Your patient query has not returned any valid results.</p>
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