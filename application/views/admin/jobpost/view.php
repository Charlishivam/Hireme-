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
<?php $skill=json_decode($single['jobpost_skill']); ?>

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
                        <img src="<?= base_url('uploads/images/avtar.png' ); ?>" width="100px" height="auto" />
                     </div>
                  </div>
                  <!--begin: Info-->
                  <div class="flex-grow-1">
                     <!--begin::Title-->
                     <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                           <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">Job Post :<?php echo isset($single['jobpost_title'])?$single['jobpost_title']:''; ?></a>
                           <a href="#">
                           <i class="flaticon2-correct text-success font-size-h5"></i>
                           </a>
                        </div>
                     </div>
                     <!--end::Title-->
                     <!--begin::Content-->
                     <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                           <div class="d-flex flex-wrap mb-4">
                              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Category Name : <?php echo isset($single['category_name'])?$single['category_name']:''; ?></a>

                              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Subcategory Name : <?php echo isset($single['subcategory_name'])?$single['subcategory_name']:''; ?></a>
                              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Summary : <?php echo isset($single['jobpost_summary'])?$single['jobpost_summary']:''; ?></a>

                              
                              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Price : <?php echo isset($single['jobpost_price_to'])?$single['jobpost_price_from']:''; ?></a>
                              
                             <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Praposal : <?php echo isset($single['jobpost_praposal'])?$single['jobpost_praposal']:''; ?></a>

                              

                              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Till Date : <?= date('Y-M-d',strtotime($single['jobpost_till_date'])); ?></a></br>
                              <a href="#" style="margin-left: 63px;" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                              <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Skill : <?php foreach ($skill as $key => $value): ?>
                                 <?php $skill_name = $this->Jobpost_model->get_skill_name_records($value); ?>

                                 <a href="#" class="badge badge-info" >
                                    <?= $skill_name->skill_name; ?>
                                 </a> &nbsp;  
                                 
                              <?php endforeach ?></a>


                              
                           </div>






                           <span class="font-weight-bold text-dark-50"><?php echo isset($single['jobpost_description'])?$single['jobpost_description']:''; ?></span>
                           
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
              
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-custom">
                  <div class="card-header card-header-tabs-line">
                     <div class="card-title">
                        <h3 class="card-label">Post History</h3>
                     </div>
                     <div class="card-toolbar">
                        <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist" id="rowTab">
                           <li class="nav-item fade show active">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_18">Bidding List</a>
                           </li>

                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_19">Review List</a>
                           </li>
                          
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_3_18" role="tabpanel">
                           <div class="d-inline-block">
                              <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Bidding List</h3>
                           </div>
                           <div class="d-inline-block float-right">
                              <a style="margin-left:5px;" href="<?= base_url('admin/jobpost/bidding_add/'.$single['jobpost_id']); ?>"
                                 class="btn btn-success"><i class="fa fa-plus"></i> Add New Bidding </a>
                           </div>
                           <table class="table table-bordered table-hover table-checkable" id="example5">
                              <thead>
                                 <tr>
                                    <th width="50">SN</th>
                                    <th>Customer Name</th>
                                    <th>Bidding Amount</th>
                                    <th>Bidding Comment</th>
                                    <th>Shortlist Status</th>
                                    <th>Bidding Status</th>
                                    <th width="100">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($bidding_records as $idx => $record): ?>
                                    <tr>
                                       <td><?= $idx + 1 ?></td>
                                       <td><?= $record['customer_full_name']; ?></td>
                                       <td><?= $record['bidding_amount']; ?></td>
                                       <td><?= $record['bidding_comment']; ?></td>

                                       <td><a href="javascript:;" class="badge <?php if($record['bidding_shortlist'] == '1'){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['bidding_shortlist'] == '1'){ echo "Yes";}else{ echo "No";} ?></a>
                                       </td>
                                       
                       
                                       <td><a href="<?php echo site_url("admin/jobpost/bidding_status/".$record['bidding_id'] . "/" . $record['bidding_status']);?>" class="badge <?php if($record['bidding_status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['bidding_status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a>
                                       </td>
                                       <td>
                                          <a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/bidding_edit/".$record['bidding_id']); ?>" class="btn btn-warning btn-xs mr5" >
                                                <i class="fa fa-edit"></i>
                                             </a>
                                          <a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/bidding_delete/".$record['bidding_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                                       
                                       </td>
                                    </tr>
                                 <?php endforeach; ?>
                              </tbody>
                             
                           </table>
                        </div>

                        <div class="tab-pane" id="kt_tab_pane_3_19" role="tabpanel">
                           <div class="d-inline-block">
                              <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Review List</h3>
                           </div>
                           <div class="d-inline-block float-right">
                              <a style="margin-left:5px;" href="<?= base_url('admin/jobpost/review_add/'.$single['jobpost_id']); ?>"
                                 class="btn btn-success"><i class="fa fa-plus"></i> Add New Review </a>
                           </div>
                           <table class="table table-bordered table-hover table-checkable" id="example5">
                              <thead>
                                 <tr>
                                    <th width="50">SN</th>
                                    <th>Customer Name</th>
                                    <th>Review Rating</th>
                                    <th>Review Comment</th>
                                    <th>Review Status</th>
                                    <th width="100">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($review_records as $idx => $record): ?>
                                    <tr>
                                       <td><?= $idx + 1 ?></td>
                                       <td><?= $record['customer_full_name']; ?></td>
                                       <td><?= $record['review_rating']; ?></td>
                                       <td><?= $record['review_comment']; ?></td>

                                       
                       
                                       <td><a href="<?php echo site_url("admin/jobpost/review_status/".$record['review_id'] . "/" . $record['review_status']);?>" class="badge <?php if($record['review_status'] == 1){ echo "badge-success";}else{ echo "badge-info";} ?>"><?php if($record['review_status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></a>
                                       </td>
                                       <td>
                                          <a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/review_edit/".$record['review_id']); ?>" class="btn btn-warning btn-xs mr5" >
                                                <i class="fa fa-edit"></i>
                                             </a>
                                          <a style="margin-top: 5px;" href="<?php echo site_url("admin/jobpost/review_delete/".$record['review_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                                       
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
