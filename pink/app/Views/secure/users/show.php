<?php echo $this->extend('layouts/backend/app') ?>

<?php echo $this->section('breadcrumb') ?>
<section class="bradcr bradcr-long">
	<div class="container-fluid mw-1200">
		<div class="row">
			<div class="col-6">
				<p class="breadcrumb-head"><?php echo ucwords($type) ?></p>
			</div>
			<div class="col-6">
				<div class="breadcrumb-cstm text-right">
					<a href="#">Secure</a>
					<a href="#" class="breadcrumb-item"><?php echo ucwords($type) ?></a>
					<a href="#" class="breadcrumb-item"><?php echo $item->name ?></a>
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
            <div class="row">
                <div class="col-md-4">
                    <h1 class="box-title"><?php echo ucwords($type) ?></h1>
                </div>
                <div class="col-md-8">
                	<div class="row">
                		<div class="col-md-12">
                            <a type="button" href="<?php echo base_url('secure/user/users') ?>" class="btn btn-primary btn-sm float-right"><i class='bx bx-list-ul'></i></a>
                        </div>
                	</div>
                </div>
            </div>
        </div>
        <div class="box-body">
        	<div class="form-group row">
        		<label for="" class="col-sm-2 col-form-label">Name</label>
        		<div class="col-sm-4">
        			<p class="mb-0"><?php echo $item->name ?></p>
        		</div>
        		<label for="" class="col-sm-2 col-form-label">Email</label>
        		<div class="col-sm-4">
        			<p class="mb-0"><?php echo $item->email ?></p>
        		</div>
        	</div>
        	<hr>
        	<div class="form-group row">
        		<label for="" class="col-sm-2 col-form-label">Mobile</label>
        		<div class="col-sm-4">
        			<p class="mb-0"><?php echo $item->mobile ?></p>
        		</div>
        		<label for="" class="col-sm-2 col-form-label">Status</label>
        		<div class="col-sm-4">
        			<span class="<?php echo $item->status == 'ENABLE' ? 'label-light-success' : 'label-light-danger' ?>"><?php echo $item->status ?></span>
        		</div>
        	</div>
        	<hr>
        	<div class="form-group row">
        		<label for="" class="col-sm-2 col-form-label">Profile Status</label>
        		<div class="col-sm-4">
        			<p class="mb-0"><?php echo profile_status($item->profile_status) ?></p>
        		</div>
        		<label for="" class="col-sm-2 col-form-label">Thumbnail</label>
        		<div class="col-sm-4">
        			<?php
        				$image = !empty($item->thumbnail) ? file_path($item->thumbnail) : default_user_thumbnail();
        			?>
        			<img src="<?php echo $image ?>" class="img-fluid">
        		</div>
        	</div>
        	<?php if (!empty($item->profile_data)): ?>
        	<hr>
        	<div class="form-group row">
        		<label for="" class="col-sm-2 col-form-label">Profile Data</label>
        		<div class="col-sm-10">
        			<ul>
        				<?php foreach ($item->profile_data->user_info as $k => $v): ?>
        				<li><strong><?php echo strtoupper($k) ?>:</strong> <?php echo $v ?></li>
        				<hr>
        				<?php endforeach ?>
                        <?php foreach ($item->profile_data->company_info as $k => $v): ?>
                        <li><strong><?php echo strtoupper($k) ?>:</strong> <?php echo $v ?></li>
                        <hr>
                        <?php endforeach ?>
        			</ul>
        		</div>
        	</div>
        	<?php endif ?>
        	<hr>
        	<?php echo form_open() ?>
        	<div class="form-group row">
        		<label for="" class="col-sm-2 col-form-label">Account Status</label>
        		<div class="col-sm-10">
        			<select class="form-control custom-select" id="status" name="status">
        				<option disabled="">Select Status</option>
        				<option value="ENABLE" <?php echo isset($item) && $item->status == 'ENABLE' ? 'selected' : '' ?>>ENABLE</option>
        				<option value="DISABLE" <?php echo isset($item) && $item->status == 'DISABLE' ? 'selected' : '' ?>>DISABLE</option>
        				<option value="BANNED" <?php echo isset($item) && $item->status == 'BANNED' ? 'selected' : '' ?>>BANNED</option>
        			</select>
        			<?php if (isset($validation) && $validation->hasError('status')): ?>
        			<span class="text-danger"><?php echo $validation->getError('status'); ?></span>
        			<?php endif ?>
        		</div>
        	</div>
        	<button type="submit" name="submit" value="submit" class="btn btn-primary pl-4 pr-4 mt-3">Submit</button>
        	<?php echo form_close() ?>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>