<?php echo $this->extend('layouts/backend/app') ?>

<?php echo $this->section('breadcrumb') ?>
<section class="bradcr bradcr-long">
	<div class="container-fluid mw-1200">
		<div class="row">
			<div class="col-6">
				<p class="breadcrumb-head">Dashboard</p>
			</div>
			<div class="col-6">
				<div class="breadcrumb-cstm text-right">
					<a href="#">Home</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>

<div class="container-fluid">
	
</div>

<?php echo $this->endSection() ?>