  <!-- Content Wrapper. Contains page content -->
<link href="<?= base_url()?>assets/our_js/jquery.multiselect.css" rel="stylesheet" type="text/css" />
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add Notification </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/notification/add'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Notification List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart(base_url('admin/notification/add'), 'class="form-horizontal"');  ?> 

            <input type="hidden" name="notification_set" value="insert">
            <div class="row">
               <div class="col-md-12">
                 <label for="notification_type" class="col-md-6 control-label">Notification Type</label>
                     <div class="col-md-12">
                        <?= form_dropdown('notification_type',[''=>'Select Notification Type','0'=>'Normal Customer','1'=>'Service Customer'],set_value('notification_type'),'class="form-control" id="notification_type" onchange="setValue()"'); ?>
                     </div>
               </div>
            </div>
            <br>

            <div class="row" id="normal_customer" style="display:none">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Normal Customer<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                         <?= form_dropdown('customer_id[]',$normal_customer,set_value('customer_id[]'),'class="form-control select2" id="kt_select2_2_modal" multiple="multiple"') ?>
                        <?= form_error('customer_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row" id="service_customer" style="display:none">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Service Customer<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                         <?= form_dropdown('customer_id[]',$service_customer,set_value('customer_id[]'),'class="form-control select2" id="kt_select2_3" multiple="multiple"') ?>
                        <?= form_error('customer_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
               </div>
            </div>

           
            
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="cat_name" class="col-md-6 control-label">Title</label>
                     <div class="col-md-12">
                        <input type="text" name="notification_title" required="" class="form-control" id="notification_title" placeholder="Rnter Title">
                     </div>
                  </div>
               </div>
            </div>


            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="cat_name" class="col-md-6 control-label">Notification Description</label>
                     <div class="col-md-12">
                        <textarea name="notification_description" class="form-control"></textarea>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                     <label for="title" class="col-md-6 control-label">Notification Image<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="file" name="notification_image" class="custom-file-input" id="imgInp">
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
                  <input type="submit" name="submit" value="Add Notification" class="btn btn-primary pull-right">
                </div>
              </div>
           </form>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>




<!-- <script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/select2.js"></script> -->

<script src="<?= base_url() ?>assets/our_js/jquery.multiselect.js"></script>

<script type="text/javascript">
   $('#kt_select2_2_modal').multiselect({
    columns: 1,
    placeholder: 'Select Customer',
    search: true,
    selectAll: true
});
</script>

<script type="text/javascript">
   $('#kt_select2_3').multiselect({
    columns: 1,
    placeholder: 'Select Customer',
    search: true,
    selectAll: true
});
</script>



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





<script type="text/javascript">
    
       function setValue()
       {
               
              
           type=$('#notification_type').val();
           if(type =="1")
           {
            
               $('#normal_customer').hide();
               $('#service_customer').show();
           }

           if(type =="0")
           {
               
               $('#service_customer').hide();
               $('#normal_customer').show();
           }
                
       
            
       }
    
</script>


