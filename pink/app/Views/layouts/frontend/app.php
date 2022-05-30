<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->

    <!-- for facebook api -->
    <!--<meta property="og:url"           content="https://www.your-domain.com/your-page.html" />-->
    <meta property="og:url"           content="http://pink7.vtddmc.com/frontend/template/details/diwali-template" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Share Template into Social Site TemplateZone TESTING" />
    <meta property="og:description"   content="Share image on whatsapp" />
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:image" content="<?php echo !empty($template->thumbnail) ? base_url('FileReader/fetchfile/'.$template->thumbnail) : '' ?>" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('frontend/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/common.css') ?>">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php //echo asset('plugin/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?php //echo asset('plugin/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?php //echo asset('plugin/OwlCarousel2-2.3.4/docs/assets/css/animate.css') ?>" />

    <?php echo $this->renderSection('style') ?>
    <title><?php echo APP_NAME ?> <?php echo isset($title) ? ' | ' . $title : '' ?></title>
</head>

<body>
    <?php echo $this->include('partials/overlay') ?>
    <?php if (empty(user())): ?>
        <?php echo $this->include('partials/frontend/authentication_model') ?>
    <?php endif ?>
    <?php echo $this->include('partials/frontend/navbar') ?>
    <?php echo $this->renderSection('breadcrumb') ?>
    <?php echo $this->renderSection('content') ?>
    <?php echo $this->include('partials/frontend/footer') ?>
    
    <div id="regentokencontainer"></div>
    <div id="snackbar"></div>

    <script src="<?php echo asset('js/jquery.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="<?php echo asset('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo asset('frontend/js/main.js?ver=1.2') ?>"></script>
    <!--<script src="<?php //echo asset('plugin/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') ?>"></script> -->
    <script src="<?php echo asset('js/common.js?ver=1.2') ?>"></script>
    <script src="<?php echo asset('js/jsencrypt.js') ?>"></script>

    <script src="<?php echo asset('js/sweetalert.js') ?>"></script>
    <!--<script src="<?php //echo asset('js/vue.min.js') ?>"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> 

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (empty(user())): ?>
    <script type="text/javascript" src="<?php echo asset('frontend/js/auth.js?ver=1.2') ?>"></script>
    <?php endif ?>
    <script type="text/javascript">
        var base_url = '<?php echo base_url() ?>/';
        var token_name = '<?php echo csrf_token(); ?>';
        var token_val = '<?php echo csrf_hash(); ?>';
        var page_limit =  parseInt('<?php echo PAGE_LIMIT_TEMP ?>');
        var page_limit_list =  parseInt('<?php echo PAGE_LIMIT ?>');
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.get('<?php echo base_url('frontend/dashboard/navbarlist') ?>', function(response){
                $.each(response.celibration,function(i,v){
                    $('#celibration').append('<a class="dropdown-item" href="<?php echo base_url('templates') ?>'+'?q='+v.slug+'">'+v.name+'</a>')
                });
                $.each(response.festival,function(i,v){
                     $('#festival').append('<a class="dropdown-item" href="<?php echo base_url('templates') ?>'+'?q='+v.slug+'">'+v.name+'</a>')
                });
            });
        });
    </script>
    <?php echo $this->renderSection('script') ?>
</body>

</html>