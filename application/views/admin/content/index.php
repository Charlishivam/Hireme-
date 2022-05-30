 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Content List</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/content/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Content</a>
				</div>
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">SN</th>
							<th>Content Title </th>
							<th>Content Description</th>
							<th>Content Slug </th>
							<th>Content Image</th>
							<th>Content Status </th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $idx => $record): ?>
							<tr>
								<td><?= $idx + 1 ?></td>
								<td><?= $record['content_title']; ?></td>
								<td><?= $record['content_description']; ?></td>
								<td><?= $record['content_slug']; ?></td>

								<td><img src="<?= base_url('uploads/content/' .$record['content_image'] ); ?>" width="100px" height="auto" /></td>
		

								 <td><a href="<?php echo site_url("admin/content/content_status/".$record['content_id'] . "/" . $record['content_status']);?>" class="badge <?php if($record['content_status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['content_status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a></td>
								<td>
									<a href="<?php echo site_url("admin/content/edit/".$record['content_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
									<a href="<?php echo site_url("admin/content/delete/".$record['content_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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


