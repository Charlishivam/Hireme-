<?php echo $this->section('style') ?>
<link rel="stylesheet" type="text/css" href="<?php echo asset('plugin/imagecrop/pixelarity.css?ver=1.2') ?>">
<?php echo $this->endSection() ?>

<div class="form-group row">
	<label for="thumbnail" class="col-sm-2 col-form-label"><?php echo !empty($label) ? $label : 'Thumbnail' ?></label>
	<div class="col-sm-6">
		<input type="file" class="form-control" id="file">
	</div>
	<div class="col-sm-4">
		<img id="result" class="img-fluid" src="<?php echo !empty($item->thumbnail) ? base_url('FileReader/fetchfile/'.$item->thumbnail) : '' ?>">
		<input type="hidden" name="thumbnail" id="thumbnail">
	</div>
</div>

<?php echo $this->section('script') ?>
<script type="text/javascript" src="<?php echo asset('plugin/imagecrop/pixelarity-faceless.js?ver=1.2') ?>"></script>
<script type="text/javascript" src="<?php echo asset('plugin/imagecrop/script-faceless.js') ?>"></script>
<?php echo $this->endSection() ?>