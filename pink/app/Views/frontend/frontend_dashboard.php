<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('content') ?>
<section class="home-slide">
    <div class="container">
        <div class="row">
            <div class="col-md-8 d-flex justify-content-center" style="flex-wrap: wrap; flex-direction: column;">
                <h1 class="font-weight-bold text-white mb-0">Celebrate life with the</h1>
                <h1 class="mb-3 font-weight-bold text-white">perfect card or invitation</h1>
                <h4 class="mb-4 text-white">Customize, download, print & send online.</h4>
                <h5 class="text-white pb-5">Create a greeting card that your friends and family will Us! Choose from
                    our library of
                    stunning layouts to create an original and thoughtful card with ease.</h5>
            </div>
            <div class="col-md-4">
                <img src="<?php echo asset('frontend/img/freelancer.png') ?>" class="w-100 d-none d-md-block" />
            </div>
        </div>
    </div>
</section>


<section class="home-about">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 d-flex align-items-center">
                <div>
                    <h1 class="sub-title mb-4">Why Us</h1>
                    <h3 class="mb-4 font-weight-bold">Create a greeting card your friends and family</h3>
                    <p>There’s nothing better than receiving a heartfelt greeting card from a friend or loved one.
                        Forget
                        generic cards that will be easily discarded, allow Us to unleash your creative potential and
                        create a greeting card that will be cherished.</p>
                    <p>Our online design tool allows you to create personalized greetings cards for every occasion.
                        Choose from our library of hundreds of beautifully designed layouts and customize them to
                        your liking.</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon-bx-wraper style-3 m-b30 box-hover wow fadeInUp mb-30px">
                            <div class="icon-bx-sm radius bgl-primary">
                                <a class="icon-cell" href="/#">
                                    <img src="<?php echo asset('frontend/img/home-icona.png') ?>" />
                                </a>
                            </div>
                            <div class="wraper-effect"></div>
                            <div class="icon-content" style="min-height: 85px;">
                                <h4 class="dlab-title m-b15">Unlimited Access</h4>
                                <p class="mb-0">Choose from thousands of ecards and printable cards.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-bx-wraper style-3 m-b30 box-hover wow fadeInUp mb-30px">
                            <div class="icon-bx-sm radius bgl-primary">
                                <a class="icon-cell" href="/#">
                                    <img src="<?php echo asset('frontend/img/home-icon2.png') ?>" />
                                </a>
                            </div>
                            <div class="wraper-effect"></div>
                            <div class="icon-content" style="min-height: 85px;">
                                <h4 class="dlab-title m-b15">Plan Ahead</h4>
                                <p class="mb-0">Schedule cards up to a year in advance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-bx-wraper style-3 m-b30 box-hover wow fadeInUp mb-30px">
                            <div class="icon-bx-sm radius bgl-primary">
                                <a class="icon-cell" href="/#">
                                    <img src="<?php echo asset('frontend/img/home-icon3.png') ?>" />
                                </a>
                            </div>
                            <div class="wraper-effect"></div>
                            <div class="icon-content" style="min-height: 85px;">
                                <h4 class="dlab-title m-b15">Never Forget</h4>
                                <p class="mb-0">We'll remind you of important birthday and anniversaries.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-bx-wraper style-3 m-b30 box-hover wow fadeInUp mb-30px">
                            <div class="icon-bx-sm radius bgl-primary">
                                <a class="icon-cell" href="/#">
                                    <img src="<?php echo asset('frontend/img/home-icon4.png') ?>" />
                                </a>
                            </div>
                            <div class="wraper-effect"></div>
                            <div class="icon-content" style="min-height: 85px;">
                                <h4 class="dlab-title m-b15">Add a Gift</h4>
                                <p class="mb-0">Attach a gift card to any ecard.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <h1 class="sub-title mb-2">Upcoming Events</h1>
    <h3 class="mb-5 font-weight-bold">Create a greeting card your friends and family</h3>
    <div class="row">
        <?php foreach ($categeory as $cat) { ?>
            <div class="col-md-4">
                <a href="<?php echo base_url('templates').'?q='.$cat->slug; ?>" class="category-box box-shadow mb-30px">
                    <img class="category-box-img" src="<?php echo !empty($cat->thumbnail)? base_url('FileReader/fetchfile/'.$cat->thumbnail) : '' ?>">
                    <div class="category-box-overlay"></div>
                    <div class="category-box-detail">
                        <h1 class="mb-2"><?php echo $cat->name; ?></h1>
                        <p class="text-muted mb-2"><?php echo $cat->description; ?></p>
                        <span class="tag tag-orange tag-orange-wa"><?php echo $cat->icon; ?> Custom Cards</span>
                    </div>
                </a>
            </div>
        <?php } ?>

<!-- <section class="pt-5" style="border-top: 1px dashed #f2f1f1; background: #fef9f2;">
    <div class="container">
        <h1 class="sub-title mb-2">Recent added Greeting Card</h1>
        <h3 class="mb-5 font-weight-bold">Create a greeting card your friends and family</h3>
        <div class="owl-carousel owl-theme" id="owl-carousel-1">
            <div class="item">
                <a href="card-detail.html" class="box mb-30px">
                    <div class="box-img">
                        <img src="img/greeting/1.jfif">
                        <span class="tag tag-orange">Bestseller</span>
                    </div>
                    <div class="box-detail">
                        <p class="font-weight-bold mb-0">Birthday Present</p>
                        <p class="small mb-0">Online Greeting Cards</p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="card-detail.html" class="box mb-30px">
                    <div class="box-img">
                        <img src="img/greeting/2.jfif">
                        <span class="tag tag-yellow">New</span>
                    </div>
                    <div class="box-detail">
                        <p class="font-weight-bold mb-0">Birthday Present</p>
                        <p class="small mb-0">Online Greeting Cards</p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="card-detail.html" class="box mb-30px">
                    <div class="box-img">
                        <img src="img/greeting/3.jfif">
                        <span class="tag tag-yellow">New</span>
                    </div>
                    <div class="box-detail">
                        <p class="font-weight-bold mb-0">Birthday Present</p>
                        <p class="small mb-0">Online Greeting Cards</p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="card-detail.html" class="box mb-30px">
                    <div class="box-img">
                        <img src="img/greeting/4.jfif">
                        <span class="tag tag-yellow">New</span>
                    </div>
                    <div class="box-detail">
                        <p class="font-weight-bold mb-0">Birthday Present</p>
                        <p class="small mb-0">Online Greeting Cards</p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="card-detail.html" class="box mb-30px">
                    <div class="box-img">
                        <img src="img/greeting/5.jfif">
                        <span class="tag tag-yellow">New</span>
                    </div>
                    <div class="box-detail">
                        <p class="font-weight-bold mb-0">Birthday Present</p>
                        <p class="small mb-0">Online Greeting Cards</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section> -->

<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script>
    $(document).ready(function () {
        $("input[name$=msgpos]").click(function () {
            var test = $(this).val();
            $(".msgpos").hide();
            $("#msgposcnt" + test).show();
        })
    })
</script>

<?php echo $this->endSection() ?>