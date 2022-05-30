<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('breadcrumb') ?>
	<!-- <section class="breadcrumb">
	    
	</section> -->
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>

<section class="user-deshboard" id="profile">
    <div class="container user-desh-top">
        <div class="row">
            <div class="col-md-3">
                <div class="img-upload m-auto">
                    <div class="custom-file">
                        <input type="file" id="file" class="custom-file-input" accept="image/png, image/gif, image/jpeg" @change="readURL">
                        <label class="custom-file-label" for="inputGroupFile01">
                            <i class='bx bx-camera'></i>
                        </label>
                    </div>
                    <img id="companylogo" class="file-input-preview" alt="logo" :src="userImage" />
                </div>
                <div class="side-nav-user mt-4">
                    <a class="side-nav-user-link active" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="13"
                            height="13">
                            <path
                                d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z" />
                        </svg>
                        Home
                    </a>
                    <a class="side-nav-user-link" href="<?php echo base_url('auth/profile/friendlist') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="13"
                            height="13">
                            <path
                                d="M9,12A6,6,0,1,0,3,6,6.006,6.006,0,0,0,9,12ZM9,2A4,4,0,1,1,5,6,4,4,0,0,1,9,2Z" />
                            <path
                                d="M9,14a9.011,9.011,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.011,9.011,0,0,0,9,14Z" />
                            <path
                                d="M22,7.875a2.107,2.107,0,0,0-2,2.2,2.107,2.107,0,0,0-2-2.2,2.107,2.107,0,0,0-2,2.2c0,1.73,2.256,3.757,3.38,4.659a.992.992,0,0,0,1.24,0c1.124-.9,3.38-2.929,3.38-4.659A2.107,2.107,0,0,0,22,7.875Z" />
                        </svg>
                        Friend list
                    </a>
                    <a class="side-nav-user-link" href="<?php echo base_url('auth/profile/calendar') ?>">
                            <svg data-v-254b7dbb="" xmlns="http://www.w3.org/2000/svg" width="13px" height="13px"
                                viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee">
                                <path data-v-254b7dbb="" d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                <path data-v-254b7dbb="" d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                <line data-v-254b7dbb="" x1="6" y1="1" x2="6" y2="4"></line>
                                <line data-v-254b7dbb="" x1="10" y1="1" x2="10" y2="4"></line>
                                <line data-v-254b7dbb="" x1="14" y1="1" x2="14" y2="4"></line>
                            </svg>
                            Event calendar
                        </a>
                    <a class="side-nav-user-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="13"
                            height="13">
                            <path
                                d="M12,0A11.972,11.972,0,0,0,4,3.073V1A1,1,0,0,0,2,1V4A3,3,0,0,0,5,7H8A1,1,0,0,0,8,5H5a.854.854,0,0,1-.1-.021A9.987,9.987,0,1,1,2,12a1,1,0,0,0-2,0A12,12,0,1,0,12,0Z" />
                            <path
                                d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z" />
                        </svg>
                        History
                    </a>
                    <a class="side-nav-user-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="13"
                            height="13">
                            <path d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
                            <path
                                d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z" />
                        </svg>
                        Setting
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="user-box mb-4">
                    <div class="user-box-head pb-0">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0 user-box-head-title"> Profile </h5>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm w-100" data-toggle="modal"
                                            data-target="#staticBackdropprifile">
                                            <i class="bx bx-edit"></i> Edit
                                        </button>

                                        <div class="modal fade" id="staticBackdropprifile" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropprifileLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropprifileLabel">
                                                            Edit Profile
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <?php //echo '<pre>';print_r($user_profile);die; ?>
                                                                <input type="text" class="form-control" id="name" name="name"
                                                                    placeholder="Name" value="<?php echo set_value('name', (isset($user_profile) ? $user_profile->name : '')) ?>" v-model="newUser.name">
                                                                    <span class="text-danger" v-html = "formValidate.name"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    E-mail
                                                                </label>
                                                                <input type="email" class="form-control" id="email" name="email"
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Email" value="<?php echo set_value('email', (isset($user_profile) ? $user_profile->email : '')) ?>" disabled v-model="newUser.email">
                                                                    <span class="text-danger" v-html = "formValidate.email"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Mobile No
                                                                </label>
                                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Mobile No" value="<?php echo set_value('mobile', (isset($user_profile) ? $user_profile->mobile : '')) ?>" v-model="newUser.mobile">
                                                                    <span class="text-danger" v-html = "formValidate.mobile"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    DOB
                                                                </label>
                                                                <input type="date" class="form-control" id="dob" name="dob"
                                                                    aria-describedby="emailHelp" value="<?php echo set_value('dob', (isset($user_profile) ? $user_profile->dob : '')) ?>" v-model="newUser.dob">
                                                                    <span class="text-danger" v-html = "formValidate.dob"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Anniversary
                                                                </label>
                                                                <input type="date" class="form-control" id="anniversary" name="anniversary" value="<?php echo set_value('anniversary', (isset($user_profile) ? $user_profile->anniversary : '')) ?>" v-model="newUser.anniversary">
                                                                <span class="text-danger" v-html = "formValidate.anniversary"></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Address
                                                                </label>
                                                                <textarea class="form-control" id="address" name="address"
                                                                    placeholder="Address" value="<?php echo set_value('address', (isset($user_profile) ? $user_profile->address : '')) ?>" v-model="newUser.address"></textarea>
                                                                    <span class="text-danger" v-html = "formValidate.address"></span>
                                                            </div>
                                                            <!-- <button type="submit"
                                                                class="btn btn-primary">Submit</button> -->
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="modelclose" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button"
                                                            class="btn btn-primary" @click="doSubmit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-0 mt-2" />
                    </div>
                    <div class="user-box-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="14" height="14">
                                            <path
                                                d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z" />
                                            <path
                                                d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z" />
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>Name</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->name : '' ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="14" height="14">
                                            <path
                                                d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm8.647,7H17.426a19.676,19.676,0,0,0-2.821-4.644A10.031,10.031,0,0,1,20.647,7ZM16.5,12a10.211,10.211,0,0,1-.476,3H7.976A10.211,10.211,0,0,1,7.5,12a10.211,10.211,0,0,1,.476-3h8.048A10.211,10.211,0,0,1,16.5,12ZM8.778,17h6.444A19.614,19.614,0,0,1,12,21.588,19.57,19.57,0,0,1,8.778,17Zm0-10A19.614,19.614,0,0,1,12,2.412,19.57,19.57,0,0,1,15.222,7ZM9.4,2.356A19.676,19.676,0,0,0,6.574,7H3.353A10.031,10.031,0,0,1,9.4,2.356ZM2.461,9H5.9a12.016,12.016,0,0,0-.4,3,12.016,12.016,0,0,0,.4,3H2.461a9.992,9.992,0,0,1,0-6Zm.892,8H6.574A19.676,19.676,0,0,0,9.4,21.644,10.031,10.031,0,0,1,3.353,17Zm11.252,4.644A19.676,19.676,0,0,0,17.426,17h3.221A10.031,10.031,0,0,1,14.605,21.644ZM21.539,15H18.1a12.016,12.016,0,0,0,.4-3,12.016,12.016,0,0,0-.4-3h3.437a9.992,9.992,0,0,1,0,6Z" />
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>E-mail</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->email : ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="14" height="14">
                                            <path
                                                d="M15,0H9A5.006,5.006,0,0,0,4,5V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V5A5.006,5.006,0,0,0,15,0ZM9,2h6a3,3,0,0,1,3,3V16H6V5A3,3,0,0,1,9,2Zm6,20H9a3,3,0,0,1-3-3V18H18v1A3,3,0,0,1,15,22Z" />
                                            <circle cx="12" cy="20" r="1" />
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>Mobile No</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->mobile : ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="14" height="14">
                                            <path
                                                d="M19,2H18V1a1,1,0,0,0-2,0V2H8V1A1,1,0,0,0,6,1V2H5A5.006,5.006,0,0,0,0,7V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V7A5.006,5.006,0,0,0,19,2ZM2,7A3,3,0,0,1,5,4H19a3,3,0,0,1,3,3V8H2ZM19,22H5a3,3,0,0,1-3-3V10H22v9A3,3,0,0,1,19,22Z" />
                                            <circle cx="12" cy="15" r="1.5" />
                                            <circle cx="7" cy="15" r="1.5" />
                                            <circle cx="17" cy="15" r="1.5" />
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>DOB</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->dob : ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="14" height="14">
                                            <path
                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z" />
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>Anniversary</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->anniversary : ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="prifile-content mb-4">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                                            width="13" height="13">
                                            <path
                                                d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h5>Address</h5>
                                        <h6><?php echo isset($user_profile) ? $user_profile->address : '' ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-box">
                    <div class="user-box-head pb-0">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="mb-0 user-box-head-title">Company Profile </h5>
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm w-100" data-toggle="modal"
                                            data-target="#staticBackdropcped">
                                            <i class="bx bx-edit"></i> Edit
                                        </button>

                                        <div class="modal fade" id="staticBackdropcped" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropcpedLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropcpedLabel">
                                                            Edit Company Profile
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="">Company Name</label>
                                                                <input type="text" class="form-control" id=""
                                                                    placeholder="Company Name" v-model="companyProfile.company_name">
                                                                <span class="text-danger" v-html = "ProfileValidate.company_name"></span>    
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Official E-mail
                                                                </label>
                                                                <input type="email" class="form-control" id=""
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Official E-mail" v-model="companyProfile.company_email">
                                                                <span class="text-danger" v-html = "ProfileValidate.company_email"></span>    
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Mobile No
                                                                </label>
                                                                <input type="text" class="form-control" id=""
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Mobile No" v-model="companyProfile.company_mobile" maxlength="10">
                                                                <span class="text-danger" v-html = "ProfileValidate.company_mobile"></span>    
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Company Address
                                                                </label>
                                                                <textarea class="form-control" id=""
                                                                    placeholder="Company Address" v-model="companyProfile.company_address"></textarea>
                                                                <span class="text-danger" v-html = "ProfileValidate.company_address"></span>    
                                                            </div>
                                                            <button type="button" id="companymodelclose" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                            <button type="button"
                                                                class="btn btn-primary" @click="doUpdate">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-0 mt-2" />
                    </div>
                    <div class="user-box-body pb-0">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold mb-3">Company Logo</p>
                                <div class="img-upload">
                                    <div class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" accept="image/png, image/gif, image/jpeg" @change="base64File">
                                        <label class="custom-file-label" for="inputGroupFile01">
                                            <i class='bx bx-camera'></i>
                                        </label>
                                    </div>

                                    <!-- <img id="blah2" class="file-input-preview" alt="logo" src="http://localhost/templatezone/public/filereader/fetchfile/companylogo/220224124647.jpg"/> -->
                                    <img id="companylogo" class="file-input-preview" alt="logo" :src="companyLogo" />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="prifile-content mb-4">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" height="14"
                                                    viewBox="0 0 24 24" width="14" data-name="Layer 1">
                                                    <path
                                                        d="m7 14a1 1 0 0 1 -1 1h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 1 1zm4-1h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm-5 4h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm5 0h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm-5-12h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm5 0h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm-5 4h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm5 0h-1a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2zm13 1v9a5.006 5.006 0 0 1 -5 5h-14a5.006 5.006 0 0 1 -5-5v-14a5.006 5.006 0 0 1 5-5h6a5.006 5.006 0 0 1 5 5h3a5.006 5.006 0 0 1 5 5zm-19 12h9v-17a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3zm17-12a3 3 0 0 0 -3-3h-3v15h3a3 3 0 0 0 3-3zm-3 3a1 1 0 1 0 1 1 1 1 0 0 0 -1-1zm0 4a1 1 0 1 0 1 1 1 1 0 0 0 -1-1zm0-8a1 1 0 1 0 1 1 1 1 0 0 0 -1-1z" />
                                                </svg>
                                            </div>
                                            <div class="details">
                                                <h5>Company Name</h5>
                                                <h6><?php echo isset($user_comp_profile) ? $user_comp_profile->company_name : ''; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="prifile-content mb-4">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline"
                                                    viewBox="0 0 24 24" width="14" height="14">
                                                    <path
                                                        d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm8.647,7H17.426a19.676,19.676,0,0,0-2.821-4.644A10.031,10.031,0,0,1,20.647,7ZM16.5,12a10.211,10.211,0,0,1-.476,3H7.976A10.211,10.211,0,0,1,7.5,12a10.211,10.211,0,0,1,.476-3h8.048A10.211,10.211,0,0,1,16.5,12ZM8.778,17h6.444A19.614,19.614,0,0,1,12,21.588,19.57,19.57,0,0,1,8.778,17Zm0-10A19.614,19.614,0,0,1,12,2.412,19.57,19.57,0,0,1,15.222,7ZM9.4,2.356A19.676,19.676,0,0,0,6.574,7H3.353A10.031,10.031,0,0,1,9.4,2.356ZM2.461,9H5.9a12.016,12.016,0,0,0-.4,3,12.016,12.016,0,0,0,.4,3H2.461a9.992,9.992,0,0,1,0-6Zm.892,8H6.574A19.676,19.676,0,0,0,9.4,21.644,10.031,10.031,0,0,1,3.353,17Zm11.252,4.644A19.676,19.676,0,0,0,17.426,17h3.221A10.031,10.031,0,0,1,14.605,21.644ZM21.539,15H18.1a12.016,12.016,0,0,0,.4-3,12.016,12.016,0,0,0-.4-3h3.437a9.992,9.992,0,0,1,0,6Z" />
                                                </svg>
                                            </div>
                                            <div class="details">
                                                <h5>Official E-mail</h5>
                                                <h6><?php echo isset($user_comp_profile) ? $user_comp_profile->company_email : ''; ?></h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="prifile-content mb-4">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline"
                                                    viewBox="0 0 24 24" width="14" height="14">
                                                    <path
                                                        d="M15,0H9A5.006,5.006,0,0,0,4,5V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V5A5.006,5.006,0,0,0,15,0ZM9,2h6a3,3,0,0,1,3,3V16H6V5A3,3,0,0,1,9,2Zm6,20H9a3,3,0,0,1-3-3V18H18v1A3,3,0,0,1,15,22Z" />
                                                    <circle cx="12" cy="20" r="1" />
                                                </svg>
                                            </div>
                                            <div class="details">
                                                <h5>Mobile No.</h5>
                                                <h6><?php echo isset($user_comp_profile) ? $user_comp_profile->company_mobile : ''; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="prifile-content mb-4">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline"
                                                    viewBox="0 0 24 24" width="14" height="14">
                                                    <path
                                                        d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="details">
                                                <h5>Address</h5>
                                                <h6><?php echo isset($user_comp_profile) ? $user_comp_profile->company_address : ''; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    

            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<!-- <script>
    $(document).ready(function () {
        $("input[name$=msgpos]").click(function () {
            var test = $(this).val();
            $(".msgpos").hide();
            $("#msgposcnt" + test).show();
        })
    })
</script> -->
<script type="text/javascript">
    let pr = new Vue({
        el : '#profile',
        data : {
            newUser: {
                name        : '<?php echo isset($user_profile) ? $user_profile->name : '' ?>',
                email       : '<?php echo isset($user_profile) ? $user_profile->email : '' ?>',
                mobile      : '<?php echo isset($user_profile) ? $user_profile->mobile : '' ?>',
                dob         : '<?php echo isset($user_profile) ? $user_profile->dob : '' ?>',
                gender      : '<?php echo isset($user_profile) ? $user_profile->gender : '' ?>',
                anniversary : '<?php echo isset($user_profile) ? $user_profile->anniversary : '' ?>',
                address     : '<?php echo isset($user_profile) ? $user_profile->address : '' ?>',
            },
            companyProfile: {
                email           : '<?php echo isset($user_profile) ? $user_profile->email : '' ?>',
                company_name    : '<?php echo isset($user_comp_profile) ? $user_comp_profile->company_name : ''; ?>',
                company_email   : '<?php echo isset($user_comp_profile) ? $user_comp_profile->company_email : ''; ?>',
                company_mobile  : '<?php echo isset($user_comp_profile) ? $user_comp_profile->company_mobile : ''; ?>',
                company_address : '<?php echo isset($user_comp_profile) ? $user_comp_profile->company_address : ''; ?>',
            },
            email           : '<?php echo isset($user_profile) ? $user_profile->email : '' ?>',
            formValidate : [],
            ProfileValidate : [],
            companyLogo : "<?php echo isset($user_comp_profile) ? $user_comp_profile->company_logo : '' ?>",
            userImage   : "<?php echo isset($user_profile) ? $user_profile->user_image : '' ?>",
        },
        methods : {
            doSubmit: function() {
                var formData = this.formData(this.newUser);
                formData[token_name] = token_val;
                axios.post(base_url + 'auth/profile/updateprofile', formData).then(function(response){
                    token_val = response.data.token;
                    if(response.data.status == 'false'){
                        pr.formValidate = response.data.errors;
                    }else{
                        toastr.success('User Profile updated successfully.!', 'success', {timeout: 9000});
                        $('#modelclose').click();
                        location.reload();
                    }
                });
            },
            doUpdate: function() {
                // alert('');return false;
                // console.log(JSON.stringify(this.companyProfile));return false;
                var formData = this.formData(this.companyProfile);
                formData[token_name] = token_val;
                // console.log(formData);return false;
                axios.post(base_url + 'auth/profile/companyprofile', formData).then(function(response){
                    token_val = response.data.token;
                    console.log(response.data.errors);return false;
                    if(response.data.status == 'false'){
                        pr.ProfileValidate = response.data.errors;
                    }else{
                        // $('#modelclose').click();
                        toastr.success('Company Profile updated successfully.!', 'success', {timeout: 9000});
                        $('#companymodelclose').click();
                        location.reload();
                    }
                });
            },
            formData(obj){
                var formData = new FormData();
                for ( var key in obj ) {
                    formData.append(key, obj[key]);
                } 
                formData.append([token_name], token_val);
                return formData;
            },
            clearAll(){
                pr.newUser = {
                    name        : '',
                    email       : '',
                    mobile      : '',
                    dob         : '',
                    gender      : '',
                    anniversary : '',
                    address     : '',
                };    
                pr.companyProfile = {
                    email           : '',
                    company_name    : '',
                    company_email   : '',
                    company_mobile  : '',
                    company_address : '',
                };
                pr.formValidate = [];
                pr.ProfileValidate = [];
            },
            base64File: function(element) {

                let file = element.target.files[0];
                const reader = new FileReader()

                let rawImg;
                reader.onloadend = () => {
                   rawImg = reader.result;
                   this.logo(rawImg);
                }
                reader.readAsDataURL(file);
            },
            logo : function(rawImg) {

                var b64_img = rawImg.split('base64,');
                var thumbnail = b64_img[1];

                let data = {
                    file : thumbnail,
                    email : this.email,
                }
                data[token_name] = token_val;
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You really want to update company logo!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#007bff',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Update it!',
                  dangerMode : true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.post(base_url + 'auth/profile/updatelogo', data).then(function(response){
                        token_val = response.token;
                        pr.companyLogo = response.logo;
                    });
                    Swal.fire(
                      'Updated!',
                      'Your Company Logo has been updated.',
                      'success'
                    )
                  }
                })
            },
            readURL: function(element) {

                let file = element.target.files[0];
                const reader = new FileReader()

                let rawImg;
                reader.onloadend = () => {
                   rawImg = reader.result;
                   this.userDp(rawImg);
                }
                reader.readAsDataURL(file);
            },
            userDp : function(rawImg) {

                var b64_img = rawImg.split('base64,');
                var thumbnail = b64_img[1];

                let data = {
                    file : thumbnail,
                    email : this.email,
                }
                data[token_name] = token_val;
                // console.log(data);return false;
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You really want to change Profile Picture!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#007bff',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Update it!',
                  dangerMode : true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.post(base_url + 'auth/profile/updatedp', data).then(function(response){
                        token_val = response.token;
                        pr.userImage = response.logo;
                    });
                    Swal.fire(
                      'Updated!',
                      'Your Profile Picture has been updated.',
                      'success'
                    )
                  }
                })
            }
        },
        mounted: function() {
            // alert('');
        }
    });
</script>
<?php echo $this->endSection() ?>