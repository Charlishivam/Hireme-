var auth = new Vue({
	el: '#authModel',
	data: {
		email : '',
		password : '',
		nw_email : '',
		nw_password : '',
		nw_fullname :'',
		nw_mobile :'',
		nw_agree : '',
		nw_otp : '',
		otp_button_text : 'Send OTP',
		submit_disable : true,
		login_disable : true,
		reset_disable : true,
		show_loader : false,
		
		show_login : true,
		show_register : false,
		show_reset : false,
		show_otp_loader : false,
		show_otp_div : false,
		show_otp_button : false,
		show_verify_loader : false,
		enable_otp_btn : true,

		err_agree : '',
		err_email : '',
		err_password : '',
		err_fullname : '',
		err_nwemail : '',
		err_mobile : '',
		err_nwpassword : '',
		login_error : '',
		reset_error : '',
		register_error : '',

		err_nw_login_type	: '',
		nw_login_type		: '',
	},
	watch: {
		email:        function() {
			this.email    = this.email.replace(/[^0-9a-zA-Z\@\-\.\_]+/g, '').substring(0, 100).trim();
			this.setLoginDisable();
			this.setResetDisable();
		},
		password:        function() {
			this.password    = this.password.replace(/[^0-9a-zA-Z\@\-\.\#\,\$\%\&\*]+/g, '').substring(0, 20).trim();
			this.setLoginDisable();
		},
		nw_fullname:        function(v) {
			this.nw_fullname    = v.replace(/[^a-zA-Z\s\.]+/g, '').replace(/[\.]+/g, '.').replace(/[\s]+/g, ' ').replace(/[\,]+/g, ',').substring(0, 100);
            this.setRegisterDisable();
		},
		nw_mobile:        function() {
			this.nw_mobile    = this.nw_mobile.replace(/[^0-9]+/g, '').substring(0, 10).trim();
			this.setRegisterDisable();
		},
		nw_email:        function() {
			this.nw_email    = this.nw_email.replace(/[^0-9a-zA-Z\@\-\.\_]+/g, '').substring(0, 100).trim();
			if (this.nw_email.length > 10) {
				// this.show_otp_button = true;
			}else{
				this.show_otp_button = false;
			}
			this.setRegisterDisable();
		},
		nw_otp:        function() {
			this.nw_otp    = this.nw_otp.replace(/[^0-9]+/g, '').substring(0, 8).trim();
		},
		nw_password:        function() {
			this.nw_password    = this.nw_password.replace(/[^0-9a-zA-Z\@\-\.\#\,\$\%\&\*]+/g, '').substring(0, 20).trim();
			this.setRegisterDisable();
		}
	},
	methods: {
		doLogin: function(){
			this.show_loader = true;
			this.login_disable = true;
			var enc_con     = new JSEncrypt();
			enc_con.setPublicKey(window.atob(rsaPrivKey));
			var salt 		 = '';
			for (var i = 0; i < 6; i++) {
				salt += Math.floor(Math.random() * 10);
			}

			var password = window.btoa(this.password +':'+ salt);
			password = enc_con.encrypt(password);
			document.cookie = "uauth_cook="+salt+";path=/";
			var data = {
				username: this.email,
				password : password,
			};
			data[token_name] = token_val;
			$.post(base_url+'auth/login/user', data, function(response) {
				token_val = response.token;
				auth.show_loader = false;
				if (response.status == 'success') {
					location.href = base_url + '/profile';
				} else {
					auth.login_disable = false;
					auth.login_error = response.message;
				}
			}, 'json').fail(function() {
				auth.login_error = 'Something went wrong!, please try again later';
				regenToken();
				auth.show_loader = false;
				auth.login_disable = false;
			});
		},
		doRegister: function () {
			this.show_loader = true;
			this.submit_disable = true;
			var enc_con     = new JSEncrypt();
			enc_con.setPublicKey(window.atob(rsaPrivKey));
			var salt 		 = '';
			for (var i = 0; i < 6; i++) {
				salt += Math.floor(Math.random() * 10);
			}

			var password = window.btoa(this.nw_password +':'+ salt);
			password = enc_con.encrypt(password);
			document.cookie = "rauth_cook=" + salt;
			var data = {
				fullname 	: this.nw_fullname,
				password 	: password,
				mobile 		: this.nw_mobile,
				username	: this.nw_email,
				type 		: this.nw_login_type,
			};
			data[token_name] = token_val;
			$.post(base_url+'auth/register/user', data, function(response) {
				token_val = response.token;
				auth.show_loader = false;
				if (response.status == 'success') {
					location.href = base_url + 'Frontend/dashboard';
				} else {
					if (response.stage == -1) {
						auth.otp_button_text = 'Send OTP';
						auth.enable_otp_btn = true;
						auth.nw_email = '';
						$('#remail').attr('readonly', false);
						$('.success').remove();
						auth.err_nwpassword = '';
					}
					auth.submit_disable = false;
					auth.register_error = response.message;
				}
			}, 'json').fail(function() {
				auth.submit_disable = false;
				auth.register_error = 'Something went wrong!, please try again later';
				regenToken();
				auth.show_loader = false;
			});
		},
		doReset: function(){
			this.show_loader = true;
			this.reset_disable = true;
			var data = {
				username: this.email,
			};
			data[token_name] = token_val;
			$.post(base_url+'auth/password/reset', data, function(response) {
				token_val = response.token;
				auth.show_loader = false;
				auth.reset_disable = false;
				if (response.status == 'success') {
					auth.reset_error = response.message;
				} else {
					auth.reset_error = response.message;
				}
			}, 'json').fail(function() {
				auth.reset_error = 'Something went wrong!, please try again later';
				regenToken();
				auth.show_loader = false;
				auth.reset_disable = true;
			});
		},
		sendOtp : function () {
			$('.success').remove();
			this.show_otp_loader = true;
			this.enable_otp_btn = false;
			this.register_error = '';
			this.nw_otp = '';
			var data = {
				email : this.nw_email,
			};
			data[token_name] = token_val;
			$.post(base_url+'messenger/pushotp', data, function(response) {
				token_val = response.token;
				auth.show_otp_loader = false;
				if (response.status == 'success') {
					setTimer(0, otpWaitTime, '#genOTP', 'msess_timer');
					$('#remail').after('<small class="success text-success">'+response.message+'</span>');
					auth.show_otp_div = true;
					auth.otp_button_text = 'Resend OTP';
				} else {
					auth.register_error = response.message;
				}
			}, 'json').fail(function() {
				auth.register_error = 'Something went wrong!, please try again later';
				regenToken();
				auth.show_otp_loader = false;
			});	
		},
		verifyOtp : function () {
			$('.success').remove();
			this.show_verify_loader = true;
			this.register_error = '';
			var data = {
				otp : this.nw_otp,
			};
			data[token_name] = token_val;
			$.post(base_url+'messenger/verifyotp', data, function(response) {
				token_val = response.token;
				auth.show_verify_loader = false;
				if (response.status == 'success') {
					$('#remail').attr('readonly', true);
					$('#remail').after('<small class="success text-success">'+response.message+'</span>');
					auth.show_otp_button = false;
					auth.show_otp_div = false;
				} else {
					auth.register_error = response.message;
				}
			}, 'json').fail(function() {
				auth.register_error = 'Something went wrong!, please try again later';
				regenToken();
				auth.show_verify_loader = false;
			});	
		},
		setLoginDisable: function () {
			var valid_email     = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email.trim());
			this.err_email      = this.email.length > 8 && !valid_email ? 'Please enter valid email address' : '';
			this.err_password 	= this.password.length && ! passRegex.test(this.password) ? 'Password should be a combination of alphanumeric and special characters. Should be between 8 to 20 characters.' : '';
			this.login_disable 	= ! valid_email || this.err_password.length > 0;
		},
		setResetDisable: function () {
			var valid_email     = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email.trim());
			this.err_email      = this.email.length > 8 && !valid_email ? 'Please enter valid email address' : '';
			this.reset_disable 	= ! valid_email;
		},
		setRegisterDisable: function () {
			var invalid_name    = this.nw_fullname.trim().length < 2 || this.nw_fullname.trim().length > 60;
            var valid_email     = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.nw_email.trim());
            var invalid_mobile  = Number(this.nw_mobile) < 6000000000 || this.nw_mobile.length != 10;
            var invalid_agree   = this.nw_agree == '' || this.nw_agree == null;

            this.err_fullname   = this.nw_fullname.length > 2 && invalid_name ? 'Name cannot be less than 2 and greater than 60 characters' : '';
            this.err_mobile     = this.nw_mobile.length >= 10 && invalid_mobile ? 'Please enter valid mobile number!' : '';
            this.err_nwemail    = this.nw_email.length > 8 && !valid_email ? 'Please enter valid email address' : '';
            this.err_nwpassword = this.nw_password.length > 0 && ! passRegex.test(this.nw_password.trim()) ? 'Password should be a combination of alphanumeric and special characters. Should be between 8 to 20 characters.' : '';
            //this.err_agree      = invalid_agree ? 'Required' : '';
            this.submit_disable = ! valid_email || invalid_name || invalid_mobile || this.err_nwpassword.length > 0;
            return this.submit_disable;
		}
	},
});