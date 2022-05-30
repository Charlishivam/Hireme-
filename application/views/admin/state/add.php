<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New State
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/state'); ?>" class="btn btn-success"><i class="fa fa-list"></i>State List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/state/add" ?>" enctype="multipart/form-data">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> State Name:</label>
                     <div class="col-lg-4">
                        <div class="col-md-12">
                        <input type="text" name="state_name" required="" class="form-control" id="state_name" value="<?= set_value('state_name') ?>" placeholder="State Name">
                        <?php echo form_error('state_name');?>
                     </div>
                     </div>

                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> State Code:</label>
                     <div class="col-lg-4">
                        <div class="col-md-12">
                        <input type="text" name="state_code" required="" class="form-control" id="state_code" value="<?= set_value('state_code') ?>" placeholder="State Code">
                        <?php echo form_error('state_code');?>
                     </div>
                     </div>
                  </div>

                  
                 
                  <div class="card-footer">
                     <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                           <button type="submit" class="btn btn-primary mr-2">Submit</button>
                           <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>




