 <?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Edit Skill 
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/skill'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Skill List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/skill/edit/".$single['skill_id'] ?>" enctype="multipart/form-data">
            <input type="hidden" name="skill_id" value="<?= set_value('skill_id',$single['skill_id']) ?>" >
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                     <label for="title" class="col-md-12 control-label">Skill Name<span class="text-red" style="color:red">*</span></label>
                     <div class="col-md-12">
                        <input type="text" name="skill_name" required="" class="form-control" id="skill_name" value="<?= set_value('skill_name',$single['skill_name']) ?>" placeholder="Enter Skill Name">
                        <?php echo form_error('skill_name');?>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="form-group">
               <div class="col-md-12">
                  <input type="submit"  name="submit" value="Update skill" class="btn btn-primary pull-right">
               </div>
            </div>
            <?php echo form_close( ); ?>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>






























































