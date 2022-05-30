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
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Query Ticket List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/HelpSupport/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Ticket</a>
            </div>
         </div>
         <div class="card-body">
            <?php //print_r($bookings); ?>
            <table id="example1" class="table table-bordered table-hover">
               <thead class="bg-gray">
                  <tr>
                     <th width="50">S.NO</th>
                     <th>Ticket ID</th>
                     <th>Customer Name</th>
                     <th>Initiated At</th>
                     
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=0;
                     foreach($ticket as $bookings): ?>
                  <tr>
                     <td><?= $i+1 ?></td>
                     <td><?= $bookings['unique_id'] ?></td>
                     <td>
                        <?php if(!empty($bookings['id'])): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Support ID : </span>
                           <a href="#" class="text-dark text-hover-primary"><?= $bookings['id']; ?> </a>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($bookings['customer_first_name'])): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Customer Name : </span>
                           <a href="#" class="text-dark text-hover-primary"><?= $bookings['customer_first_name']; ?> <?= $bookings['customer_last_name']; ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($bookings['customer_mobile'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Mobile Number : </span>
                           <span class="text-dark"><?= $bookings['customer_mobile']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($bookings['customer_email'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Email : </span>
                           <span class="text-dark"><?= $bookings['customer_email']; ?></span>
                        </div>
                        <?php endif; ?>       
                     </td>
                     <!--<td>subject</td>-->
                     <td><?= date('d M Y h:i A', strtotime($bookings['created_at'])); ?></td>
                  
                     <td>
                        <?php if($bookings['status'] == "0"): ?> 
                        <button type="button" class="btn btn-danger"data-toggle="modal" data-target="#ticket_<?= $bookings['id']; ?>">Pending</button>
                        <?php endif; ?>
                        <?php if($bookings['status'] == "1"): ?> 
                        <button type="button" class="btn btn-primary"data-toggle="modal" data-target="#ticket_<?= $bookings['id']; ?>">Processing</button>
                        <?php endif; ?>
                        <?php if($bookings['status'] == "2"): ?> 
                        <button type="button" class="btn btn-success">Closed</button>
                        <?php endif; ?>  
                     </td>
                     <td>
                        <!--<a href="<?php echo site_url("admin/HelpSupport/details/".$bookings['booking_id']); ?>" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i>View</a>-->
                        <a href="<?php echo site_url("admin/HelpSupport/repply/".$bookings['id']); ?>" class="btn btn-info btn-xs"><i class="fa fa-envelope"></i>Repply</a>
                     </td>
                  </tr>
                  <div class="modal static" id="ticket_<?= $bookings['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Ticket Status</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <form method="POST" action="<?php echo base_url()."admin/HelpSupport/update_ticket_status"; ?>">
                                 <input type="hidden" value="<?= $bookings['id'] ?>" name="support_id" />
                                 <label>Ticket Status</label>
                                 <select class="form-control mb-2" name="status">
                                    <option value="0">Pending</option>
                                    <option value="1">Processing</option>
                                    <option value="2">Closed</option>
                                 </select>
                                 <input type="submit" name="submit" class="btn btn-success" value="Update"/>
                              </form>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
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