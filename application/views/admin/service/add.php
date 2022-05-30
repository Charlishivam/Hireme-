<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Service
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/service'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Service List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/service/add" ?>" enctype="multipart/form-data">
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Customer Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('customer_id',$customer_name,set_value('customer_id'),'class="form-control" id="kt_select2_3"'); ?>
                        <?php echo form_error('customer_id');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Category Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('service_category',$category_name,set_value('service_category'),'class="form-control" id="kt_select2_1"'); ?>
                        <?php echo form_error('service_category');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Subcategory Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('service_subcategory',$subcategory_name,set_value('service_subcategory'),'class="form-control" id="kt_select2_2"'); ?>
                        <?php echo form_error('service_subcategory');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Title :</label>
                     <div class="col-lg-10">
                        <input type="text" name="service_title" class="form-control" required="" placeholder="Title" value="<?= set_value('service_title') ?>" />
                        <span class="form-text text-muted">Please enter your service Title</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Price :</label>
                     <div class="col-lg-10">
                        <input type="text" name="service_price" class="form-control" required="" placeholder="service price" value="<?= set_value('service_price') ?>" />
                        <span class="form-text text-muted">Please enter your service price</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  
                <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Service Delivery :</label>
                     <div class="col-lg-10">
                        <input type="text" name="service_delivery" class="form-control" required="" placeholder="service_delivery" value="<?= set_value('service_delivery	') ?>" />
                        <span class="form-text text-muted">Please enter your service delivery</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Description:</label>
                     <div class="col-lg-10">
                        <textarea type="text" class="form-control"  name="service_description"></textarea>
                        <span class="form-text text-muted">please enter your description</span>
                        <?php echo form_error('service_description');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Service Image:</label>
                     <div class="col-lg-3">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(uploads/images/avtar.png)"></div>
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="service_image" value="<?= set_value('service_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('service_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
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
            </form>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>
<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js"></script>


<script type="text/javascript">
    $('#kt_select2_1').select2({
         placeholder: "Select a Category Name"
        });
</script>

<script type="text/javascript">
    $('#kt_select2_2').select2({
         placeholder: "Select a Subcategory Name"
        });
</script>

<script type="text/javascript">
    $('#kt_select2_3').select2({
         placeholder: "Select a Customer Name"
        });
</script>

<script type="text/javascript">
  $('#kt_select2_7').select2({
         
        });
</script>

<script type="text/javascript">
   $(document).on('change','#kt_select2_1',function(){
         var _this = $(this);
         var category_id = $('#kt_select2_1').val();
         $.ajax({
           url:"<?php echo base_url(); ?>/admin/jobpost/get_subcatgory",
           type: "post",
           data: {'category_id':category_id} ,
           success: function (response) {
            console.log(response);
            let subcat = JSON.parse(response);
            $('#kt_select2_2').find('option').not(':first').remove();
            for (var i = subcat.length - 1; i >= 0; i--) {
               $('#kt_select2_2').append('<option value="'+subcat[i].subcategory_id+'">'+subcat[i].subcategory_name+'</option>');
            }
           },
           error: function(jqXHR) {

           }
         });
    })
    
</script>
