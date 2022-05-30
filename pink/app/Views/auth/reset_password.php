<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('content') ?>
<section class="login-section-teacher" id="reset" v-cloak>
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-md-6 d-none d-md-flex signup-img d-flex align-items-center">
                <img src="<?php echo asset('frontend/img/bateacher-3.png') ?>" class="w-100" alt="">
            </div>
            <?php if ($link_expired == FALSE): ?>
                <div class="col-md-6 signup-form">
                    <h3 class="mb-5">Reset Password!</h3>
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
                    <?php echo form_open() ?>
                    <div class="form-group">
                       <input type="email" placeholder=" <?php echo $email ?>" class="form-control box-shadow" readonly>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control box-shadow" name="re_password" id="re_password" placeholder="Password" v-model="re_password" />
                        <p class="small mb-0 text-muted">Password must be at least 8 characters long.</p>
                        <small class="text-danger" v-if="err_repassword.length">{{ err_repassword }}</small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control box-shadow" id="re_conf_password" placeholder="Confirm Password" name="re_conf_password" v-model="re_conf_password" />
                        <p class="small mb-0 text-muted">Password must be at least 8 characters long.</p>
                        <small class="text-danger" v-if="err_conf_repassword.length">{{ err_conf_repassword }}</small>
                    </div>
                    <div class="alert alert-warning" v-if="err_msg.length">
                        {{ err_msg }}
                    </div>
                    <button type="submit" name="submit" value="submit" id="resetnow" class="btn btn-primary w-100 mt-3" :disabled="regenerate_disable ? 'disabled' : false">Submit <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>
                    <p class="text-center mt-5 mb-0">
                        Already a member?
                        <a id="signin-active-link" data-toggle="modal" data-target="#authModel"> Sign In.</a>
                    </p>
                    <?php echo form_close() ?>
                </div>
            <?php else: ?>
                <div class="col-md-6 signup-form">
                    <div class="alert alert-info">
                        <?php echo $message ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">
    var rp = new Vue({
        el: '#reset',
        data: {
            re_password: '',
            re_conf_password: '',
            err_msg : '',
            regenerate_disable: true,
            show_loader : false,

            err_repassword : '',
            err_conf_repassword : '',
        },
        watch: {
            re_password:        function(v) {
                this.re_password    = v.replace(/[^0-9a-zA-Z\@\-\.\#\,\$\%\&\*]+/g, '').substring(0, 20).trim();
                this.setRegenerateDisable();
            },
            re_conf_password:        function(v) {
                this.re_conf_password    = v.replace(/[^0-9a-zA-Z\@\-\.\#\,\$\%\&\*]+/g, '').substring(0, 20).trim();
                this.setRegenerateDisable();
            },
        },
        methods: {
            setRegenerateDisable: function () {
                this.err_repassword = this.re_password.length > 7 && ! passRegex.test(this.re_password) ? 'Password should be a combination of alphanumeric and special characters. Should be between 8 to 20 characters.' : '';
                this.err_conf_repassword = this.re_conf_password.length > 7 && this.re_conf_password != this.re_password ? 'Password not matched' : '';
                this.regenerate_disable = this.err_repassword.length > 0 || this.re_conf_password != this.re_password;
            },
        }
    });
    $(document).on('click', '#resetnow', function (e) {
        //e.preventDefault();
        $('.error').remove();
        var enc_con     = new JSEncrypt();
        enc_con.setPublicKey(window.atob(rsaPrivKey));
        var re_password      = $('#re_password').val();
        var salt         = '';
        for (var i = 0; i < 6; i++) {
            salt += Math.floor(Math.random() * 10);
        }

        re_password = window.btoa(re_password +':'+ salt);
        re_password = enc_con.encrypt(re_password);
        $('#re_password').val(re_password);
        $('#re_conf_password').val(re_conf_password);
        document.cookie = "reset_cook=" + salt;
    })
</script>
<?php echo $this->endSection() ?>