<?php echo $this->section('style') ?>
<link rel="stylesheet" type="text/css" href="<?php echo asset('plugin/imagecrop/pixelarity.css?ver=1.2') ?>">
<?php echo $this->endSection() ?>

<div class="form-group form-row">
	<div class="col-sm-8">
		<div class="file-input box-shadow">
			<input type="file" id="file" autocomplete="off" autofill="off" accept="image/png, image/gif, image/jpeg, image/jpg"> 
			<span class="button">Choose</span> 
			<span data-js-label="" class="label">Preview Image </span>
		</div>
	</div>
	<div class="col-sm-4">
		<img id="result" class="img-fluid" src="<?php echo !empty($item->thumbnail) ? base_url('filereader/fetchfile/'.$item->thumbnail) : '' ?>">
		<input type="hidden" name="thumbnail" id="thumbnail">
	</div>
</div>

<?php echo $this->section('script') ?>
<script type="text/javascript" src="<?php echo asset('plugin/imagecrop/pixelarity-faceless.js?ver=1.2') ?>"></script>
<script type="text/javascript" src="<?php echo asset('plugin/imagecrop/script-faceless.js') ?>"></script>
<?php echo $this->endSection() ?>