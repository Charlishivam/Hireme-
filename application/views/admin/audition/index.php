<!-- Alert Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Audition List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/audition/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Audition</a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th width="50">SN</th>
                     <th>Season Deatils</th>
                     <th>Audition Details</th>
                     <th>Audition Image</th>
                     <th>Audition Status</th>
                     <th width="100">Action</th>
                  </tr>
               </thead>

               <tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td>
                        <?php if(!empty($record['season_name'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Season Name : </span>
                           <span class="text-dark"><?= $record['season_name']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['season_amount'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Season Amount : </span>
                           <span class="text-dark"><?= $record['season_amount']; ?></span>
                        </div>
                        <?php endif; ?>
                         <?php if(!empty($record['season_number'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Season Number : </span>
                           <span class="text-dark"><?= $record['season_number']; ?></span>
                        </div>
                        <?php endif; ?> 
                     </td>
                     <td>
                        <?php if(!empty($record['audition_start_date'])): ?> 
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">Start Date : </span>
                           <span class="text-dark"><?= date('Y-M-d',strtotime($record['audition_start_date'])); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($record['audition_end_date'])): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <span class="font-weight-bold mr-2">End Date : </span>
                           <a href="#" class="text-dark text-hover-primary"><?= date('Y-M-d',strtotime($record['audition_end_date'])); ?> </a>
                        </div>
                        <?php endif; ?>
                        
                     <td>
                        <?php  
                           if(empty($record['audition_image'])){  ?>
                        <img src="<?= base_url('uploads/images/avtar.png'); ?>" width="100px" height="auto" />
                     </td>
                     <?php }else{
                        ?> 
                     <img src="<?= base_url($record['audition_image']); ?>" width="100px" height="auto" />
                     <?php  }  ?>
                     </td>

                     <!-- <td>
                        <?php if(!empty($record['participant_round_status'] == '1')): ?>
                        <a href="javascript:;" class="badge badge-success">Qualified</a>
                        <?php endif; ?>
                        <?php if(!empty($record['participant_round_status'] == '0')): ?>
                        <a href="<?php echo site_url("admin/participant/participant_round_status/".$record['participant_id'] . "/" . $record['participant_round_status']);?>" class="badge badge-danger">Pending</a>
                        <?php endif; ?>
                     </td>
 -->

                    
                     <td><a href="<?php echo site_url("admin/audition/audition_status/".$record['audition_id'] . "/" . $record['audition_status']);?>" class="badge <?php if($record['audition_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['audition_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a href="<?php echo site_url("admin/audition/edit/".$record['audition_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?php echo site_url("admin/audition/delete/".$record['audition_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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