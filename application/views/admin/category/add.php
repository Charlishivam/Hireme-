<!-- Content Wrapper. Contains page content -->
<!-- For Messages -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> 
<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Category 
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/category'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Category List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/category/add" ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Category Name<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="text" name="category_name" required="" class="form-control" id="category_name" value="<?= set_value('category_name') ?>" placeholder="Enter Category Name">
                       
                        <?php echo form_error('category_name');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-1 col-form-label text-lg-right">Image:</label>
                     <div class="col-lg-3">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(uploads/images/avtar.png)"></div>
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="category_image" value="<?= set_value('category_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('category_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
                           </div>
                           <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                     </div>
                  </div>
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Add New Category" class="btn btn-primary pull-right">
               </div>
            </div>
            <?php echo form_close( ); ?>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>




















