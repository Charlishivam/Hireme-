<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Service List
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/customer/view/'.$customer_id); ?>" class="btn btn-success"><i class="fa fa-list"></i>Service List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/customer/service_add/".$customer_id ?>" enctype="multipart/form-data">
               <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Service Name:</label>
                     <div class="col-lg-4">
                        <input type="text" name="customer_service_name" required="" class="form-control" id="customer_service_name" value="<?= set_value('customer_service_name') ?>" placeholder="customer service name">
                        <?php echo form_error('customer_service_name');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Service Price:</label>
                     <div class="col-lg-4">
                        <input type="text" name="customer_service_price" required="" class="form-control" id="customer_service_price" value="<?= set_value('customer_service_price') ?>" placeholder="customer service price">
                        <?php echo form_error('customer_service_price');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Service Description:</label>
                     <div class="col-lg-4">
                        <textarea name="customer_service_description" class="form-control"></textarea>
                        <?php echo form_error('customer_service_price');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Service Image:</label>
                     <div class="col-lg-10">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(<?= base_url('uploads/images/avtar.png'); ?>)"></div>
                              
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="customer_service_image" value="<?= set_value('customer_service_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('customer_service_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
                           </div>
                          </div>
                           <span class="form-text text-muted">Allowed Image types: jpg,jpeg,png </span>
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
<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/select2.js"></script>
<script type="text/javascript">
   $(document).on('change','#kt_select2_1',function(){
         var season_id = $('#kt_select2_1').val();
         $.ajax({
           url:"<?php echo base_url(); ?>/admin/participant/get_audition",
           type: "post",
           data: {'season_id':season_id} ,
           success: function (response) {
            let date = JSON.parse(response);
            $('#kt_select2_2').find('option').not(':first').remove();
            for (var i = date.length - 1; i >= 0; i--) {
               $('#kt_select2_2').append('<option value="'+date[i].audition_id+'">'+date[i].audition_name+'</option>');
            }
           },
           error: function(jqXHR) {

           }
         });
    })
</script>

<script type="text/javascript">
    $('#kt_select2_1').select2({
         placeholder: "Select a Season"
        });
</script>


<script type="text/javascript">
    $('#kt_select2_2').select2({
         placeholder: "Select a Participant"
        });
</script>
