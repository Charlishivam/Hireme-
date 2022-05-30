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
                  Add New Testimonial
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/testimonial'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Testimonial List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/testimonial/add" ?>" enctype="multipart/form-data">

            <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                     <label for="knowedge_heading" class="col-md-12 control-label">Testimonial Title<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <input type="text" name="testimonial_title" class="form-control" id="testimonial_title" placeholder="Enter Testimonial Title">
                        <?php echo form_error('testimonial_title');?>
                        
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                     <label for="knowedge_heading" class="col-md-12 control-label">Rating Value<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="number" name="testimonial_rating_value" min="1" class="form-control" max="5" id="testimonial_rating_value" placeholder="Enter Rating value">
                        <?php echo form_error('testimonial_rating_value');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="testimonial_content" class="col-md-12 control-label">Testimonial Description<span class="text-red" style="color:red">*</span></label>
                    
                      <div class="col-md-12">
                        <textarea type="text" class="form-control updateeditor"  name="testimonial_content"/></textarea>
                        
                        <?php echo form_error('testimonial_content');?>
                     </div>
                  </div>
               </div>
            </div>

             <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                     <label for="title" class="col-md-6 control-label">Testimonial Image<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="file" name="testimonial_image" class="custom-file-input" id="imgInp">
                        <label class="custom-file-label" for="imgInp">Choose file</label>
                     </div>
                  </div>
               </div>

               <div class="col-md-6">
                   <div class="form-group">
                     <label for="title" class="col-md-6 control-label">Image<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                         <img id="blah" src="<?= base_url('uploads/images/image-placeholder.jpg'); ?>" width="150" height="150"/>
                     </div>
                  </div>
               </div>
            </div>
           
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Add Testimonial" class="btn btn-primary pull-right">
               </div>
            </div>
            <?php echo form_close( ); ?>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>

  
<script>
    CKEDITOR.replace('editor1')
</script>
<script src="<?= base_url() ?>assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
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























