<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- ==========================New Design Code Start From Here ===========================-->

<!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
      <!--begin::Content-->
      <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
          <div class="d-flex flex-column">
            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= ucwords($this->session->userdata('username')); ?></a>           
            <div class="navi mt-2">
               <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
          <i class="ki ki-close icon-xs text-muted"></i>
        </a>
              <a href="<?= base_url('admin/auth/logout') ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
            </div>
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
       
        
        <!--begin::Notifications-->
        <div>
          
          
        </div>
        <!--end::Notifications-->
      </div>
      <!--end::Content-->
    </div>
    <!-- end::User Panel-->

<!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
      <span class="svg-icon">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <polygon points="0 0 24 0 24 24 0 24" />
            <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
            <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
          </g>
        </svg>
        <!--end::Svg Icon-->
      </span>
    </div>
    <script src="<?= base_url() ?>assets/js/pages/crud/file-upload/image-input.js?v=7.2.7"></script>
    <!--begin::Page Vendors(used by this page)-->
    <script src="<?= base_url() ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?= base_url() ?>assets/js/pages/widgets.js"></script>
    <script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/form-repeater.js"></script>
    <!--begin::Page Vendors(used by this page)-->
    <!--end::Page Scripts-->
  <!--begin::Page Vendors(used by this page)-->
  <script src="<?= base_url() ?>assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.8"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="<?= base_url() ?>assets/js/pages/crud/datatables/extensions/buttons.js?v=7.2.8"></script>


  <!--end::Page Scripts-->
      

</body>
</html>

<script type="text/javascript">
   $(document).ready(function() {
      $('.table').each(function() { 
         tableid = ($(this).attr('id'));
         if(tableid){
            $('#'+tableid).dataTable(); 
         }else{
            $('.table').dataTable(); 
         }
         //alert(tableid)
         
      });
   } );

function getRecord(){
    $('#example1').DataTable({
      "destroy": true,
      "bProcessing": true,
      "serverSide": true,
      "ajax":{
        url :base_url+"admin/storeList",
        type: "post",
        } 
    });
  }

</script>
