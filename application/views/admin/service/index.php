 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Service List</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/service/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Service</a>
				</div>
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">SN</th>
							<th>Customer name </th>
							<th>Category </th>
							<th>Subcategory </th>
							<th>Title </th>
							<th>Summary</th>
							<th>Price Details</th>
							<th>Status </th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $idx => $record): ?>
							<tr>
								<td><?= $idx + 1 ?></td>
								<td><?= $record['customer_first_name']."&nbsp;".$record['customer_last_name']; ?></td>
								<td><?= $record['category_name']; ?></td>
								<td><?= $record['subcategory_name']; ?></td>
								<td><?= $record['service_title']; ?></td>
								<td><?= $record['service_description']; ?></td>
								<td><?php if(!empty($record['service_price'])): ?> 
			                        <div class="d-flex align-items-center justify-content-between mb-2">
			                           <span class="font-weight-bold mr-2">Price </span>
			                           <span class="text-dark"><?= $record['service_price']; ?></span>
			                        </div>
			                        <?php endif; ?> 
			                    </td>
								<td><a href="<?php echo site_url("admin/service/service_status/".$record['service_id'] . "/" . $record['service_status']);?>" class="badge <?php if($record['service_status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['service_status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a>
								</td>
								<td>
									<a style="margin-top: 5px;" href="<?php echo site_url("admin/service/edit/".$record['service_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
									<a style="margin-top: 5px;" href="<?php echo site_url("admin/service/delete/".$record['service_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>


