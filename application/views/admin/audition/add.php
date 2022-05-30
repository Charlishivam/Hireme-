<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Audition
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/audition'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Audition List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/audition/add" ?>" enctype="multipart/form-data">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Season Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('audition_season_id',$season_name,set_value('audition_season_id'),'class="form-control" id="kt_select2_1"') ?>
                        <?= form_error('audition_season_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> Participant Name:</label>
                     <div class="col-lg-10">
                        <?= form_dropdown('audition_participant_id',$participant_name,set_value('audition_participant_id'),'class="form-control" id="kt_select2_2"') ?>
                        <?= form_error('audition_participant_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
                  
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Audition Start Date:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" name="audition_start_date" class="form-control" autocomplete="false"  id="kt_datepicker_3" placeholder="Start Date" value="<?= set_value('audition_start_date') ?>" />
                           <?php echo form_error('audition_start_date');?>
                        </div>
                        <span class="form-text text-muted">Please enter start audition date</span>

                     </div>

                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Audition End Date:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" autocomplete="false" name="audition_end_date" class="form-control"  id="kt_datepicker_3" placeholder="End Date" value="<?= set_value('audition_end_date') ?>" />
                           <?php echo form_error('audition_end_date');?>
                        </div>
                        <span class="form-text text-muted">Please enter end audition date</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Audition Image:</label>
                     <div class="col-lg-10">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(<?= base_url('uploads/images/avtar.png'); ?>)"></div>
                              
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="audition_image" value="<?= set_value('audition_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('audition_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
                           </div>
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

<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/select2.js"></script>

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
