var rsaPrivKey 	= 'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlDWGdJQkFBS0JnUUN6ajBMT0FIcXRldXozUVczaUM5NnU0b2RFVFFlMnp6VFJ2ZUoyby9DWjNvRmcwU0ZiCmc2bGIxT0RRRzlVcXQwVE4rVjB4VENvMWJEQ3dkVzNkSnQzZHdrRklXUG5YOEEwbmI1SjEyZjRIZjdudFBJQkYKRkZsbHRNaVVZSlpSZ3owRHZvdGhnak9qMmNta1ltRnd2N2VhUEhOSWdTMXVxSlpkbE8zeTlaV2RPd0lEQVFBQgpBb0dBZThUR01hVVc2cm1PMmFnYUMvUk9uSkc4MTVHWlBhTjZMeEVLSnVrK0VYSFVFRjVXOWZPOUszV0RPUy9XCk1jbDkvZFJqTG5YbnFrZFhFR3NCUGExcXhDY1dmandSV0M4MGd4NVR3dDhqUzVwSGNtM1dVTi91UU1NYWhWdjEKOFltT0k1VkNSVXI1SWxVOFNXQ280N1pNdUQ4S0tQZjN0cjhDaFBiTFlwNjRVb0VDUVFEZzlLbkZJU29UTDhqUwpWUTUrWGw0T3BQOEZwV2xaZ2NjQm9GUW9UN1ZkWGVTNTZ4cEs2M0hneVIwbHRNbDA1STNoTUo0OU5mL25pb3lIClVmYlFaSW9iQWtFQXpGYlM1emlxTzVjSGZFREpLaklEVlc2ck0xOEUvdEVpQ3BSL3N0VjBZVU5vcTJVTE4rRmEKMXo3OGVGVzRUeVBqNkM4Nk1kUU9LWHM2d2V0UWlZeHJZUUpCQU13VGFRaGF3ODdRSk1FYlJLRERmMVNOdm9VaQp3R1hnNCtiSHlsRWZyb3JiS1NxNDdBdFhlT0hSMFUxcHF2RU9mdC94dVR3U2h1dEl0NS96YlpNMEFrMENRUUNwCmh3OEt6alJOcEF1TnhxSWU0OGRvUlp5N3pnVnk4MGJ1eUN6NXphWDBXOXltOWZuTXJxYVRGYXFZbTJXQ0l5Q2UKTFRCMnpwdkJSbitGQ3htU1JIR0JBa0VBc2VLTjRmaDhWMWVENjhnNkgxdzRzNU9mcE1lVzVpVnVGR1MwZkhUQQpkUGlMd2FNYk9adnhDMnRjdWwzVkoySmcvVEVIYk1WTWl2cmxSMURjT0R2Q3FRPT0KLS0tLS1FTkQgUlNBIFBSSVZBVEUgS0VZLS0tLS0=';
var passRegex 	= /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
var otpWaitTime = 10;

function startProcess(msg = '') {
	$('#overlay').show();
	if (msg.length) {
		$('.load').text(msg);
	}
}

function endProcess() {
	$('#overlay').hide();
	$('.load').text('Processing...');
}

function showAlert(msg = '', cls='danger') {
	popMsg = msg.length ? msg : 'Invalid reqeust';
	$('#snackbar').addClass('show ' + cls).text(popMsg);
	setTimeout(function () {
		$('#snackbar').removeClass('show ' + cls).text('');
	}, 3000)
}

function regenToken() {
	$("#regentokencontainer").load(base_url + 'token/regenerate');
}

function convertToSlug(string, append = false, id)
{
    var slug = string
        .toLowerCase()
        .replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?]/g, 'and')
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
    if (append) {
    	$('#'+id).val(slug);
    }else{
    	return slug;
    }
}

function setTimer(mm, ss, prm, id = 'sess_tmr') {
	var sess_tmr = setInterval(function(){
		$('#' + id).text((mm < 10 ? '0' : '') + mm + ':' + (ss < 10 ? '0' : '') + ss);
		if (ss == 0) {
			mm--;
			ss = 60;
		}
		if (mm == -1) {
			clearInterval(sess_tmr);
			$(prm).attr('disabled', false).removeClass('disabled');
			$('#' + id).html('');
		}
		ss--;
	}, 1000);
}

function round_off(num) {
	return (Math.round(num * 100) / 100).toFixed(2);
}

$(document).on('click', '.delete', function (e) {
	e.preventDefault();
	var r=confirm("Are you sure you want to delete?");
    if (r==false)   {  
    	return false;
    }
    var link = $(this).attr('href');
    location.href = link;
})

$(document).ready(function () {
	$('form').attr('autocomplete', 'off').attr('autofill', 'off');
    $('.form-control').attr('autocomplete', 'off').attr('autofill', 'off');
    $('input').attr('autocomplete', 'off').attr('autofill', 'off');
    $('select').attr('autocomplete', 'off').attr('autofill', 'off');
    $('radio').attr('autocomplete', 'off').attr('autofill', 'off');
    $('checkbox').attr('autocomplete', 'off').attr('autofill', 'off');
});

var splky = [8, 9];
$(document).on('keypress', '#username', function (e) {
	var ky = e.keyCode || e.which || e.charCode;
	if (splky.indexOf(ky) >= 0)
		return true;
	if (/[^0-9a-zA-Z@.]/.test(String.fromCharCode(ky)))
		return false;
});
$(document).on('keypress', '#password', function (e) {
	var ky = e.keyCode || e.which || e.charCode;
	if (splky.indexOf(ky) >= 0)
		return true;
	if (/[^0-9a-zA-Z@#$%&^*()!.,;:]/.test(String.fromCharCode(ky)))
	return false;
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});