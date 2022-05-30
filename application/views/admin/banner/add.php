<!-- Content Wrapper. Contains page content -->
<!-- For Messages -->
<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Banner  
               </h3> 
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/banner'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Banner List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/banner/add" ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Banner Name<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <input type="text" name="banner_name" required="" class="form-control" id="banner_name" value="<?= set_value('banner_name') ?>" placeholder="banner Name">
                        <?php echo form_error('banner_name');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Banner Url<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <input type="url" name="banner_text_url" required="" class="form-control" id="banner_text_url" value="<?= set_value('banner_text_url') ?>" placeholder="banner url">
                        <?php echo form_error('banner_text_url');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Banner Type<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <?= form_dropdown('banner_type',[''=>'Select Banner Type','0'=>'Banner','1'=>'Advertisement'],set_value('banner_type'),'class="form-control" id="banner_type"'); ?>
                        <?php echo form_error('banner_type');?>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-6 control-label">Banner Image<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="file" name="banner_url" class="custom-file-input" id="imgInp">
                        <label class="custom-file-label" for="imgInp">Choose file</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
              <img id="blah" src="<?= base_url('uploads/images/image-placeholder.jpg'); ?>" width="150" height="150"/>
            </div>
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Add Banner" class="btn btn-primary pull-right">
               </div>
            </div>
            <?php echo form_close( ); ?>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>


<script>

  
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>

















