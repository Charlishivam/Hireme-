<!-- vehicle Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content">
      <!-- For Messages -->
      <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Slider List</h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/slider/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Slider</a>
            </div>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th width="50">SN</th>
                     <th>Slider Name</th>
                     <th>Slider Type</th>
                     <th>Slider Image/Video</th>
                     <th>Slider Status </th>
                     <th width="100">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($records as $idx => $record): ?>
                  <tr>
                     <td><?= $idx + 1 ?></td>
                     <td><?= $record['slider_name']; ?></td>
                     <td>
                        <?php if($record['slider_type'] == 0) { ?>
                        <a href="" class="btn btn-success btn-xs mr5" >
                        Images
                        </a>     
                        <?php } ?>
                        <?php if($record['slider_type'] == 1) { ?>
                        <a href="" class="btn btn-primary btn-xs mr5" >
                        Video
                        </a>     
                        <?php } ?>
                     </td>
                     <td>
                        <?php if($record['slider_type'] == 0) { ?>
                        <?php if(empty($record['slider_url'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <img src="<?= base_url($record['slider_url'] ); ?>" width="100px" height="auto" />
                        <?php  }  ?>
                        <?php } ?>
                        <?php if($record['slider_type'] == 1) { ?>
                        <?php if(empty($record['slider_url'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <video width="200"controls>
                           <source src="<?= base_url($record['slider_url'] ); ?>" type="video/mp4">
                           <source src="movie.ogg" type="video/ogg">
                           Your browser does not support the video tag.
                        </video>
                        <?php  }  ?>
                        <?php } ?>
                     </td>
                     <td><a href="<?php echo site_url("admin/slider/slider_status/".$record['slider_id'] . "/" . $record['slider_status']);?>" class="badge <?php if($record['slider_status'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['slider_status'] == '1'){ echo "Active";}else{ echo "Inactive";} ?></a>
                     </td>
                     <td>
                        <a href="<?php echo site_url("admin/slider/edit/".$record['slider_id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?php echo site_url("admin/slider/delete/".$record['slider_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

