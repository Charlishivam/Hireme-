<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('breadcrumb') ?>
	<!-- <section class="breadcrumb">
	    
	</section> -->
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>

<section class="user-deshboard">
    <div class="container user-desh-top">
        <div class="row">
            <div class="col-md-3">
                <div>
                    <!-- <img src="img/home slide.png" class="w-100 profile-img"> -->
                    <div class="side-nav-user mt-4">
                        <a class="side-nav-user-link" href="<?php echo base_url('/profile') ?>">
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
                        <a class="side-nav-user-link active" href="<?php echo base_url('auth/profile/calendar') ?>">
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
            </div>

            <!-- <a href="" id="btn">sdfasdf</a> -->


            <div class="col-md-9" id="event_list">
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="birthday" id="birthday" checked>
                  <label class="form-check-label" for="inlineRadio1">Birthday</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="anniversary" id="anniversary">
                  <label class="form-check-label" for="inlineRadio2">Anniversary</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="festival" id="festival">
                  <label class="form-check-label" for="inlineRadio3">Celibration/Festival</label>
                </div>

                <div id="birthdayDiv" class="show">
                    <?php if (!empty($finalDob)) { ?>
                       <div class="mb-4">
                            <?php foreach ($finalDob as $key => $value) { ?>
                            <h4 class="font-weight-bold text-uppercase mb-3"><?php echo $key ?></h4>
                            <div class="row">
                                <?php foreach ($value as $k => $v) { ?>
                                <div class="col-md-3 d-flex">
                                    <a href="card-detail.html" class="box mb-30px">
                                        <div class="box-img">
                                            <img src="<?php echo base_url('FileReader/fetchfile/').'/'.$v->image; ?>">
                                            <span class="tag tag-orange"><i class='bx bx-cake'></i> Birthday</span>
                                        </div>
                                        <div class="box-detail">
                                            <p class="font-weight-bold mb-0"><?php echo $v->name; ?></p>
                                            <p class="small text-primary mb-0">
                                                <i class='bx bx-calendar-alt'></i>
                                                <?php echo formated_date($v->dob); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <br>
                        <div class="alert alert-danger" role="alert">
                          No Data Found..!
                        </div>
                    <?php } ?>
                </div>

                <div id="anniversaryDiv" class="hide">
                    <?php if (!empty($finalAnniversary)) { ?>
                        <div class="mb-4">
                            <?php foreach ($finalAnniversary as $key => $value) { ?>
                            <h4 class="font-weight-bold text-uppercase mb-3"><?php echo $key ?></h4>
                            <div class="row">
                                <?php foreach ($value as $k => $v) { ?>
                                <div class="col-md-3 d-flex">
                                    <a href="card-detail.html" class="box mb-30px">
                                        <div class="box-img">
                                            <img src="<?php echo base_url('FileReader/fetchfile/').'/'.$v->image; ?>">
                                            <span class="tag tag-yellow"><i class='bx bx-heart'></i> Anniversary</span>
                                        </div>
                                        <div class="box-detail">
                                            <p class="font-weight-bold mb-0"><?php echo $v->name; ?></p>
                                            <p class="small text-primary mb-0">
                                                <i class='bx bx-calendar-alt'></i>
                                                <?php echo formated_date($v->anniversary); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <br>
                        <div class="alert alert-danger" role="alert">
                          No Data Found..!
                        </div>
                    <?php } ?>
                </div>


                <div id="festivalDiv" class="hide">
                    <?php if (!empty($festival)) { ?>
                        <div class="mb-4">
                            <?php foreach ($festival as $key => $value) { ?>
                            <h4 class="font-weight-bold text-uppercase mb-3"><?php echo $key ?></h4>
                            <div class="row">
                                <?php foreach ($value as $k => $v) { ?>
                                <div class="col-md-3 d-flex">
                                    <a href="card-detail.html" class="box mb-30px">
                                        <div class="box-img">
                                            <img src="<?php echo base_url('FileReader/fetchfile/').'/'.$v->thumbnail; ?>">
                                            <?php if ($v->type == "FESTIVAL") { ?>
                                               <span class="tag tag-orange"><i class='bx bx-heart'></i> <?php echo $v->type; ?></span>
                                            <?php } else { ?>
                                                <span class="tag tag-yellow"><i class='bx bx-heart'></i> <?php echo $v->type; ?></span>
                                            <?php } ?>
                                            
                                        </div>
                                        <div class="box-detail">
                                            <p class="font-weight-bold mb-0"><?php echo $v->name; ?></p>
                                            <p class="small text-primary mb-0">
                                                <i class='bx bx-calendar-alt'></i>
                                                <?php echo formated_date($v->eventdate); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <br>
                        <div class="alert alert-danger" role="alert">
                          No Data Found..!
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">
    $(document).ready(function() {
        var inputValue =  $('input[type="radio"]:checked').val();
        if (inputValue == "birthday") {
            $('#birthdayDiv').show();
            $('#anniversaryDiv').hide();
            $('#festivalDiv').hide();
        } else if (inputValue == "anniversary") {
            $('#birthdayDiv').hide();
            $('#anniversaryDiv').show();
            $('#festivalDiv').hide();
        } else {
            $('#birthdayDiv').hide();
            $('#anniversaryDiv').hide();
            $('#festivalDiv').show();
        } 
    });

     $('input[type="radio"]').on('click', function(){
            var inputValue = $(this).attr("value");
            
            if (inputValue == "birthday") {
                $('#birthdayDiv').show();
                $('#anniversaryDiv').hide();
                $('#festivalDiv').hide();
            } else if (inputValue == "anniversary") {
                $('#birthdayDiv').hide();
                $('#anniversaryDiv').show();
                $('#festivalDiv').hide();
            } else {
                $('#birthdayDiv').hide();
                $('#anniversaryDiv').hide();
                $('#festivalDiv').show();
            }
        });
</script>
<?php echo $this->endSection() ?>