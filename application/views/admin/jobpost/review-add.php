<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Review
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/jobpost/view/'.$jobpost_id); ?>" class="btn btn-success"><i class="fa fa-list"></i>Review List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/jobpost/review_add/".$jobpost_id ?>" enctype="multipart/form-data">
               <input type="hidden" name="jobpost_id" value="<?= $jobpost_id ?>">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Customer Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('review_customer_id',$customer_name,set_value('review_customer_id'),'class="form-control" id="kt_select2_4"'); ?>
                        <?php echo form_error('review_customer_id');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Review Rating:</label>
                     <div class="col-lg-10">
                        <input type="number" min="0" max="5"  name="review_rating" required="" class="form-control" id="review_rating" value="<?= set_value('review_rating') ?>" placeholder="customer review rating">
                        <?php echo form_error('review_rating');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Review Comment:</label>
                     <div class="col-lg-10">
                        <textarea name="review_comment" class="form-control"></textarea>
                        <?php echo form_error('review_comment');?>
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
