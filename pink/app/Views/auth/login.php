<?php echo $this->extend('layouts/backend/auth') ?>

<?php echo $this->section('content') ?>
<div class="container-fluid login-section p-0" >
	<div class="row m-0">
		<div class="col-md-5 login-left-div">
			<div class="login-form-div">
				<?php echo auth_logo() ?>
				<h4><?php echo $title; ?></h4>
				<p>Welcome to <strong> <?php echo APP_NAME ?></strong></p>
				<?php echo form_open('BackendAuth/Login', ['class' => 'login-form', 'id' => 'login-form', 'autocomplete' => 'off', 'autofill' => 'off']) ?>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" placeholder="Username" class="form-control" id="username"
						aria-describedby="username">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" placeholder="Password" class="form-control" id="password">
					</div>
					<div class="form-group form-check">
						<!-- <input type="checkbox" class="form-check-input" id="remember" name="remember"> -->
						<!-- <label class="form-check-label" for="remember">Remember me </label> -->
						<a href="<?php echo base_url('backendauth/password') ?>" class="float-right">Forgot password?</a>&nbsp;
					</div>
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
					<button id="login" type="submit" name="submit" value="submit" class="btn btn-primary w-100">Sign in</button>
				<?php echo form_close() ?>
			</div>
		</div>
		<div class="col-md-7 login-right-div p-0">
			<?php echo auth_background() ?>
		</div>
	</div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">
	$(document).on('click', '#login', function (e) {
		//e.preventDefault();
		$('.error').remove();
		var enc_con     = new JSEncrypt();
		enc_con.setPublicKey(window.atob(rsaPrivKey));
        var password 	 = $('#password').val();
		var username 	 = $('#username').val();
        if (username.length == 0) {
			$('#username').after('<span class="text-danger error">Username is required</span>');
			return false;
		}
		if (password.length == 0) {
			$('#password').after('<span class="text-danger error">Password is required</span>');
			return false;
		}
		password = window.btoa(password);
        password = enc_con.encrypt(password);
        $('#password').val(password);
	})
</script>
<?php echo $this->endSection() ?>