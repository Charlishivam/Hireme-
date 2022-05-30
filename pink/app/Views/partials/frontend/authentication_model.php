<div class="modal fade" id="authModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="authModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body login-modal p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="bx bx-x"></i></span>
                </button>
                <div class="row m-0 login-div d-flex" v-if="show_login">
                    <div class="col-md-5 login-left-div">
                        <h1 class="text-center mt-5">
                            Welcome to
                            <span> Template-zone </span>
                        </h1>
                        <p>
                            Sign in to continue to your account.
                        </p>
                    </div>
                    <div class="col-md-7 login-right-div">
                        <div class="text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Sign In to template zone</h4>
                        </div>
                        <span>&nbsp;</span>
                        <div class="form-group">
                            <input type="email" class="form-control box-shadow" id="email" aria-describedby="email" placeholder="Email address" v-model="email" />
                            <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <small class="text-danger" v-if="err_email">{{ err_email }}</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control box-shadow" id="password" placeholder="Password" v-model="password" />
                            <small class="text-danger" v-if="err_password">{{ err_password }}</small>
                        </div>
                        <!-- <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" />
                            <label class="form-check-label text-muted" for="remember">
                                Keep me signed in until I sign out
                            </label>
                        </div> -->
                        <div class="alert alert-warning" v-if="login_error.length">
                            {{ login_error }}
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4" :class="login_disable ? 'disabled' : ''" :disabled="login_disable ? 'disabled' : false" @click="doLogin">Login <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>
                        <a href="#" class="mt-4 d-inline-block" @click="show_register = false;show_login=false;show_reset=true;">Forgot password?</a>
                        <p class="text-center mt-5 mb-0">Not a member yet? <a id="signup-active-link" @click="show_register = true;show_login=false;show_reset=false;"> Sign Up.</a></p>
                    </div>
                </div>

                <div class="row m-0 signup-div d-flex" v-if="show_register">
                    <div class="col-md-5 login-left-div">
                        <h1 class="text-center mt-5">
                            Welcome to
                            <span> Template-zone </span>
                        </h1>
                        <p>
                            Register New User.
                        </p>
                    </div>
                    <div class="col-md-7 login-right-div">
                        <div class="text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Sign Up in template zone</h4>
                        </div>
                        <span>&nbsp;</span>
                        <div class="form-group">
                            <input type="text" class="form-control box-shadow text-capitalize" placeholder="Full Name" v-model="nw_fullname" />
                            <small class="text-danger" v-if="err_fullname.length">{{ err_fullname }}</small>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control box-shadow" id="remail" aria-describedby="email" placeholder="Email address" v-model="nw_email" />
                            <small class="text-danger" v-if="err_nwemail.length">{{ err_nwemail }}</small>
                        </div>
                        <div class="input-group-append mb-3" v-if="show_otp_button">
                            <button class="btn btn-primary" :disabled="enable_otp_btn ? false : 'disabled'" type="button" id="genOTP" @click="sendOtp">
                                {{ otp_button_text }}
                                <span id="msess_timer"></span> 
                                <span v-if="show_otp_loader"><i class='bx bx-loader-alt bx-spin'></i></span>
                            </button>
                        </div>
                        <div class="form-group" v-if="show_otp_div">
                            <input type="text" class="form-control box-shadow" id="otp" aria-describedby="otp" placeholder="OTP" v-model="nw_otp" />
                        </div>
                        <div class="input-group-append mb-3" v-if="show_otp_div">
                            <button class="btn btn-success" type="button" @click="verifyOtp">
                                Verify OTP
                                <span v-if="show_verify_loader"><i class='bx bx-loader-alt bx-spin'></i></span>
                            </button>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control box-shadow" placeholder="Mobile Number" v-model="nw_mobile" />
                            <small class="text-danger" v-if="err_mobile.length">{{ err_mobile }}</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control box-shadow" id="rpassword" placeholder="Password" v-model="nw_password" />
                            <p class="small mb-0 text-muted">Password must be at least 8 characters long.</p>
                            <small class="text-danger" v-if="err_nwpassword.length">{{ err_nwpassword }}</small>
                        </div>
                        <div class="form-group">
                           <select class="form-control custom-select" id="type" name="type" v-model="nw_login_type">
                                <option value="" selected="selected" disabled="disabled">Select Type</option>
                                <option value="INDIVIDUAL">INDIVIDUAL</option>
                                <option value="CARPORATE">CARPORATE</option>
                                <option value="POLITICAL">POLITICAL</option>
                            </select>
                            <small class="text-danger" v-if="err_mobile.length">{{ err_nw_login_type }}</small>
                        </div>
                        <div class="alert alert-warning" v-if="register_error.length">
                            {{ register_error }}
                        </div>
                        <button type="submit" id="register" class="btn btn-primary w-100 mt-3" @click="doRegister" :disabled="submit_disable ? 'disabled' : false">Sign Up <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>
                        <p class="text-center mt-5 mb-0">
                            Already a member?
                            <a id="signin-active-link" @click="show_register = false;show_login=true;show_reset=false;"> Sign In.</a>
                        </p>
                        <hr />
                        <p class="mb-0 small">
                            By signing up you agree to template zone's&nbsp;
                            <a class="link-bcolor font-weight-bold" href="#">Terms of Service & </a>
                            <a class="link-bcolor font-weight-bold" href="#">Privacy Policy.</a>
                            <!-- This page is protected by reCAPTCHA and is subject to Google's -->
                            <!-- <a target="_blank" class="link-bcolor font-weight-bold" href="https://policies.google.com/terms">Terms of Service</a>
                            <a target="_blank" class="link-bcolor font-weight-bold" href="https://policies.google.com/privacy"> Privacy Policy.</a> -->
                        </p>
                    </div>
                </div>

                <div class="row m-0 login-div d-flex" v-if="show_reset">
                    <div class="col-md-5 login-left-div">
                        <h1 class="text-center mt-5">
                            Welcome to
                            <span> Template-zone </span>
                        </h1>
                        <p>
                            reset password to recover account.
                        </p>
                    </div>
                    <div class="col-md-7 login-right-div">
                        <div class="text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Reset Password to Template Zone</h4>
                        </div>
                        <span>&nbsp;</span>
                        <div class="form-group">
                            <input type="email" class="form-control box-shadow" id="email" aria-describedby="email" placeholder="Email address" v-model="email" />
                            <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <small class="text-danger" v-if="err_email">{{ err_email }}</small>
                        </div>
                        <div class="alert alert-info" v-if="reset_error.length">
                            {{ reset_error }}
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4" :class="reset_disable ? 'disabled' : ''" :disabled="reset_disable ? 'disabled' : false" @click="doReset">Continue <span v-if="show_loader"><i class='bx bx-loader-alt bx-spin'></i></span></button>
                        <a href="#" class="mt-4 d-inline-block" @click="show_register = false;show_login=true;show_reset=false;">Back to Login</a>
                        <p class="text-center mt-5 mb-0">Not a member yet? <a id="signup-active-link" @click="show_register = true;show_login=false;show_reset=false;"> Sign Up.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>