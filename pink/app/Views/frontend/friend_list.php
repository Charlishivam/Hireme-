<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('breadcrumb') ?>
    <!-- <section class="breadcrumb">
        
    </section> -->
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>

    <section class="user-deshboard" id="mainDiv">
        <div class="container user-desh-top">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?php base_url('assets/img/home slide.png') ?>" class="w-100 profile-img">
                    <div class="side-nav-user mt-4">
                        <a class="side-nav-user-link" href="<?php echo base_url('/profile') ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="13"
                                height="13">
                                <path
                                    d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z" />
                            </svg>
                            Home
                        </a>
                        <a class="side-nav-user-link active" href="<?php echo base_url('auth/profile/friendlist') ?>">
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
                    <div class="dash-box">
                        <div class="dash-box-head">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5 class="m-0 pt-1 font-weight-bold">Friend List</h5>
                                </div>
                                <div class="col-md-9">
                                    <div class="row justify-content-end">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Search by keyword..." v-model="search_keyword" @keyup="loadPage">
                                        </div>
                                       <!--  <div class="col-md-3">
                                            <select class="custom-select custom-select-sm" id="inputGroupSelect01">
                                                <option selected disabled>Short by</option>
                                                <option value="1">Name</option>
                                                <option value="1">Company Name</option>
                                                <option value="2">Upcoming Birth day</option>
                                                <option value="3">Upcoming Anniversary</option>
                                                <option value="4">Reset</option>
                                            </select>
                                        </div> -->
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary w-100 btn-sm" data-toggle="modal"
                                                        data-target="#staticBackdropAddFriend">
                                                        Add Friend
                                                    </button>
                                                    <div class="modal fade" id="staticBackdropAddFriend"
                                                        data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropAddFriendLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="staticBackdropAddFriendLabel">
                                                                        Add Friend
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body px-4 pt-4">
                                                                    <form>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="" placeholder="Name" v-model = "newUser.name">
                                                                                <div class="text-danger" v-html="formValidate.name"></div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="">Image</label>
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        id="inputGroupFile01"
                                                                                        aria-describedby="inputGroupFileAddon01" @change="base64File">
                                                                                    <label class="custom-file-label"
                                                                                        for="inputGroupFile01">Choose
                                                                                        file</label>
                                                                                    <div class="text-danger" v-html="formValidate.image"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">
                                                                                    E-mail
                                                                                </label>
                                                                                <input type="email" class="form-control"
                                                                                    id="" aria-describedby="emailHelp"
                                                                                    placeholder="Email ID" v-model = "newUser.email">
                                                                                <div class="text-danger" v-html="formValidate.email"></div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">
                                                                                    Mobile No
                                                                                </label>
                                                                                <input type="text" class="form-control"
                                                                                    id="" aria-describedby="emailHelp"
                                                                                    placeholder="Mobile No" v-model = "newUser.mobile">
                                                                                <div class="text-danger" v-html="formValidate.mobile"></div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">
                                                                                    DOB
                                                                                </label>
                                                                                <input type="date" class="form-control"
                                                                                    id="" aria-describedby="emailHelp" v-model = "newUser.dob">
                                                                                <div class="text-danger" v-html="formValidate.dob"></div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">
                                                                                    Anniversary
                                                                                </label>
                                                                                <input type="date" class="form-control"
                                                                                    id="" v-model = "newUser.anniversary">
                                                                                <div class="text-danger" v-html="formValidate.anniversary"></div>
                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label for="">
                                                                                    Address
                                                                                </label>
                                                                                <textarea class="form-control" id=""
                                                                                    placeholder="Address" v-model = "newUser.address"></textarea>
                                                                                <div class="text-danger" v-html="formValidate.address"></div>
                                                                            </div>
                                                                            <div class="col-md-12">

                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary" @click="addUser">Submit</button>
                                                                    <button type="button" class="btn btn-secondary" id="addmodelclose" 
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-outline-primary w-100 btn-sm">Upload
                                                        CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash-box-body">
                            <div class="modal fade" id="staticBackdropEditFriend" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEditFriendLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropEditFriendLabel">
                                                Edit Friend
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body px-4 pt-4">
                                            <form>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Name</label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="Name" v-model="editUser.name">
                                                        <div class="text-danger" v-html="formEditValidate.name"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="inputGroupFile01"
                                                                aria-describedby="inputGroupFileAddon01" @change="updateBase64File">
                                                            <label class="custom-file-label"
                                                                for="inputGroupFile01">Choose
                                                                file</label>
                                                            <div class="text-danger" v-html="formEditValidate.image"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">
                                                            E-mail
                                                        </label>
                                                        <input type="email" class="form-control" id=""
                                                            aria-describedby="emailHelp" placeholder="Email ID" v-model="editUser.email">
                                                        <div class="text-danger" v-html="formEditValidate.email"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">
                                                            Mobile No
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            aria-describedby="emailHelp" placeholder="Mobile No" v-model="editUser.mobile">
                                                        <div class="text-danger" v-html="formEditValidate.mobile"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">
                                                            DOB
                                                        </label>
                                                        <input type="date" class="form-control" id=""
                                                            aria-describedby="emailHelp" v-model="editUser.dob">
                                                        <div class="text-danger" v-html="formEditValidate.dob"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">
                                                            Anniversary
                                                        </label>
                                                        <input type="date" class="form-control" id="" v-model="editUser.anniversary">
                                                        <div class="text-danger" v-html="formEditValidate.anniversary"></div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="">
                                                            Address
                                                        </label>
                                                        <textarea class="form-control" id=""
                                                            placeholder="Address" v-model="editUser.address"></textarea>
                                                        <div class="text-danger" v-html="formEditValidate.address"></div>
                                                    </div>
                                                    <div class="col-md-12">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" @click="updateUserData">Update</button>
                                            <button type="button" class="btn btn-secondary" id="modelclose" 
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="staticBackdropViewFriend" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropViewFriendLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropViewFriendLabel">
                                               {{chooseUser.name}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body px-4 pt-4">
                                            <div class="text-center">
                                                <img class="w-100" :src="chooseUser.image" style="max-width: 150px;" />
                                                <h5 class="font-weight-bold mt-3">{{chooseUser.name}}</h5>
                                                <p class="m-0">{{chooseUser.mobile}}</p>
                                                <p class="m-0 mb-4">{{chooseUser.email}}</p>
                                                <p class="m-0"><span class="text-muted"><i class='bx bx-calendar' ></i> DOB : </span>{{chooseUser.dob}}</p>
                                                <p class="m-0"><span class="text-muted"><i class='bx bxs-wine' ></i> Anniversary : </span>{{chooseUser.anniversary}}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <table class="table table-bordered table-striped table-vertical-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 60px;">S.No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Anniversary</th>
                                        <th scope="col" style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="page_records.length > 0">
                                    <tr v-for="(r, idx) in page_records">
                                        <th scope="row">{{ idx + 1 + (page * limit) }}</th>
                                        <td>{{r.name}}</td>
                                        <td>{{r.dob}}</td>
                                        <td>{{r.anniversary}}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm py-0" data-toggle="modal"
                                                        data-target="#staticBackdropViewFriend" @click="selectUser(r)">View</button>
                                            <button class="btn btn-outline-primary btn-sm py-0" data-toggle="modal"
                                                        data-target="#staticBackdropEditFriend" @click="updateUser(r)">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td class="text-center" colspan="8">No records found.!</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="dash-box-footer">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0">
                                    <li class="page-item" v-bind:class="page == 0 ? 'disabled' : ''" @click="loadPrev"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                    <li class="page-item" v-bind:class="page_records.length < limit || next_disable ? 'disabled' : ''" @click="loadNext"><a class="page-link" href="javascript:void(0)">Next</a></li>
                                </ul>
                            </nav>
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
    var pr = new Vue({
    el: '#mainDiv',
    data: {
        newUser: {
            name        : '',
            image       : '',
            email       : '',
            mobile      : '',
            dob         : '',
            anniversary : '',
            address     : '',
        },
        formValidate    : [],
        imageFile       : '',
        chooseUser      : {},
        editUser        : {},
        formEditValidate    : [],
        // editUser.image  : '',

        page_records        : [],
        selected_records    : [],
        all_records         : [],
        search_keyword      : null,
        status              : '',
        page                : 0,
        limit               : page_limit_list,
        next_disable        : false,
        show_reset          : false,
    },
    methods : {
        selectUser : function(user) {
            pr.chooseUser = user;
        },
        updateUser : function(user) {
            pr.editUser         = user;
            pr.editUser.image   = '';
        },
        base64File: function(element) {
            this.imageFile = '';
            let file = element.target.files[0];
            const reader = new FileReader()

            let rawImg;
            reader.onloadend = () => {
                rawImg = reader.result;
                var b64_img = rawImg.split('base64,');
                var thumbnail = b64_img[1];
               this.newUser.image = thumbnail;
               // console.log(this.imageFile);return false;
               // this.logo(rawImg);
            }
            reader.readAsDataURL(file);
        },
        updateBase64File: function(element) {
            this.imageFile = '';
            let file = element.target.files[0];
            const reader = new FileReader()

            let rawImg;
            reader.onloadend = () => {
                rawImg = reader.result;
                var b64_img = rawImg.split('base64,');
                var thumbnail = b64_img[1];
               this.editUser.image = thumbnail;
               // console.log(this.imageFile);return false;
               // this.logo(rawImg);
            }
            reader.readAsDataURL(file);
        },
        addUser: function() {
            // console.log(this.imageFile);return false;
            var formData = pr.formData(pr.newUser);
            formData[token_name] = token_val;
            // formData[imageFile]  = this.imageFile;
            // console.log(formData);return false;
            axios.post(base_url + 'auth/profile/addfriend', formData).then(function(response){
                token_val = response.data.token;
                if(response.data.error){
                    pr.formValidate = response.data.errors;
                }else{
                    pr.successMSG = response.data.msg;
                    pr.errorMSG = response.data.msg_error;
                    pr.clearAll();
                    // pr.clearMSG();

                    $('#addmodelclose').click();
                }
            });
        },
        updateUserData: function() {
            // alert('');return false;
            // console.log(this.imageFile);return false;
            var formData = pr.formData(pr.editUser);
            formData[token_name] = token_val;
            // formData[imageFile]  = this.imageFile;
            // console.log(this.editUser);return false;
            axios.post(base_url + 'auth/profile/updateFriend', formData).then(function(response){
                token_val = response.data.token;
                if(response.data.error == true){
                    pr.formEditValidate = response.data.errors;
                }else{
                    pr.successMSG = response.data.msg;
                    pr.errorMSG = response.data.msg_error;
                    pr.clearAll();
                    // pr.clearMSG();
                    $('#modelclose').click();
                    
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
                first_name          : '',
                last_name           : '',
                mobile              : '',
                email               : '',
                bussness_name       : '',
                gst_no              : '',
                register_address    : '',
                bussness_address    : '',
                password            : '',
                cnf_password        : '',
                status              : '',
            };    
            pr.formValidate        = [];
            
        },
        searchRecords: function () {
            this.selected_records   = [];
            this.page               = 0;
            this.show_reset         = true;
            this.loadPage();
        },
        resetRecords : function () {
            this.status         = '';
            this.search_keyword = '';
            this.page           = 0;
            this.loadPage();
            this.show_reset     = false;
        },
        loadPrev: function() {
            if (this.page > 0) {
                this.page--;
                this.setPage();
            }
        },
        loadNext: function() {
            if (this.page_records.length == this.limit) {
                this.page++;
                this.setPage();
                if (this.page_records.length == 0) {

                    this.loadPage();
                }
            }
        },
        setPage:        function () {
            var o               = this.page * this.limit;
            this.page_records   = this.selected_records.slice(o, o+this.limit);
        },
        addRecords:     function (records) {
            this.page_records       = [];
            this.page_records       = this.page_records.concat(records);
            this.selected_records   = this.selected_records.concat(records);
        },
        loadPage: function(csv_export = false) {
            var data = {
               page     : this.page+1,
               // status   : this.status, 
               keyword  : this.search_keyword,
            }

            data[token_name] = token_val;
            if (csv_export == true) {
                data['export'] = 'Y';
                this.all_records = [];
            }else{
                this.next_disable = true;
            }
            // startProcess();
            $.post(base_url+'auth/profile/fetch', data, function(response) {
                token_val = response.token;
                // endProcess();
                if (csv_export == true) {
                    pr.exportData(response.records);
                    return;
                }
                if (response.status == 'success') {
                    pr.addRecords(response.records);
                } else {
                    pr.page--;
                }
                pr.next_disable = false;
            }, 'json').fail(function() {
                regenToken();
                // endProcess();
                pr.page--;
                pr.next_disable = false;
            });
        },
        exportData:function(records) {
            var csvData = 'First Name, Last Name, Mobile Number, Email Id, Bussness Name, GSTIn Number\n';
            for (var i in records) {
                var r   = records[i];
                var x   = r.first_name;
                x       += ','+r.last_name+','+r.mobile+','+r.email+','+r.bussness_name+',';
                x       += r.gst_no+',';
                // csvData += (Number(i)+1)+','+x+ '\n';
                csvData += x+ '\n';
            }
            csvData = csvData.substring(0, csvData.length - 1);
            var fname = this.exportName();
            var blob = new Blob([csvData]);
            if (window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveBlob(blob, fname);
            } else {
                var a = window.document.createElement("a");
                a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
                a.download = fname;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        },
        exportName:function() {
            const current = new Date();
            const date = current.getFullYear()+'-'+(current.getMonth()+1)+'-'+current.getDate();
            const time = current.getHours() + "-" + current.getMinutes() + "-" + current.getSeconds();
            const dateTime = date +'-'+ time;

            var fname = 'Agent List' +'-'+ dateTime;
            fname += '.csv';
            return fname;
        }
    },
    mounted: function() {
            // startProcess();
            // alert('');
            $.getJSON(base_url + 'auth/profile/fetch', function(){
                
            }).done(function(response){
                // console.log(response);
                pr.page_records     = response.records;
                pr.selected_records = response.records;
                // endProcess();
            }).fail(function(){
                // endProcess();
            })
        }
});   
</script>
<?php echo $this->endSection() ?>