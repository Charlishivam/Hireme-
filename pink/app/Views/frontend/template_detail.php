<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('breadcrumb') ?>
	<section class="breadcrumb">
	    <div class="container">
	        <h1 class="font-weight-bold"> <?php echo $template->name; ?> </h1>
	        <h5 class="mb-4">Celebrate each year of their life with a customized DIY card. Design with our card maker,
	            print, download or send online!</h5>
	        <div class="breadcrumb-link">
	            <a href="<?php echo base_url('/') ?>">Home</a>
	            <a href="#"><?php echo $template->name; ?></a>
	        </div>
	    </div>
	</section>
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<input type="hidden" name="rawImageSrc" id="rawImageSrc" value="<?php echo !empty($template->thumbnail) ? base_url('FileReader/fetchfile/'.$template->thumbnail) : '' ?>">
<div class="container my-5">
    <div class="row">
        <div class="col-md-5">
            <div class="detail-img">
                <img class="img-fluid" src="<?php echo !empty($template->thumbnail) ? base_url('FileReader/fetchfile/'.$template->thumbnail) : '' ?>" id="image_path">
                <div class="detail-img-text-top msgpos" id="msgposcnt1">
                    <p class="mb-0" id="topMsg"></p>
                </div>
                <div class="detail-img-text-bottom msgpos" id="msgposcnt2">
                    <p class="mb-0" id="bottomMsg"></p>
                </div>
            </div>
        </div>
        <div class="col-md-7 filter-result-div">
            <h4 class="font-weight-bold mb-4"><?php echo $template->name; ?></h4>
            <p>
               <?php echo $template->description; ?>
            </p>

            <?php echo form_open('frontend/template/msgdisplay', ['id' => 'messageForm']) ?>
                <div class="message-box mb-4 mt-4">
                    <div class="form-group mb-0">
                        <h6 class="mb-2" for="custom_message">Custome Message</h6>
                        <textarea class="form-control" id="custom_message" rows="2"
                            placeholder="Please enter Message (0 to 200 Word)" name="msg"></textarea>
                            <input type="hidden" name="imgpath" value="<?php echo base_url('FileReader/fetchfile/'.$template->thumbnail); ?>">
                            <br>
                            <label>Enter Font size:</label>
                            <input class="form-control" type="text" name="fontsize" id="fontsize" required="required" min="10" max="20">
                    </div>
                    <div class="mb-4 hide" id="msg_position">
                        <h6 class="mb-2">Message Position</h6>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="msgpos1" name="msgpos" class="custom-control-input position" value="top">
                            <label class="custom-control-label" for="msgpos1">Top</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="msgpos2" name="msgpos" class="custom-control-input position" value="bottom">
                            <label class="custom-control-label" for="msgpos2">Bottom</label>
                        </div>
                    </div>
                    <!-- <button type="submit">submit</button> -->
                </div>
            <?php echo form_close() ?>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='bx bxl-whatsapp'></i> Whatsapp
                        </button>
                        <div class="dropdown-menu w-100">
                            <!--<a class="dropdown-item" href="#">Send to All</a>-->
                            <a href="https://api.whatsapp.com/send?phone=&text=<?php //urlencode('Hi hello') ?>http://pink7.vtddmc.com/frontend/template/details/<?php echo $template->slug ?>" target="_blank">Share to Whatsapp</a>
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo !empty($template->thumbnail) ? base_url('FileReader/fetchfile/'.$template->thumbnail) : '' ?>" target="_blank">Share to Facebook</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='bx bxs-share-alt'></i> Share
                        </button>
                        <div class="dropdown-menu w-100" data-href="https://developers.facebook.com/docs/plugins/">
                            <a target="_blank" class="dropdown-item fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"><i class='bx bxl-facebook'></i> Facebook</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a id="download_img" class="btn btn-light w-100" href="<?php echo base_url('FileReader/fetchfile/'.$template->thumbnail) ?>" download></i> Download
                    </a>
                </div>
            </div>
            
            <!-- <div class="row mb-4">
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='bx bxl-whatsapp'></i> Whatsapp
                        </button>
                        <div class="dropdown-menu w-100">
                            <a class="dropdown-item" target="_blank" href="https://wa.me/918882924722">Send to All</a>
                            <a class="dropdown-item" target="_blank" href="https://api.whatsapp.com//send?text=<?php echo base_url('assets/frontend/img/testing/7.jfif'); ?>">new</a>
                            <a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?phone=918882924722&text=Hi%20how%20are20you?">new</a>
                            <a class="dropdown-item" href="#">Chose from Friend list</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='bx bxs-share-alt'></i> Share
                        </button>
                        <div class="dropdown-menu w-100" data-href="https://developers.facebook.com/docs/plugins/">
                            <a target="_blank" class="dropdown-item fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"><i class='bx bxl-facebook'></i> Facebook</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a id="download_img" class="btn btn-light w-100" href="<?php echo base_url('FileReader/fetchfile/'.$template->thumbnail) ?>" download></i> Download
                    </a>
                </div>
            </div> -->

            <ul class="text-muted">
                <li>Schedule & send anytime, 100% Assured Delivery.</li>
                <li>Send to Whatsapp, Facebook, etc.</li>
                <li>Instant Live Preview with advanced customization.</li>
                <li>Card with personalized message inside.</li>
            </ul>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script>
    $(document).ready(function () {
        $("input[name$=msgpos]").click(function () {
            var test = $(this).val();
            var source_text = $("#source_text").val();
            $('#topMsg').html(source_text);
            $('#bottomMsg').html(source_text);
            $(".msgpos").hide();
            $("#msgposcnt" + test).show();
        })
    })
</script>

<!-- facebook sdk script -->
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $('#custom_message').on('keyup', function(){
        var msg = $('#custom_message').val();
        if (msg.length > 0) {
            $('#msg_position').show();
        } else {
            $('#msg_position').hide();
        }
    });

    $('.position').on('click',function(){
        // var src = $('#image_path').attr('src');
        var src = $('#rawImageSrc').val();
        // console.log(src);return false;
        var msg = $('#custom_message').val();
        var fontsize = $('#fontsize').val();
        var position= $('input[type="radio"]:checked').val();
        let data = {
            'src'       : src,
            'msg'       : msg,
            'position'  : position,
            'fontsize'  : fontsize,
        };
        data[token_name] = token_val;
        $.post(base_url+'frontend/template/getmsg',data,function(response){
            regenToken();
            $('#image_path').attr('src',response);
            $('#download_img').attr('href',response);
        });
    });
</script>

<?php echo $this->endSection() ?>