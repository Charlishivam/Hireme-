$(document).on('change', '#file', function (e) {
	$('.error').remove();
	var img = e.target.files[0];
	if(!pixelarity.open(img, false, function(res){
		$("#result").attr("src", res);
		var b64_img = res.split('base64,');
		var thumbnail = b64_img[1];
		$('#thumbnail').val(thumbnail);
	}, "jpg", 0.7)){
		$('#file').after('<span class="error text-danger">Whoops! Only image allowed to upload!</span>');
	}
})