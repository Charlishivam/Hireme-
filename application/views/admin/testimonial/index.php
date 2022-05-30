<!-- Alert Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Testimonial List</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/testimonial/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Testimonial </a>
				</div>
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">SN</th>
							<th>Testimonial Title</th>
							<th>Testimonial Description</th>
							<th>Testimonial Rating Value</th>
							<th>Testimonial Image</th>
							<th>Testimonial Status</th>
							<th width="100">Action</th>
						</tr>

					</thead>
					<tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td><?= $record['testimonial_title']; ?></td>
                     <td><?= $record['testimonial_content']; ?></td>
                     <td><?= $record['testimonial_rating_value']; ?></td>
                     <td>
                        <?php if(empty($record['testimonial_image'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <img src="<?= base_url($record['testimonial_image'] ); ?>" width="100px" height="auto" />
                        <?php  }  ?>
                     </td>
                     <td><a href="<?php echo site_url("admin/testimonial/testimonial_status/".$record['testimonial_id'] . "/" . $record['testimonial_status']);?>" class="badge <?php if($record['testimonial_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['testimonial_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a href="<?php echo site_url("admin/testimonial/edit/".$record['testimonial_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?php echo site_url("admin/testimonial/delete/".$record['testimonial_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
					
				
				</table>
			</div>
		</div>
	</section>
	<!-- /.Alert -->
</div>


