<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Notification List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/notification/add'); ?>"
                  class="btn btn-success"><i class="fa fa-plus"></i> Add New Notification </a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th>Notification ID</th>
                     <th>Notification Title</th>
                     <th>Notification Description</th>
                     
                     <th>Notification Image </th>
                     <!-- <th>Notification Icon </th> -->
                     <th>Date</th>
                     <th>Action</th>
                    
                    
                  </tr>
               </thead>
               <tbody>
                  <?php $i=1;foreach($records as $record):
  
                     ?>
                  <tr> 
                     <td><?= $record['notification_id'] ?></td> 
                     <td><?= $record['notification_title']; ?></td>
                     <td><?= $record['notification_description']; ?></td>
                     
                     <td>
                        <?php if(empty($record['notification_image'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <img src="<?=$record['notification_image']; ?>" width="100px" height="auto" />
                        <?php  }  ?>
                     </td>
                     
                     <td><?= date('d M Y', strtotime($record['notification_create_at'])); ?> </td>
                     <td>
                        <a style="margin-top: 5px;" href="<?php echo site_url("admin/notification/delete/".$record['notification_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-trash"></i>
                        </a>
                     </td>
                    
                     
                  </tr>
                  <?php $i++; endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
   $(function () {
     $("#example1").DataTable();
   })
</script>