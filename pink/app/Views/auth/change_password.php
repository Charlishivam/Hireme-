<?php echo $this->extend('layouts/backend/auth') ?>

<?php echo $this->section('content') ?>
<div class="container-fluid login-section p-0" id="reset_pwd" v-cloak>
    <div class="row m-0">
        <div class="col-md-5 login-left-div">
            <?php if ($link_expired == FALSE): ?>
            <div class="login-form-div">
                <?php echo auth_logo() ?>
                <div class="form-group">
                    <h4>Reset Password</h4>
                </div>
                <?php echo form_open('backendauth/password/resetpassword') ?>
                    
                    <div class="form-group">
                       <input type="email" placeholder=" <?php echo $email ?>" class="form-control box-shadow" readonly>
                       <input type="hidden" name="email" style="display: none;" value="<?php echo $email ?>">
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
                    <button type="submit" name="submit" value="submit" id="resetnow" class="btn btn-primary w-100 mt-3" :disabled="regenerate_disable ? 'disabled' : false">Submit <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>&nbsp;

                <?php echo form_close() ?>
                <div class="form-group">
                    <a href="<?php echo base_url('backendauth/login') ?>">Back to Login</a>
                </div>
            </div>
            <?php else: ?>
                <div class="login-form-div">
                    <div class="form-group">
                    <h4>Reset Password</h4>
                </div>
                    <div class="alert alert-info">
                        <?php echo $message ?>
                    </div>
                </div>
            <?php endif ?> 

        </div>
        <div class="col-md-7 login-right-div p-0">
            <?php echo auth_background() ?>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">

var resp = new Vue({
    el:'#reset_pwd',
    data: {
        err_msg : '',
        re_password: '',
        re_conf_password: '',
        err_repassword: '',
        err_conf_repassword: '',
        regenerate_disable: true,
        show_loader : false,
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
    $('.error').remove();
    var enc_con     = new JSEncrypt();
    enc_con.setPublicKey(window.atob(rsaPrivKey));
    var re_password      = $('#re_password').val();
    re_password = window.btoa(re_password);
    re_password = enc_con.encrypt(re_password);
    $('#re_password').val(re_password);
    $('#re_conf_password').val(re_conf_password);
})
</script>
<?php echo $this->endSection() ?>