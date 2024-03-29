<?php

// echo"<pre>"; 
// print_r($user);die; 
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; Edit User </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Users List</a>
            
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/users/edit/'.$user['customer_id']), 'class="form-horizontal"' )?> 
              
              <div class="form-group">
                <label for="firstname" class="col-md-2 control-label">First Name</label>

                <div class="col-md-12">
                  <input type="text" name="firstname" value="<?= $user['first_name']; ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-md-2 control-label">Last Name</label>

                <div class="col-md-12">
                  <input type="text" name="lastname" value="<?= $user['last_name']; ?>" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-2 control-label">Email</label>

                <div class="col-md-12">
                  <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label">Mobile No</label>

                <div class="col-md-12">
                  <input type="number" name="mobile_no" value="<?= $user['mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
							</div>
							
							<div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label">Wallet Amount</label>

                <div class="col-md-12">
                  <input type="number" name="wallet" value="<?= $user['wallet']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
							</div>
							
              <div class="form-group">
                <label for="role" class="col-md-2 control-label">Select Status</label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($user['status'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($user['status'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update User" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>
