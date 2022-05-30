 <!-- For Messages -->
<?php $this->load->view('admin/includes/_messages.php') ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
                        <?php  
                        if(isset($single->image)){  ?>

                          <img src="<?= base_url('uploads/images/avtar.png'); ?>" width="100px" height="auto" />
                        <?php }else{
                        ?>  
                        <img src="<?= base_url('uploads/user/'.$details['image']); ?>" width="100px" height="auto" />
                        
                        <?php  }  ?> 
                        </div>
                      </div>
                  <!--begin: Info-->
                  <div class="flex-grow-1">
                     <!--begin::Title-->
                     <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <!--begin::User-->
                        <div class="mr-3">
                           <!--begin::Name-->
                           <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?php echo isset($single->full_name)?$single->full_name:''; ?>
                           <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                           <!--end::Name-->


                           <!--begin::Content-->
                            <div class="d-flex flex-wrap justify-content-between mt-1">
                              <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                  <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                  <i class="flaticon2-new-email mr-2 font-size-lg"></i><?php echo isset($single->email)?$single->email:''; ?></a>
                                  <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                  <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i> Mobile Number : <?php echo isset($single->mobile)?$single->mobile:''; ?></a>
                                 

                                  <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                  <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Referral Code : <?php echo isset($single->referral_code)?$single->referral_code:''; ?></a>
                                </div>
                                
                              </div>
                              <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                              </div>
                            </div>
                            <!--end::Content-->
                           <!--begin::Contacts-->

                           <!--end::Contacts-->
                        </div>
                        <!--begin::User-->
                        <!--begin::Actions-->
                        <!-- <div class="my-lg-0 my-1">
                           <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Ask</a>
                           <a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Hire</a>
                           </div> -->
                        <!--end::Actions-->
                     </div>
                     <!--end::Title-->
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
                        <span class="text-dark-50 font-weight-bold">₹ <?php if(isset($wallet_sum)){
                             echo $wallet_sum;
                           }else{
                              echo "0";
                           }?></span>
                        </span>
                     </div>
                  </div>
                  <!--end: Item-->
                 
            </div>
         </div>
       <?php
              $id=0;
              if(isset($single->customer_id)) {
                $id=$single->customer_id;
              }
          ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-custom">
                  <div class="card-header card-header-tabs-line">
                     <div class="card-title">
                        <h3 class="card-label"><?php ?> History</h3>
                     </div>
                     <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                           <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_2">WALLETS</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_2">DOCUMENTS DETAILS</a>
                           </li>

                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_3">BOOKING COMPLETE</a>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_2">BOOKING CANCEL</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     
                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_2" role="tabpanel">
                           
                             <!--begin: Datatable-->
                             <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                                <thead>
                                   <tr>
                                      <th width="50">ID</th>
                                      <th>Transaction Id </th>
                                      <th>Amount</th>
                                      <th>Transaction Type</th>
                                      <th>Status</th>
                            
                                      <th>Date Time</th>
                                   </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;foreach($wallet as $w):
            
                                    ?>
                                    <tr>
                                      <td><?= $w['id']; ?></td>
                                      <td><?php if(isset($w['transaction_id'])) echo $w['transaction_id'] ?></td>
                                      <td><?php if(isset($w['amount'])) echo $w['amount'] ?></td>
                                      <td>
                                        <?php if($w['transaction_type'] == 1) { ?>
                                        <span class="badge badge-pill badge-success mb-1">CREDIT</span> 
                                       <?php } ?>
                                       <?php if($w['transaction_type'] == 2) { ?>
                                        <span class="badge badge-pill badge-danger mb-1">DEBIT</span>
                                      <?php } ?>
                                      </td>
                                       <td>
                                        <?php if($w['status'] == 1) { ?>
                                        <span class="badge badge-pill badge-success mb-1">SUCCESS</span> 
                                       <?php } ?>
                                       <?php if($w['status'] == 0) { ?>
                                        <span class="badge badge-pill badge-danger mb-1">Pending</span>
                                       <?php } ?>
                                       <?php if($w['status'] == 2) { ?>
                                        <span class="badge badge-pill badge-warning mb-1">CANCEL</span>
                                       <?php } ?>
                                      </td>
                                      <td><?php if(isset($w['date_time'])) echo $w['date_time'] ?>
                                        
                                      </td>
                                      
                                      
                                    </tr>
                                  <?php  $i++; endforeach; ?>
                               
                                </tbody>
                                <tfoot>
                                <tr>
                                      <th width="50">ID</th>
                                      <th>Transaction Id </th>
                                      <th>Amount</th>
                                      <th>Transaction Type</th>
                                      <th>Status</th>
                                      <th>Date Time</th>
                                   </tr>
                                </tfoot>
                             </table>
                             <!--end: Datatable-->
                             <div class="container mt-3 text-right">
                                  <button type="button" class="btn btn-primary" <?php if($id==0)echo 'disabled'; ?> data-toggle="modal" data-target="#transaction">Credit/Debit</button>
                              </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_2_2" role="tabpanel">
                             <!--begin: Datatable-->
                           <?php echo form_open_multipart(base_url('admin/users/docadd'), 'class="form-horizontal"');  ?> 
                           <input type="hidden" name="customer_id" <?php echo $single->customer_id ?>>
                           <div class="card-body">
                              <h3 class="font-size-lg text-dark font-weight-bold mb-6 ">Product Image</h3>
                              <div class="form-group row">
                                 <label class="col-xl-3 col-lg-3 col-form-label text-right">Aadhar Card Image (290x300)</label>
                                 <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_1" style="background-image: url(<?= base_url('assets') ?>/media/users/blank.png)">
                                       <div class="image-input-wrapper"></div>
                                       <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                       <i class="fa fa-pen icon-sm text-muted"></i>
                                       <input type="file" name="aadhar" accept=".png, .jpg, .jpeg" />
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                    </div>
                                    <span class="form-text text-muted">Please selcte aadhar card image</span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-xl-3 col-lg-3 col-form-label text-right">Pan Card Image (290x300)</label>
                                 <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_2" style="background-image: url(<?= base_url('assets') ?>/media/users/blank.png)">
                                       <div class="image-input-wrapper"></div>
                                       <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                       <i class="fa fa-pen icon-sm text-muted"></i>
                                       <input type="file" name="pancard" accept=".png, .jpg, .jpeg" />
                                       </label>
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                    </div>
                                    <span class="form-text text-muted">Please selcte Pan Card image</span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-xl-3 col-lg-3 col-form-label text-right">Driving Licence (290x300)</label>
                                 <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_3" style="background-image: url(<?= base_url('assets') ?>/media/users/blank.png)">
                                       <div class="image-input-wrapper"></div>
                                       <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                       <i class="fa fa-pen icon-sm text-muted"></i>
                                       <input type="file" name="driving" accept=".png, .jpg, .jpeg" />
                                       </label>
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                       <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                       <i class="ki ki-bold-close icon-xs text-muted"></i>
                                       </span>
                                    </div>
                                    <span class="form-text text-muted">Please selcte driving licence image</span>
                                 </div>
                              </div>
                           </div>

             
                          <div class="form-group">
                            <div class="col-md-12">
                              <input type="submit" name="submit" value="Add Documents" class="btn btn-primary pull-right">
                            </div>
                          </div>
                        <?php echo form_close( ); ?>
                        </div>
                        <!--end::Entry-->


                        <div class="tab-pane fade" id="kt_tab_pane_2_3" role="tabpanel">
                             <!--begin: Datatable-->
                             <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                                <thead>
                                   <tr>
                                      <th width="50">Booking Id</th>
                                      <th>Customer Name</th>
                                      <th>Total Amount</th>
                                      <th>Service Date/Time</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                   </tr>
                                </thead>
                                
                                <thead>
                                   <tr>
                                      <th width="50">Booking Id</th>
                                      <th>Customer Name</th>
                                      <th>Total Amount</th>
                                      <th>Service Date/Time</th>
                                      <th>Cancel Reason</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                   </tr>
                                </thead>
                             </table>
                             <!--end: Datatable-->
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_4_2" role="tabpanel">
                             <!--begin: Datatable-->
                             <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                                <thead>
                                   <tr>
                                      <th width="50">Booking Id</th>
                                      <th>Customer Name</th>
                                      <th>Total Amount</th>
                                      <th>Service Date/Time</th>
                                      <th>Cancel Reason</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                   </tr>
                                </thead>
                               
                                <thead>
                                   <tr>
                                      <th width="50">Booking Id</th>
                                      <th>Customer Name</th>
                                      <th>Total Amount</th>
                                      <th>Service Date/Time</th>
                                      <th>Cancel Reason</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                   </tr>
                                </thead>
                             </table>
                             <!--end: Datatable-->
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
<!--end::Content-->

<!-- Modal -->
<div class="modal static" id="transaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Credit/Debit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="POST" action="<?php echo base_url()."admin/Users/transaction"; ?>">
           <input type="hidden" value="<?= $id ?>" name="id" />
           <label>Amount</label>
           <input type="number" required class="form-control mb-3" name="amount"/>
           <label>Transaction Type</label>
           <select class="form-control mb-2" name="type">
               <option value="1">Credit</option>
               <option value="2">Debit</option>
           </select>
           <label>Received For</label>
           <input type="text" required class="form-control mb-3" name="received_for"/>
           <br>
           <input type="submit" name="submit" class="btn btn-success" value="Submit"/>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>

  
function readaadahr(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#aadhar_blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function drivinglicence(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#driving_blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function readpan(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#pan_blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#aadhar").change(function() {
  readaadahr(this);
});

$("#pan").change(function() {
  readpan(this);
});

$("#driving").change(function() {
  readpan(this);
});


</script>