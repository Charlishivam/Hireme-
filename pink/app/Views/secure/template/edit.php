<?php echo $this->extend('layouts/backend/app') ?>

<?php echo $this->section('breadcrumb') ?>
<?php //echo '<pre>'; print_r($item);die; ?>
<section class="bradcr bradcr-long">
	<div class="container-fluid mw-1200">
		<div class="row">
			<div class="col-6">
				<p class="breadcrumb-head">Template</p>
			</div>
			<div class="col-6">
				<div class="breadcrumb-cstm text-right">
					<a href="#">Secure</a>
					<a href="#" class="breadcrumb-item">Template</a>
					<a href="#" class="breadcrumb-item"><?php echo $item->name ?></a>
					<a href="#" class="breadcrumb-item">Edit</a>
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
            <h1 class="box-title">Edit Template <a href="<?php echo base_url('secure/template') ?>" class="btn btn-primary btn-sm float-right"><i class='bx bx-list-ul'></i></a></h1>
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
            <?php echo form_open('', ['id' => 'updateForm']) ?>
                <?php echo $this->include('secure/template/form') ?>
                <input type="hidden" name="id" value="<?php echo $item->id ?>">
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>
