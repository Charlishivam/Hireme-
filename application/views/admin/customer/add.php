<?php $this->load->view('admin/includes/_messages.php') ?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card card-default">
         <div class="card-header">
            <div class="d-inline-block">
               <h3 class="card-title"> <i class="fa fa-plus"></i>
                  Add New Customer
               </h3>
            </div>
            <div class="d-inline-block float-right">
               <a href="<?= base_url('admin/customer'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Customer List</a>
            </div>
         </div>
         <div class="card-body">
            <form method="POST" action="<?= base_url()."admin/customer/add" ?>" enctype="multipart/form-data">
               <div class="card-body">
                  <!--<div class="form-group row">-->
                  <!--   <label class="col-lg-2 col-form-label text-lg-right">Customer Type:</label>-->
                  <!--   <div class="col-lg-10">-->
                  <!--      <?= form_dropdown('customer_type',[''=>'Select Customer Type','0'=>'Normal User','1'=>'Sirvice Provider'],set_value('customer_type'),'class="form-control" id="kt_select2_1"'); ?>-->
                  <!--      <?php echo form_error('customer_type');?>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="separator separator-dashed my-10"></div>-->

                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span> First Name:</label>
                     <div class="col-lg-4">
                        <input type="text" name="customer_first_name" class="form-control" required="" placeholder="First name" value="<?= set_value('customer_first_name') ?>" />
                        <span class="form-text text-muted">Please enter your first name</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red"  style="color:red">*</span> Last Name:</label>
                     <div class="col-lg-4">
                        <input type="text" class="form-control" name="customer_last_name" placeholder="Last name" required="" value="<?= set_value('customer_last_name') ?>"/>
                        <span class="form-text text-muted">Please enter your last name</span>
                     </div>
                     
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Contact:</label>
                     <div class="col-lg-4">
                        <input type="text" class="form-control" name="customer_mobile" placeholder="Enter contact number" required="" value="<?= set_value('customer_mobile') ?>"/>
                        <span class="form-text text-muted">Please enter your contact</span>
                     </div>
                     
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Email:</label>
                     <div class="col-lg-4">
                        <input type="email" class="form-control" name="customer_email" placeholder="Email" required="" value="<?= set_value('customer_email') ?>"/>
                        <span class="form-text text-muted">Please enter your email</span>
                     </div>
                  </div>


                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row mt-3">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Username:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text">
                              <i class="la la-user"></i>
                              </span>
                           </div>
                           <input type="text" class="form-control" name="customer_username"  placeholder="" required="" value="<?= set_value('customer_username') ?>" />
                        </div>
                        <span class="form-text text-muted">Please enter your username</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Password:</label>
                     <div class="col-lg-4">
                        <input type="password" class="form-control" name="customer_password" placeholder="Password" required="" value="<?= set_value('customer_password') ?>"/>
                        <span class="form-text text-muted">Please enter your password</span>
                     </div>
                     
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right"><span class="text-red" style="color:red">*</span>Address-1:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" class="form-control" name="customer_address1" id="address" placeholder="Enter your 1st address" required="" value="<?= set_value('customer_address1') ?>"/>
                           <input type="hidden" id="lat" name="customer_lat" value="<?= set_value('customer_lat') ?>">
                           <input type="hidden" id="lng" name="customer_long" value="<?= set_value('customer_long') ?>">
                           <input type="hidden" id="zipcode" name="customer_pincode" value="<?= set_value('customer_pincode') ?>">
                           <div class="input-group-append">
                              <span class="input-group-text">
                              <i class="la la-map-marker"></i>
                              </span>
                           </div>
                           <?php echo form_error('address');?>
                        </div>
                        <span class="form-text text-muted">Please enter your address-1</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right">Address-2:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" class="form-control" name="customer_address2" placeholder="Enter your 2nd address" value="<?= set_value('customer_address2') ?>"/>
                           <div class="input-group-append">
                              <span class="input-group-text">
                              <i class="la la-map-marker"></i>
                              </span>
                           </div>
                        </div>
                        <span class="form-text text-muted">Please enter your address-2</span>
                     </div>
                     
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">State:</label>
                     <div class="col-lg-4">
                        <input type="text" class="form-control" name="customer_state" placeholder="Enter State Name" value="<?= set_value('customer_state') ?>" />
                        <span class="form-text text-muted">Please enter your state</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right">City:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" class="form-control" name="customer_city" id="city" placeholder="Enter your City Name" value="<?= set_value('customer_city') ?>" />
                           <?php echo form_error('city');?>
                        </div>
                        <span class="form-text text-muted">Please enter your city</span>
                     </div>
                  </div>

                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     
                     <label class="col-lg-2 col-form-label text-lg-right">Flat/House/Office No:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" class="form-control" name="customer_flatno" placeholder="Enter Flat/House/Office No" value="<?= set_value('customer_flatno') ?>" />
                        </div>
                        <span class="form-text text-muted">Please enter your flat/house/office no</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right">Landmark No:</label>
                     <div class="col-lg-4">
                        <input type="text" class="form-control" name="customer_landmark" placeholder="Enter Landmark Number" value="<?= set_value('customer_landmark') ?>" />
                        <span class="form-text text-muted">Please enter landmark number</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">DOB:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <input type="text" name="customer_dob" class="form-control"  id="kt_datepicker_3" placeholder="DOB" value="<?= set_value('customer_dob') ?>" />
                           <?php echo form_error('customer_dob');?>
                        </div>
                        <span class="form-text text-muted">Please enter your dob</span>
                     </div>
                     <label class="col-lg-2 col-form-label text-lg-right">Gender:</label>
                     <div class="col-lg-4">
                        <div class="radio-inline">
                           <label class="radio radio-solid">
                           <input type="radio" name="customer_gender" checked="checked" value="0" />
                           <span></span>Male</label>
                           <label class="radio radio-solid">
                           <input type="radio" name="customer_gender" value="1" />
                           <span></span>Female</label>
                        </div>
                        <span class="form-text text-muted">Please select gender</span>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Work Experience:</label>
                     <div class="col-lg-10">
                        <textarea type="text" class="form-control"  name="customer_work_experience"></textarea>
                        <span class="form-text text-muted">Please Enter your total work experience</span>
                        <?php echo form_error('customer_work_experience');?>
                     </div>
                  </div>
                  
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Description:</label>
                     <div class="col-lg-10">
                        <textarea type="text" class="form-control"  name="customer_description"></textarea>
                        <span class="form-text text-muted">Please Enter your description</span>
                        <?php echo form_error('testimonial_content');?>
                     </div>
                  </div>
                  <div class="separator separator-dashed my-10"></div>
                  <div class="form-group row">
                     <label class="col-lg-2 col-form-label text-lg-right">Image:</label>
                     <div class="col-lg-4">
                        <div class="input-group">
                           <div class="image-input image-input-outline" id="kt_image_1">
                              <div class="image-input-wrapper" style="background-image: url(<?= base_url('uploads/images/avtar.png'); ?>)"></div>
                              
                              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input type="file" name="customer_image" value="<?= set_value('customer_image') ?>" accept=".png, .jpg, .jpeg" />
                              <input type="hidden" name="profile_avatar_remove" value="<?= set_value('customer_image') ?>" />
                              </label>
                              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                              </span>
                           </div>
                            </div>
                           <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>

                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                           <button type="submit" class="btn btn-primary mr-2">Submit</button>
                           <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>
<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyRY9zVqzDFo8Qc2puq8T6gYiTARTdnNo&amp;libraries=places" type="text/javascript"></script>

<script type="text/javascript">
    $('#kt_select2_1').select2({
         placeholder: "Select a Customer Type"
        });
</script>
<script type="text/javascript">
   function initialize_auto_address() {
   var pickuplocation = document.getElementById('address');
   var autocomplete = new google.maps.places.Autocomplete(address);
   google.maps.event.addListener(autocomplete, 'place_changed', function () {
   var place = autocomplete.getPlace();
   document.getElementById('lat').value = place.geometry.location.lat();
   document.getElementById('lng').value = place.geometry.location.lng();
   var geocoder = new google.maps.Geocoder();
   var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
   geocoder.geocode({'latLng': latlng}, function(results, status)
      {
        if (status == google.maps.GeocoderStatus.OK)
        {
          if (results[0]) {
            for (var i = 0; i < results[0].address_components.length; i++) {
                var types = results[0].address_components[i].types;
                //console.log(types);
                for (var typeIdx = 0; typeIdx < types.length; typeIdx++) {
                    if (types[typeIdx] == 'postal_code') {
                      document.getElementById('zipcode').value = results[0].address_components[i].short_name;
                      console.log(results[0].address_components[i].short_name);
                    }
                    if(types[typeIdx] == 'locality')
                    {
                        console.log(results[0].address_components[i].short_name);
                    //document.getElementById('edit_saburb').value = results[0].address_components[i].short_name;
                    }
                    if(types[typeIdx] == 'country')
                    {
                        console.log(results[0].address_components[i].short_name);
                    //document.getElementById('edit_saburb').value = results[0].address_components[i].short_name;
                    }
   
                     if (types[typeIdx] == "administrative_area_level_1") {
                        //this is the object you are looking for State
                      console.log(results[0].address_components[i].short_name);
                    }
   
                    /*if (types[typeIdx] == "country") {
                        console.log(results[0].address_components[i].short_name);
                        ..country = results[j].address_components[i];
                    }*/
                }
   
            }
          }else{
            console.log("No results found");
          } 
        }else{
          alert("Geocoder failed due to: " + status);
        }
      });
    });
   }
   google.maps.event.addDomListener(window, 'load', initialize_auto_address);
</script>