

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Customer List</h3>
				</div>

				<div class="d-inline-block float-right">
					<!-- <a href="<?= base_url('admin/Users/user_order_booking'); ?>" class="btn btn-success"><i class="fa fa-plus"></i>  Add New Booking Order</a> -->
				</div>
				
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">ID</th>
							<th>User Name </th>
							<th>Mobile</th>
							<th>Email </th>
							<th>Status</th>
							<th>Image</th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach($result as $record):
						
							?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $record['full_name']; ?></td>
								<td><?= $record['mobile']; ?></td>
								<td><?= $record['email']; ?></td>
								
							
	<td><a href="<?php echo site_url("admin/Users/change_status/".$record['customer_id'] . "/" . $record['status']);?>" class="badge <?php if($record['status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a></td>
								<td>
								<?php  
								if(empty($record['image'])){  ?>

									<img src="<?= base_url('uploads/images/avtar.png'); ?>" width="100px" height="auto" /></td>
								<?php }else{
								?>	
								<img src="<?= base_url('uploads/user/'.$record['image']); ?>" width="100px" height="auto" /></td>
								
								<?php  }  ?>
								<td>

									

									<a style="margin-top: 5px;" href="<?php echo site_url("admin/users/edit/".$record['customer_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
									</a>&nbsp;&nbsp;



									<a style="margin-top: 5px;" href="<?php echo site_url("admin/users/view/".$record['customer_id']); ?>" class="btn btn-info btn-xs mr5" >
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;
									<a style="margin-top: 5px;" href="<?php echo site_url("admin/users/delete/".$record['customer_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>


