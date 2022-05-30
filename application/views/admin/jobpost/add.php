<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Job Post
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/jobpost'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Customer List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/jobpost/add" ?>" enctype="multipart/form-data">
               <div class="card-body">
                       <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Customer Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('customer_id',$customer_name,set_value('customer_id',$single['customer_id']),'class="form-control" id="kt_select2_8"'); ?>
                        <?php echo form_error('customer_id');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Category Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('jobpost_category',$category_name,set_value('jobpost_category'),'class="form-control" id="kt_select2_1"'); ?>
                        <?php echo form_error('jobpost_category');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Subcategory Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('jobpost_subcategory',$subcategory_name,set_value('jobpost_subcategory'),'class="form-control" id="kt_select2_2"'); ?>
                        <?php echo form_error('jobpost_subcategory');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Title :</label>
                     <div class="col-lg-10">
                        <input type="text" name="jobpost_title" class="form-control" required="" placeholder="Title" value="<?= set_value('jobpost_title') ?>" />
                        <span class="form-text text-muted">Please enter your title</span>
                     </div>
                  </div>


                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Post Till Date :</label>
                     <div class="col-lg-10">
                        <input type="text" name="jobpost_till_date" class="form-control"  id="kt_datepicker_3" placeholder="Post Till Date" value="<?= set_value('jobpost_till_date') ?>" />
                        <?php echo form_error('jobpost_till_date');?>
                        <span class="form-text text-muted">Please select your till date</span>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Summary:</label>
                     <div class="col-lg-10">
                        <input type="text" name="jobpost_summary" class="form-control"  id="" placeholder="Summary" value="<?= set_value('jobpost_summary') ?>" />
                        <?php echo form_error('jobpost_summary');?>
                        <span class="form-text text-muted">Please enter your summary</span>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>From Price:</label>
                     <div class="col-lg-4">
                        <input type="number" class="form-control" name="jobpost_price_from" placeholder="From Price" required="" value="<?= set_value('jobpost_price_from') ?>"/>
                        <span class="form-text text-muted">Please enter your from price</span>
                     </div>
                     
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Praposal:</label>
                     <div class="col-lg-4">
                        <input type="number" class="form-control" name="jobpost_praposal" placeholder="Praposal" required="" value="<?= set_value('jobpost_praposal') ?>"/>
                        <span class="form-text text-muted">Please enter your praposal</span>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Skill:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('jobpost_skill[]',$skill_name,set_value('jobpost_skill[]'),'class="form-control" id="kt_select2_7" multiple="multiple" required') ?>
                        <?= form_error('jobpost_skill', '<div class="error">', '</div>'); ?>  
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Description:</label>
                     <div class="col-lg-10">
                        <textarea type="text" class="form-control"  name="jobpost_description"></textarea>
                        <span class="form-text text-muted">please enter your description</span>
                        <?php echo form_error('jobpost_description');?>
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
    $('#kt_select2_8').select2({
         placeholder: "Select a customer Name"
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
