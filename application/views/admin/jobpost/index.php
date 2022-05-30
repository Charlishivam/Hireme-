 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Jobpost List</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/jobpost/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Jobpost</a>
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
								<td><?= $record['jobpost_title']; ?></td>
								<td><?= $record['jobpost_summary']; ?></td>
								<td><?php if(!empty($record['jobpost_price_from'])): ?> 
			                        <div class="d-flex align-items-center justify-content-between mb-2">
			                           <span class="font-weight-bold mr-2">Price From : </span>
			                           <span class="text-dark"><?= $record['jobpost_price_from']; ?></span>
			                        </div>
			                        <?php endif; ?> 
			                        <?php if(!empty($record['jobpost_praposal'])): ?> 
			                        <div class="d-flex align-items-center justify-content-between mb-2">
			                           <span class="font-weight-bold mr-2">Praposal  : </span>
			                           <span class="text-dark"><?= $record['jobpost_praposal']; ?></span>
			                        </div>
			                        <?php endif; ?> 
			                    </td>
								<td><a href="<?php echo site_url("admin/jobpost/jobpost_status/".$record['jobpost_id'] . "/" . $record['jobpost_status']);?>" class="badge <?php if($record['jobpost_status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['jobpost_status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a>
								</td>
								<td>
									<a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/edit/".$record['jobpost_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
									<a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/delete/".$record['jobpost_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

									<a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/view/".$record['jobpost_id']); ?>" class="btn btn-info btn-xs mr5" >
											<i class="fa fa-eye"></i>
									</a>
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


