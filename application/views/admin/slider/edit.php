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
                  Edit Slider  
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/slider'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Slider List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/slider/edit/".$single->slider_id ?>" enctype="multipart/form-data">

            <input type="hidden" name="slider_id" value="<?= set_value('slider_id',$single->slider_id) ?>">
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Slider Name<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <input type="text" name="slider_name" required="" class="form-control" id="slider_name" value="<?= set_value('slider_name',$single->slider_name) ?>" placeholder="Slider Name">
                        <?php echo form_error('slider_name');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Slider Url<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="url" name="slider_link" required="" class="form-control"  value="<?= set_value('slider_link',$single->slider_link) ?>" placeholder="Slider Url">
                        <?php echo form_error('slider_link');?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Slider Type<span class="text-red" style="color:red">*</span></label>
                    
                     <div class="col-md-12">
                        <?= form_dropdown('slider_type',[''=>'Select Slider Type','0'=>'Images','1'=>'Video'],set_value('slider_type',$single->slider_type),'class="form-control" id="slider_type"'); ?>
                        <?php echo form_error('slider_type');?>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-6 control-label">Slider Image/Video<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="file" name="slider_url" class="custom-file-input" id="imgInp">
                        <label class="custom-file-label" for="imgInp">Choose file</label>
                     </div>
                  </div>
               </div>
            </div>
            

               <?php if($single->slider_type == 1) { ?>
                  <div class="form-group">
                  <video width="200"controls>
                     <source src="<?= base_url($single->slider_url); ?>" type="video/mp4">
                     <source src="movie.ogg" type="video/ogg">
                     Your browser does not support the video tag.
                  </video>
                  </div>
               <?php } ?>

               <?php if($single->slider_type == 0) { ?>
                  <div class="form-group">
                   <img id="blah" src="<?= base_url($single->slider_url); ?>" width="150" height="150"/>
                   </div>
               <?php } ?>

              
            
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Update Slider" class="btn btn-primary pull-right">
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

















