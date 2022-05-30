<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-edit"></i>
                  Edit Bidding 
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/jobpost/view/'.$single['bidding_job_post_id']); ?>" class="btn btn-success"><i class="fa fa-list"></i>Bidding List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/jobpost/bidding_edit/".$single['bidding_job_post_id'] ?>" enctype="multipart/form-data">
               <input type="hidden" name="bidding_job_post_id" value="<?= $single['bidding_job_post_id'] ?>">

               <input type="hidden" name="bidding_id" value="<?= $single['bidding_id'] ?>">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Customer Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('bidding_customer_id',$customer_name,set_value('bidding_customer_id',$single['bidding_customer_id']),'class="form-control" id="kt_select2_4"'); ?>
                        <?php echo form_error('bidding_customer_id');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Bidding Amount:</label>
                     <div class="col-lg-10">
                        <input type="text" name="bidding_amount" required="" class="form-control" id="bidding_amount" value="<?= set_value('bidding_amount',$single['bidding_amount']) ?>" placeholder="customer bidding amount">
                        <?php echo form_error('bidding_amount');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Shortlist Status:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('bidding_shortlist',[''=>'Select Short List','0'=>'No','1'=>'Yes'],set_value('bidding_shortlist',$single['bidding_shortlist']),'class="form-control" id="kt_select2_1"'); ?>
                        <?php echo form_error('bidding_shortlist');?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Bidding Comment:</label>
                     <div class="col-lg-10">
                        <textarea name="bidding_comment" class="form-control"><?= $single['bidding_comment'] ?></textarea>
                        <?php echo form_error('bidding_comment');?>
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
    $('#kt_select2_4').select2({
         placeholder: "Select a Customer"
        });
</script>


<script type="text/javascript">
    $('#kt_select2_2').select2({
         placeholder: "Select a Participant"
        });
</script>
