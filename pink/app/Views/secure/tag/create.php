<?php echo $this->extend('layouts/backend/app') ?>

<?php echo $this->section('breadcrumb') ?>
<section class="bradcr bradcr-long">
	<div class="container-fluid mw-1200">
		<div class="row">
			<div class="col-6">
				<p class="breadcrumb-head">Tag</p>
			</div>
			<div class="col-6">
				<div class="breadcrumb-cstm text-right">
					<a href="#">Secure</a>
					<a href="#" class="breadcrumb-item">Tag</a>
					<a href="#" class="breadcrumb-item">Create</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->endSection() ?>


<?php echo $this->section('content') ?>
<div class="container-fluid">
    <div class="box">
        <div class="box-head">
            <h1 class="box-title">Add Tag <a href="<?php echo base_url('secure/Tag') ?>" class="btn btn-primary btn-sm float-right"><i class='bx bx-list-ul'></i></a></h1>
        </div>
        <div class="box-body">
            <?php if (session()->has('message') || session()->has('success_message')) : ?>
            <?php
                $class  = session()->has('success_message') ? 'success' : 'warning';
                $msg    = session()->has('success_message') ? 'success_message' : 'message';
            ?>
            <div class="alert alert-<?php echo $class ?> alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata($msg); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif ?>
            <?php echo form_open('', ['id' => 'createForm']) ?>
                <?php echo $this->include('secure/tag/form') ?>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<?php echo $this->endSection() ?>     