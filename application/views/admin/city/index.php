<!-- Alert Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; City List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/city/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New City</a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th width="50">SN</th>
                     <th>City Name</th>
                     <th>State Name</th>
                     <th>State Status</th>
                     <th width="100">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td>
                        <?php if(!empty($record['city_name'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">City Name : </span>
                           <span class="text-dark"><?= $record['city_name']; ?></span>
                        </div>
                        <?php endif; ?>
                       
                     </td>
                     <td>
                       
                        <?php if(!empty($record['state_name'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">State Name : </span>
                           <span class="text-dark"><?= $record['state_name']; ?></span>
                        </div>
                        <?php endif; ?>
                     </td>
                     <td><a href="<?php echo site_url("admin/city/city_status/".$record['city_id'] . "/" . $record['city_status']);?>" class="badge <?php if($record['city_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['city_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a href="<?php echo site_url("admin/city/edit/".$record['city_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?php echo site_url("admin/city/delete/".$record['city_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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