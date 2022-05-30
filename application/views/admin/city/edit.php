<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-edit"></i>
                  Edit City
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/city'); ?>" class="btn btn-success"><i class="fa fa-list"></i>City List</a>
            </div>
         </div>
         <div class="card-body">
             <?php echo form_open_multipart(base_url('admin/city/edit/' .$single['city_id']), 'class="form-horizontal"');  ?>
            <input type="hidden" name="city_id" value="<?= $single['city_id'] ?>">
               <div class="card-body">
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> State Name:</label>
                     <div class="col-lg-5">
                        <?= form_dropdown('city_state_id',$all_state,set_value('city_state_id',$single['city_state_id']),'class="form-control" id="kt_select2_1"') ?>
                        <?= form_error('city_state_id', '<div class="error">', '</div>'); ?>
                     </div>
                  </div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> City Name:</label>
                     <div class="col-lg-5">
                       
                        <input type="text" name="city_name" required="" class="form-control" id="city_name" value="<?= set_value('city_name',$single['city_name']) ?>" placeholder="City Name">
                        <?php echo form_error('city_name');?>
                     
                     </div>
                  </div>

                  
                 
                  <div class="card-footer">
                     <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                           <button type="submit" class="btn btn-primary mr-2">Update</button>
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

<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/select2.js"></script>

<script type="text/javascript">
    $('#kt_select2_1').select2({
         placeholder: "Select a State"
        });
</script>










