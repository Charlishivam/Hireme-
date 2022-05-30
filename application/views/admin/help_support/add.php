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
                  Add New Ticket  
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/HelpSupport'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Query Ticket List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/HelpSupport/add" ?>" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Customer Name<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                         <?= form_dropdown('user_id',$allcustomer,set_value('user_id'),'class="form-control select2" id="kt_select2_2_modal"') ?>
                        <?= form_error('user_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
               </div>
            </div>
           
            <div class="row">
               <div class="col-md-12">
                 <label for="cat_name" class="col-md-6 control-label">Ticket Type</label>
                     <div class="col-md-12">
                        <?= form_dropdown('type',[''=>'Select Ticket Type','1'=>'Rider issue','2'=>'Booking issue'],set_value('type'),'class="form-control" id="type"'); ?>
                     </div>
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-12">
                 <label for="cat_name" class="col-md-6 control-label">Ticket Description</label>
                     <div class="col-md-12">
                         <textarea name="message" id="editor3" cols="30" rows="8"></textarea>
                       
                        <?php echo form_error('message');?>
                     </div>
               </div>
            </div>
            <br>
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Add Ticket" class="btn btn-primary pull-right">
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
   
       // nested
         $('#kt_select2_2_modal').select2({
          placeholder: "Select a Ticket"
         });
</script>

<script>
    CKEDITOR.replace('editor3')
</script>

  




















