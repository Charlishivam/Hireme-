<div class="container">
   <!--begin::Notice-->
   <!-- <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
      <div class="alert-icon alert-icon-top">
         <span class="svg-icon svg-icon-3x svg-icon-primary mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"></rect>
                  <path d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z" fill="#000000"></path>
                  <path d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z" fill="#000000" opacity="0.3"></path>
               </g>
            </svg>
         </span>
      </div>
      <div class="alert-text">
         <p>The layout builder is to assist your set and@ configure your preferred project layout specifications and preview it in real time. The@ configured layout options will be saved until you change or reset them. To use the layout builder, choose the layout options and click the 
            <code>Preview</code>button to preview the changes and click the 
            <code>Export</code>button to download the HTML template with its includable partials of this demo. In the downloaded folder the partials(header, footer, aside, topbar, etc) will be placed seperated from the base layout to allow you to integrate base layout into your application
         </p>
         <p>
            <span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>The downloaded version does not include the assets folder since the layout builder's main purpose is to help to generate the final HTML code without hassle.
         </p>
      </div> 
      </div> -->
   <!--end::Notice-->
   <?php $this->load->view('admin/includes/_messages.php');  ?>
   <!--begin::Card-->
   <div class="card card-custom">
      <!--begin::Header-->
      <div class="card-header card-header-tabs-line">
         <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist" id="rowTab">
            <li class="nav-item">
               <a class="nav-link active" data-toggle="tab" href="#kt_builder_themes">Document verification</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " data-toggle="tab" href="#kt_builder_page">Payment Method</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " data-toggle="tab" href="#kt_builder_google">Google Api</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " data-toggle="tab" href="#kt_builder_referral">Referral & Revenue</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " data-toggle="tab" href="#kt_builder_parking_commision">Parking Commission</a>
            </li>
         </ul>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body">
         <div class="tab-content pt-3">
            <!--begin::Tab Pane-->
            <div class="tab-pane active" id="kt_builder_themes">
               <?= form_open('admin/setting/update'); ?>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Api Url:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="url" name="doc_verification_api_url" value="<?= @$config['doc_verification_api_url'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Document verification Api Url (eg.https://sandbox.aadhaarkyc.io/api/v1)</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Api Token:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="doc_verification_token" value="<?= @$config['doc_verification_token'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Api Token</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Document Verification:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="doc_verification_enable" value="0">
                     <input type="checkbox" name="doc_verification_enable" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['doc_verification_enable'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable document verification</div>
                  </div>
               </div>
               <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section one by one Document verification enable and disable online in application</div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Aadhaar Verification:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="aadhaar_verification_enable" value="0">
                     <input type="checkbox" name="aadhaar_verification_enable" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['aadhaar_verification_enable'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable Aadhaar verification</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Pan Verification:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="pan_verification_enable" value="0">
                     <input type="checkbox" name="pan_verification_enable" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['pan_verification_enable'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable Pan verification</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Rc Verification:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="rc_verification_enable" value="0">
                     <input type="checkbox" name="rc_verification_enable" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['rc_verification_enable'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable Rc verification</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">DL Verification:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="dl_verification_enable" value="0">
                     <input type="checkbox" name="dl_verification_enable" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['dl_verification_enable'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable DL verification</div>
                  </div>
               </div>
               <!--begin::Footer-->
               <div class="card-footer">
                  <div class="row">
                     <div class="col-lg-3"></div>
                     <div class="col-lg-9">
                        <button type="submit" name="verification_form" class="btn btn-primary font-weight-bold mr-2" value="true">Save</button>
                     </div>
                  </div>
               </div>
               <!--end::Form-->
               <?= form_close() ?>
            </div>
            <!--end::Tab Pane-->
            <!--begin::Tab Pane-->
            <div class="tab-pane" id="kt_builder_page">
               <?= form_open('admin/setting/update'); ?>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Razorpay Key:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="razorpay_key" value="<?= @$config['razorpay_key'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Razorpay Key (eg.rzp_test_NZBF6XILT38rNv)</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Razorpay Secret:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="razorpay_secret" value="<?= @$config['razorpay_secret'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Razorpay Secret</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Razorpay:</label>
                  <div class="col-lg-9 col-xl-4">
                     <span class="switch switch-icon">
                     <label>
                     <input type="hidden"   name="razorpay_status" value="0">
                     <input type="checkbox" name="razorpay_status" value="1" onclick="$(this).attr('value', this.checked ? 1 : 0)" <?= @$config['razorpay_status'] =='1' ? 'checked':'' ?>>
                     <span></span>
                     </label>
                     </span>
                     <div class="form-text text-muted">Enable Razorpay Payment</div>
                  </div>
               </div>
               <!--begin::Footer-->
               <div class="card-footer">
                  <div class="row">
                     <div class="col-lg-3"></div>
                     <div class="col-lg-9">
                        <button type="submit" name="payment_form" class="btn btn-primary font-weight-bold mr-2" value="true">Save</button>
                     </div>
                  </div>
               </div>
               <!--end::Form-->
               <?= form_close() ?>
            </div>
            <!--end::Tab Pane-->
            <!--begin::Tab Pane-->
            <div class="tab-pane" id="kt_builder_google">
               <?= form_open('admin/setting/update'); ?>
               
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Api Key:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="google_map_api_key" value="<?= @$config['google_map_api_key'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Google Map Api Key(eg.AIzaSyAIcYXJyY4sTNir2C3n5U8tRl_I7ArTNHc)</div>
                  </div>
               </div>
               <!--begin::Footer-->
               <div class="card-footer">
                  <div class="row">
                     <div class="col-lg-3"></div>
                     <div class="col-lg-9">
                        <button type="submit" name="google_form" class="btn btn-primary font-weight-bold mr-2" value="true">Save</button>
                     </div>
                  </div>
               </div>
               <!--end::Form-->
               <?= form_close() ?>
            </div>
            <!--end::Tab Pane-->
            <!--begin::Tab Pane-->
            <div class="tab-pane" id="kt_builder_referral">
               <?= form_open('admin/setting/update'); ?>

                <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section configure to customer referred</div>
                     </div>
                  </div>
               </div>
               
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Reffral Prefix:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="referral_prefix_parking" value="<?= @$config['referral_prefix_parking'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reffral Prefix (eg.PM)</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cash Back Coin:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="number" name="referral_cashback_coin_self" value="<?= @$config['referral_cashback_coin_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reffral Cash Back Coin (eg.50 coins - Validity -90 Days)</div>
                  </div>
               </div>
              

              

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Expiry & Renewals Alerts Subscription Validity:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="alert_subcription_validity_self" value="<?= @$config['alert_subcription_validity_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Expiry Alerts Subscription Validity (eg.90 )</div>
                  </div>
               </div>

               
              
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Vehicle Buyer Inquiry:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="vehivle_buyer_inquiry_count_self" value="<?= @$config['vehivle_buyer_inquiry_count_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Vehicle Buyer Inquiry Count (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Vehicle Buyer Inquiry Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="vehivle_buyer_inquiry_validity_self" value="<?= @$config['vehivle_buyer_inquiry_validity_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Vehicle Buyer Inquiry Validity (eg.90 Days)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Reporting Alerts :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="report_alert_count_self" value="<?= @$config['report_alert_count_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reporting Alerts Count (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Reporting Alerts Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="report_alert_validity_self" value="<?= @$config['report_alert_validity_self'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reporting Alerts Validity (eg.90 Days)</div>
                  </div>
               </div>


               <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section configure to customer referred by other</div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cash Back Coin:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="number" name="referral_cashback_coin_other" value="<?= @$config['referral_cashback_coin_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reffral Cash Back Coin (eg.50 coins - Validity -90 Days)</div>
                  </div>
               </div>
               

             

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Expiry & Renewals Alerts Subscription Validity:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="alert_subcription_validity_other" value="<?= @$config['alert_subcription_validity_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Expiry & Renewals Alerts Subscription Validity (eg.90 )</div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Vehicle Buyer Inquiry:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="vehivle_buyer_inquiry_count_other" value="<?= @$config['vehivle_buyer_inquiry_count_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Vehicle Buyer Inquiry Count (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Vehicle Buyer Inquiry Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="vehivle_buyer_inquiry_validity_other" value="<?= @$config['vehivle_buyer_inquiry_validity_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Vehicle Buyer Inquiry Validity (eg.90 Days)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Reporting Alerts :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="report_alert_count_other" value="<?= @$config['report_alert_count_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reporting Alerts Count (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Reporting Alerts Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="report_alert_validity_other" value="<?= @$config['report_alert_validity_other'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Reporting Alerts Validity (eg.90 Days)</div>
                  </div>
               </div>

               <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section configure to  user will get PM 100 coins( Without refer code) validity - 30 Days</div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Signup Bonus :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="signup_bonus" value="<?= @$config['signup_bonus'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Signup Bonus (eg.100)</div>
                  </div>
               </div>

               <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section configure to  every successful help, the alert user will get a coinsback - 10 Validity - 30 Days</div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cashback Coin :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="success_alert_cashback_coin" value="<?= @$config['success_alert_cashback_coin'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Cashback Coin (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cashback Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="success_alert_cashback_validity" value="<?= @$config['success_alert_cashback_validity'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Cashback Validity (eg.30)</div>
                  </div>
               </div>


               <div class="row">
                  <label class="col-lg-3 col-form-label text-lg-right"></label>
                  <div class="form-group form-group-last">
                     <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-xl">
                              <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                 </g>
                              </svg>
                              <!--end::Svg Icon-->
                           </span>
                        </div>
                        <div class="alert-text">This section configure to  every resolved wrong parking mudde both users will get coinsback - 10 Validity 30 Days</div>
                     </div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cashback Coin :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="resolved_alert_cashback_coin" value="<?= @$config['resolved_alert_cashback_coin'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Cashback Coin (eg.10)</div>
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Cashback Validity :</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="resolved_alert_cashback_validity" value="<?= @$config['resolved_alert_cashback_validity'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Cashback Validity (eg.30)</div>
                  </div>
               </div>


              
            
               <!--begin::Footer-->
               <div class="card-footer">
                  <div class="row">
                     <div class="col-lg-3"></div>
                     <div class="col-lg-9">
                        <button type="submit" name="referral_form" class="btn btn-primary font-weight-bold mr-2" value="true">Save</button>
                     </div>
                  </div>
               </div>
               <!--end::Form-->
               <?= form_close() ?>
            </div>
            <!--end::Tab Pane-->

            <!--begin::Tab Pane-->
            <div class="tab-pane" id="kt_builder_parking_commision">
               <?= form_open('admin/setting/update'); ?>
               
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label text-lg-right">Parking Commission:</label>
                  <div class="col-lg-9 col-xl-4">
                     <input type="text" name="parking_commission" value="<?= @$config['parking_commission'] ?>" class="form-control" required>
                     <div class="form-text text-muted">Parking Commision (eg.50)</div>
                  </div>
               </div>
               <!--begin::Footer-->
               <div class="card-footer">
                  <div class="row">
                     <div class="col-lg-3"></div>
                     <div class="col-lg-9">
                        <button type="submit" name="parking_commision_form" class="btn btn-primary font-weight-bold mr-2" value="true">Save</button>
                     </div>
                  </div>
               </div>
               <!--end::Form-->
               <?= form_close() ?>
            </div>
            <!--end::Tab Pane-->
         </div>
      </div>
      <!--end::Body-->
   </div>
   <!--end::Card-->
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