<div class="card card-custom">
   <div class="card-header">
      <div class="card-title">
         <span class="card-icon">
         <i class="fa fa-cog text-dark"></i>
         </span>
         <h3 class="card-label text-dark">Settings</h3>
      </div>
      <div class="card-toolbar">
         <!--begin::Dropdown-->
         <!--end::Button-->
      </div>
   </div>
   <div class="card-body bg-light">
      <!--begin: Search Form-->
      <div class="row">
        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/channels/view') ?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Channels
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Import order from your online store</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/warehouses/view') ?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Warehouses
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Manage your pickup locations</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/employees/view') ?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Employees
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Allow access to your team members</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/api/view') ?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            API
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Programmatically access zooppost data.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/company_profile/view') ?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Company Profile
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Your Company Profile</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('admin/label_settings/view')?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Label Settings
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Set your shipping label foramt</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-5">
            <a href="<?= base_url('/admin/account_settings/view')?>">
                <div class="card card-custom">
                    <div class="card-header bg-dark">
                        <div class="card-title text-light">
                            Account Settings
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <i style="font-size: 30px" class="fa fa-file py-5"></i>
                        <p>Update profile or password</p>
                    </div>
                </div>
            </a>
        </div>
      </div>
   </div>
</div>