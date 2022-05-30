<!-- Alert Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Customer List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/customer/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New customer</a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th width="50">SN</th>
                     <th>Customer Details</th>
                     <th>Adddress Details</th>
                     <th>Customer Image</th>
                     <th>Customer Status</th>
                     <th width="100">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td>
                        <?php if(!empty($record['customer_username'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Username : </span>
                           <span class="text-dark"><?= $record['customer_username']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['customer_first_name'])): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">customer Name : </span>
                           <a href="#" class="text-dark text-hover-primary"><?= $record['customer_first_name']; ?> <?= $record['customer_last_name']; ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['customer_mobile'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Mobile Number : </span>
                           <span class="text-dark"><?= $record['customer_mobile']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['customer_email'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Email : </span>
                           <span class="text-dark"><?= $record['customer_email']; ?></span>
                        </div>
                        <?php endif; ?>       
                     </td>
                     <td>
                        <?php if(!empty($record['customer_address2'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Address : </span>
                           <span class="text-dark"><?= $record['customer_address2']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['customer_state'])): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">State : </span>
                           <a href="#" class="text-dark text-hover-primary"><?= $record['customer_state']; ?> <?= $record['customer_last_name']; ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['customer_city'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">City : </span>
                           <span class="text-dark"><?= $record['customer_city']; ?></span>
                        </div>
                        <?php endif; ?>
                     <td>
                        <?php  
                           if(empty($record['customer_image'])){  ?>
                        <img src="<?= base_url('uploads/images/avtar.png'); ?>" width="100px" height="auto" />
                     </td>
                     <?php }else{
                        ?> 
                        
                        
                     <img src="<?= base_url($record['customer_image']); ?>" width="100px" height="auto" />
                     <?php  }  ?>
                     </td>
                     <td><a href="<?php echo site_url("admin/customer/customer_status/".$record['customer_id'] . "/" . $record['customer_status']);?>" class="badge <?php if($record['customer_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['customer_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a style="margin-top: 5px;" href="<?php echo site_url("admin/customer/edit/".$record['customer_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a style="margin-top: 5px;" href="<?php echo site_url("admin/customer/delete/".$record['customer_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                        <a style="margin-top: 5px;" href="<?php echo site_url("admin/customer/view/".$record['customer_id']); ?>" class="btn btn-info btn-xs mr5" >
                        <i class="fa fa-eye"></i>
                        </a>


                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>
   <!-- /.Alert -->
</div>