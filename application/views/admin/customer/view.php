<link rel="stylesheet" type="text/css" href="<?= base_url('assets/user-view/css/hierarchy-view.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/user-view/css/main.css') ?>">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">

<style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
 </style>
<style type="text/css">
   @media (min-width: 992px){
   .content {
   padding: 0px 0 !important;
   }
   }
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid " id="kt_content" >
   <!-- For Messages -->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">
         <!--begin::Card-->
         <div class="card card-custom gutter-b">
            <div class="card-body">
               <!--begin::Top-->
               <div class="d-flex">
                  <!--begin::Pic-->
                  <div class="flex-shrink-0 mr-7">
                     <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                        <?php if(empty($single['customer_image'])){ ?>
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                        <?php  }else{  ?>
                        <img src="<?= base_url($single['customer_image'] ); ?>" width="100px" height="auto" alt="image" />
                        <?php  }  ?>
                     </div>
                  </div>
                  <!--begin: Info-->
                  <div class="flex-grow-1">
                     <!--begin::Title-->
                     <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                           <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?php echo isset($single['customer_full_name'])?$single['customer_full_name']:''; ?></a>
                           <a href="#">
                           <i class="flaticon2-correct text-success font-size-h5"></i>
                           </a>
                        </div>
                     </div>
                     <!--end::Title-->
                     <!--begin::Content-->
                     <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                           <table style="font-size: 10px;">
                              <thead>
                                 <tr>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-new-email mr-2 font-size-lg"></i>Email :<?php echo isset($single['customer_email'])?$single['customer_email']:''; ?></a>
                                    </th>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i> Mobile Number : <?php echo isset($single['customer_mobile'])?$single['customer_mobile']:''; ?></a>
                                    </th>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i> Gender : <span class="font-weight-bolder mb-2"><?php if($single['customer_gender'] == 0) { ?>
                                       <span class="badge badge-pill badge-warning mb-1">Male</span>
                                       <?php } ?>
                                       <span class="font-weight-bolder mb-2"><?php if($single['customer_gender'] == 1) { ?>
                                       <span class="badge badge-pill badge-danger mb-1">Female</span> 
                                       <?php } ?></a>
                                    </th>
                                 </tr>
                                 <tr>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                       <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Address 1: <?php echo isset($single['customer_address1'])?substr($single['customer_address1'], 0, 50):''; ?></a>
                                    </th>
                                    <th scope="col"> <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Address 2 : <?php echo isset($single['customer_address2'])?$single['customer_address2']:''; ?></a>
                                    </th>
                                    <th scope="col"> <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Pincode : <?php echo isset($single['customer_pincode'])?$single['customer_pincode']:''; ?></a>
                                    </th>
                                 </tr>
                                                                  <tr>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                       <i class="flaticon2-placeholder mr-2 font-size-lg"></i>State : <?php echo isset($single['customer_state'])?$single['customer_state']:''; ?></a>
                                    </th>
                                    <th scope="col"> <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>City : <?php echo isset($single['customer_city'])?$single['customer_city']:''; ?></a>
                                    </th>
                                    <th scope="col"> <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                       <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Flat Number : <?php echo isset($single['customer_flatno'])?$single['customer_flatno']:''; ?></a>
                                    </th>
                                 </tr>
                                 <tr>
                                    <th scope="col"><a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                       <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Dob : <?php echo isset($single['customer_dob'])?$single['customer_dob']:''; ?></a>
                                    </th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                        <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                        </div>
                     </div>
                     <!--end::Content-->
                  </div>
                  <!--end::Info-->
               </div>
               <!--end::Top-->
               <!--begin::Separator-->
               <div class="separator separator-solid my-7"></div>
               <!--end::Separator-->
               <!--begin::Bottom-->
               <div class="d-flex align-items-center flex-wrap">
                  <!--begin: Item-->
                  <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                     <span class="mr-4">
                     <i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                     </span>
                     <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">WALLETS</span>
                        <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold">₹ </span>
                        </span>
                     </div>
                  </div>
               </div>
               <!--end::Bottom-->
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-custom">
                  <div class="card-header card-header-tabs-line">
                     <div class="card-title">
                        <h3 class="card-label">Profile History</h3>
                     </div>
                     <div class="card-toolbar">
                        <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist" id="rowTab">
                           <li class="nav-item fade show active">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_18">Service List</a>
                           </li>
                          
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_3_18" role="tabpanel">
                           <div class="d-inline-block">
                              <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Service List</h3>
                           </div>
                           <div class="d-inline-block float-right">
                              <a style="margin-left:5px;" href="<?= base_url('admin/customer/service_add/'.$single['customer_id']); ?>"
                                 class="btn btn-success"><i class="fa fa-plus"></i> Add New Service </a>
                           </div>
                           <table class="table table-bordered table-hover table-checkable" id="example5">
                              <thead>
                                 <tr>
                                    <th width="50">SN</th>
                                    <th>Sevice Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($service_records as $idx => $record): ?>
                                 <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td>
                                       <?php if(!empty($record['customer_service_name'])): ?> 
                                       <div class="d-flex align-items-center justify-content-between mb-2">
                                          <span class="font-weight-bold mr-2">Service Name : </span>
                                          <span class="text-dark"><?= $record['customer_service_name']; ?></span>
                                       </div>
                                       <?php endif; ?>
                                    </td>
                                    <td>
                                       <?php if(!empty($record['customer_service_price'])): ?> 
                                       <div class="d-flex align-items-center justify-content-between mb-2">
                                          <span class="font-weight-bold mr-2">Service Price : </span>
                                          <span class="text-dark"><?= $record['customer_service_price']; ?></span>
                                       </div>
                                       <?php endif; ?>
                                    </td>
                                    <td>
                                       <?php if(empty($record['customer_service_image'])){ ?>
                                       <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                                       <?php  }else{  ?>
                                       <img src="<?= base_url($record['customer_service_image']); ?>" width="100px" height="auto" />
                                       <?php  }  ?>
                                    </td>
                                    <td><?= date('Y-M-d',strtotime($record['customer_service_create_at'])); ?></a>
                                    </td>
                                    <td>
                                       <span class="font-weight-bolder mb-2"><?php if($record['customer_service_status'] == 0) { ?>
                                       <span class="badge badge-pill badge-warning mb-1">Inactivate</span>
                                       <?php } ?>
                                       <span class="font-weight-bolder mb-2"><?php if($record['customer_service_status'] == 1) { ?>
                                       <span class="badge badge-pill badge-danger mb-1">Activate</span> 
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <a style="margin-top: 5px;" href="<?php echo site_url("admin/customer/service_edit/".$record['customer_service_id']); ?>" class="btn btn-warning btn-xs mr5" >
                                       <i class="fa fa-edit"></i>
                                       </a>
                                       <a style="margin-top: 5px;" href="<?php echo site_url("admin/customer/service_delete/".$record['customer_service_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <?php endforeach; ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--end::Card-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
<script>
   // tab
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
     localStorage.setItem('activeTab', $(e.target).attr('href'));
   });
   var activeTab = localStorage.getItem('activeTab');
   if (activeTab) {
    $('#rowTab a[href="' + activeTab + '"]').tab('show');
   }
</script>
<script>
   function readURL(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
       
       reader.onload = function(e) {
         $('#blah').attr('src', e.target.result);
       }
       
       reader.readAsDataURL(input.files[0]); // convert to base64 string
     }
   }
   
   $("#imgInp").change(function() {
     readURL(this);
   });
</script>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
<script>
   $(function () {
     $("#example5").DataTable();
   })
</script>

<script>
   $(function () {
     $("#example14").DataTable();
   })
</script>

<script>
   $(function () {
     $("#example15").DataTable();
   })
</script>

<script>
   $(function () {
     $("#example16").DataTable();
   })
</script>
<script>
   function poa_image(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
       
       reader.onload = function(e) {
         $('#blahpoa_image').attr('src', e.target.result);
       }
       
       reader.readAsDataURL(input.files[0]); // convert to base64 string
     }
   }
   
   $("#imgpoa_image").change(function() {
     poa_image(this);
   });
</script>
