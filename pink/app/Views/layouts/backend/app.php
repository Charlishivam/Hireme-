<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo asset('backend/css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo asset('css/common.css') ?>">

  <link href='<?php echo asset('plugin/boxicons/css/boxicons.min.css') ?>' rel='stylesheet'>
  <?php echo $this->renderSection('style') ?>
  <title><?php echo APP_NAME ?> <?php echo isset($title) ? ' | ' . $title : '' ?></title>
</head>

<body>
    <?php echo $this->include('partials/overlay') ?>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class='bx bxs-right-arrow'></i>
        </a>
        <?php echo $this->include('partials/backend/navbar') ?>
        <main class="page-content">
            <?php echo $this->include('partials/backend/topnav') ?>
            <?php echo $this->renderSection('breadcrumb') ?>
            <section class="body-main">
                <?php echo $this->renderSection('content') ?>
            </section>
            <footer class="text-center footer">
                <div class="">
                    <small> Copyright © <?php echo date('Y') ?> <strong> <?php echo APP_NAME ?></strong> | All Rights Reserved </small>
                </div>
            </footer>
        </main>
    </div>
    <div id="regentokencontainer"></div>

    <script src="<?php echo asset('js/jquery.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="<?php echo asset('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo asset('backend/js/main.js') ?>"></script>
    <script src="<?php echo asset('js/common.js') ?>"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> -->
    <script src="<?php echo asset('js/vue.min.js') ?>"></script>
    <script type="text/javascript">
        var base_url = '<?php echo base_url() ?>/';
        var token_name = '<?php echo csrf_token(); ?>';
        var token_val = '<?php echo csrf_hash(); ?>';
        var page_limit =  parseInt('<?php echo PAGE_LIMIT ?>');
    </script>
    <?php echo $this->renderSection('script') ?>
</body>

</html>