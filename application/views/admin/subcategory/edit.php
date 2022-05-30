<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Subcategory 
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/subcategory'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Subcategory List</a>
            </div>
         </div>
         <div class="card-body">
           
            <form method="POST" action="<?= base_url()."admin/subcategory/edit/".$single['subcategory_id'] ?>" enctype="multipart/form-data">
            <input type="hidden" name="subcategory_id" value="<?= set_value('subcategory_id',$single['subcategory_id']) ?>" >

               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Category Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('category_id',$category_name,set_value('category_id',$single['category_id']),'class="form-control" id="kt_select2_2"') ?>
                        <?= form_error('category_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
                  
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Subcategory Name:</label>
                     <div class="col-lg-10">
                       
                        <input type="text" name="subcategory_name" required="" class="form-control" id="subcategory_name" value="<?= set_value('subcategory_name',$single['subcategory_name']) ?>" placeholder="Subcategory Name">
                        <?php echo form_error('subcategory_name');?>
                     
                     </div>
                  </div>

                   <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Image:</label>
                     <div class="col-lg-10">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(<?= base_url($single['subcategory_image']); ?>)"></div>
                              
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="subcategory_image" value="<?= set_value('subcategory_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('subcategory_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
                           </div>
                        </div>
                           <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
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
            <?php echo form_close( ); ?>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>

<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/select2.js"></script>

<script type="text/javascript">
    $('#kt_select2_1').select2({
         placeholder: "Select a City"
        });
</script>
<script type="text/javascript">
    $('#kt_select2_2').select2({
         placeholder: "Select a State"
        });
</script>




















































































