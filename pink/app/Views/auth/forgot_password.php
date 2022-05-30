<?php echo $this->extend('layouts/backend/auth') ?>

<?php echo $this->section('content') ?>
<div class="container-fluid login-section p-0" id="forgot_pwd">
    <div class="row m-0">
        <div class="col-md-5 login-left-div">
            <div class="login-form-div">
                <?php echo auth_logo() ?>
                <div class="form-group">
                    <h4>Account recovery</h4>
                    <small>This helps show that this account really belongs to you</small>
                </div>
                <?php echo form_open('backendauth/login', ['class' => 'login-form', 'id' => 'login-form', 'autocomplete' => 'off', 'autofill' => 'off']) ?>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" name="email" placeholder="Email address" class="form-control" id="email"
                        aria-describedby="email" v-model='email'>
                        <small>We'll never share your email with anyone else.</small>
                        <span class="text-danger" v-if="err_email">{{err_email}}</span>
                    </div>
                    <div class="alert alert-info" v-if="reset_error.length">
                        {{ reset_error }}
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4" :class="reset_disable ? 'disabled' : ''" :disabled="reset_disable ? 'disabled' : false" @click="doReset">Continue <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>&nbsp;
                <?php echo form_close() ?>
                <div class="form-group">
                    <a href="<?php echo base_url('backendauth/login') ?>">Back to Login</a>
                </div>
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

var res = new Vue({
    el:'#forgot_pwd',
    data: {
        email: '',

        reset_disable : true,
        show_loader : false,

        err_email: '',
        reset_error: ''

    },
    watch: {
        email:        function() {
            this.email    = this.email.replace(/[^0-9a-zA-Z\@\-\.\_]+/g, '').substring(0, 100).trim();
            this.setLoginDisable();
            this.setResetDisable();
        },
    },
    methods: {
        doReset: function () {
            this.show_loader = true;
            this.reset_disable = true;
            var data = {
                username: this.email,
            };
            data[token_name] = token_val;
            
            $.post(base_url+'backendauth/password/reset', data, function(response) {
                token_val = response.token;
                res.show_loader = false;
                res.reset_disable = false;
                if (response.status == 'success') {
                    res.reset_error = response.message;
                } else {
                    res.reset_error = response.message;
                }
            }, 'json').fail(function() {
                res.reset_error = 'Something went wrong!, please try again later';
                regenToken();
                res.show_loader = false;
                res.reset_disable = true;
            });
        },
        setLoginDisable: function () {
            var valid_email     = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email.trim());
            this.err_email      = this.email.length > 8 && !valid_email ? 'Please enter valid email address' : '';
        },
        setResetDisable: function () {
            var valid_email     = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email.trim());
            this.err_email      = this.email.length > 8 && !valid_email ? 'Please enter valid email address' : '';
            this.reset_disable = ! valid_email;
        },
    }     
});

</script>
<?php echo $this->endSection() ?>