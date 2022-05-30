<!-- vehicle Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Banner List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/banner/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Banner</a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th width="50">SN</th>
                     <th>Banner Name</th>
                     <th>Banner Url</th>
                     <th>Banner Type</th>
                     <th>Banner Image</th>
                     <th>Banner Status </th>
                     <th width="100">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td><?= $record['banner_name']; ?></td>
                     <td><?= $record['banner_text_url']; ?></td>
                     <td>
                        <?php if($record['banner_type'] == 0) { ?>
                        <a href="javascript:;" class="btn btn-success btn-xs mr5" >
                        Banner
                        </a>     
                        <?php } ?>
                        <?php if($record['banner_type'] == 1) { ?>
                        <a href="javascript:;" class="btn btn-primary btn-xs mr5" >
                        Advertisement
                        </a>     
                        <?php } ?>
                     </td>
                     <td>
                      
                        <?php if(empty($record['banner_url'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <img src="<?= base_url($record['banner_url'] ); ?>" width="100px" height="auto" />
                        <?php  }  ?>
                      
                        
                     </td>
                     <td><a href="<?php echo site_url("admin/banner/banner_status/".$record['banner_id'] . "/" . $record['banner_status']);?>" class="badge <?php if($record['banner_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['banner_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a href="<?php echo site_url("admin/banner/edit/".$record['banner_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?php echo site_url("admin/banner/delete/".$record['banner_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>
   <!-- /.vehicle -->
</div>

