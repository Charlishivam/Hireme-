 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">

	
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp;  Time List</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/dashboard/adddate'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Date </a>
				</div>
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">ID</th>
							<th> Date </th>
							<!--<th width="100">Action</th>-->
						</tr>
					</thead>
					<tbody>
						<?php 
						
						 $end = $records['end_date'];
                        $start = $records['start_date'];
                        $datediff = strtotime($end) - strtotime($start);
						$datediff = floor($datediff/(60*60*24));
							$x=1;
						for($i = 0; $i < $datediff + 1; $i++){
    
                      ?>
							<tr>
								<td><?= $x; ?></td>
								
								<td><?php echo date("Y-m-d", strtotime($start . ' + ' . $i . 'day')); ?></td>
<!--								<td>-->
<!--								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--  Add Time-->
<!--</button>-->
									
								
								</td>
							</tr>
<?php $x++;} ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="http://localhost/UrbanClap/admin/dashboard/adddate" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 
 <div class="form-group">
   <label for="cat_name" class="col-md-2 control-label"> Add Date</label>

   <div class="col-md-6">
	 <input type="time" name="start_date" min="1980-01-01" onfocusout="getDate()" class="form-control" id="start_date" placeholder="">
   </div>
   
   
 </div>
 

 <div class="form-group">
   <label for="cat_name" class="col-md-2 control-label"> End date</label>

   <div class="col-md-6">
	 <input type="time" name="end_date" class="form-control" id="end_date" placeholder="" min="NaN-NaN-NaN">
   </div>
 </div>
 

 <div class="form-group">
   <div class="col-md-12">
	 <input type="submit" name="submit" value="Add Date" class="btn btn-primary pull-right">
   </div>
 </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



