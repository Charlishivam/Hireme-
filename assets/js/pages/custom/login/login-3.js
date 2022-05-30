"use strict";
var KTLogin = function () {
	var t = "spinner spinner-right spinner-white pr-15";
	return {
		init: function () {
			var i, e;
			i = KTUtil.getById("kt_login_singin_form"), KTUtil.attr(i, "action"), e = KTUtil.getById("kt_login_singin_form_submit_button"), i && FormValidation.formValidation(i, {
					fields: {
						username: {
							validators: {
								notEmpty: {
									message: "Username is required"
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: "Password is required"
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger,
						submitButton: new FormValidation.plugins.SubmitButton,
						bootstrap: new FormValidation.plugins.Bootstrap({})
					}
				}).on("core.form.valid", (function () {
					KTUtil.btnWait(e, t, "Please wait"), setTimeout((function () {
						KTUtil.btnRelease(e)
					}), 2e3)
				})).on("core.form.invalid", (function () {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					}).then((function () {
						KTUtil.scrollTop()
					}))
				})),
				function () {
					var i = KTUtil.getById("kt_login_forgot_form"),
						e = (KTUtil.attr(i, "action"), KTUtil.getById("kt_login_forgot_form_submit_button"));
					i && FormValidation.formValidation(i, {
						fields: {
							email: {
								validators: {
									notEmpty: {
										message: "Email is required"
									},
									emailAddress: {
										message: "The value is not a valid email address"
									}
								}
							}
						},
						plugins: {
							trigger: new FormValidation.plugins.Trigger,
							submitButton: new FormValidation.plugins.SubmitButton,
							bootstrap: new FormValidation.plugins.Bootstrap({})
						}
					}).on("core.form.valid", (function () {
						KTUtil.btnWait(e, t, "Please wait"), setTimeout((function () {
							KTUtil.btnRelease(e)
						}), 2e3)
					})).on("core.form.invalid", (function () {
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: !1,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						}).then((function () {
							KTUtil.scrollTop()
						}))
					}))
				}(),
				function () {
					var t, i = KTUtil.getById("kt_login"),
						e = KTUtil.getById("kt_login_signup_form"),
						o = [];
					e && (o.push(FormValidation.formValidation(e, {
						fields: {
							fname: {
								validators: {
									notEmpty: {
										message: "First name is required"
									}
								}
							},
							lname: {
								validators: {
									notEmpty: {
										message: "Last Name is required"
									}
								}
							},
							phone: {
								validators: {
									notEmpty: {
										message: "Phone is required"
									}
								}
							},
							email: {
								validators: {
									notEmpty: {
										message: "Email is required"
									},
									emailAddress: {
										message: "The value is not a valid email address"
									}
								}
							},
							password: {
								validators: {
									notEmpty: {
										message: "Password is required"
									}
								}
							}
						},
						plugins: {
							trigger: new FormValidation.plugins.Trigger,
							bootstrap: new FormValidation.plugins.Bootstrap({
								eleValidClass: ""
							})
						}
					})), o.push(FormValidation.formValidation(e, {
						fields: {
							address1: {
								validators: {
									notEmpty: {
										message: "Address is required"
									}
								}
							},
							postcode: {
								validators: {
									notEmpty: {
										message: "Postcode is required"
									}
								}
							},
							city: {
								validators: {
									notEmpty: {
										message: "City is required"
									}
								}
							},
							state: {
								validators: {
									notEmpty: {
										message: "State is required"
									}
								}
							},
							referral: {
								validators: {
									notEmpty: {
										message: "Referral Code is required"
									}
								}
							}/*,
							country: {
								validators: {
									notEmpty: {
										message: "Country is required"
									}
								}
							}*/
						},
						plugins: {
							trigger: new FormValidation.plugins.Trigger,
							bootstrap: new FormValidation.plugins.Bootstrap({
								eleValidClass: ""
							})
						}
					})), o.push(FormValidation.formValidation(e, {
						fields: {
							delivery: {
								validators: {
									notEmpty: {
										message: "Delivery type is required"
									}
								}
							},
							packaging: {
								validators: {
									notEmpty: {
										message: "Packaging type is required"
									}
								}
							},
							preferreddelivery: {
								validators: {
									notEmpty: {
										message: "Preferred delivery window is required"
									}
								}
							}
						},
						plugins: {
							trigger: new FormValidation.plugins.Trigger,
							bootstrap: new FormValidation.plugins.Bootstrap({
								eleValidClass: ""
							})
						}
					})), o.push(FormValidation.formValidation(e, {
						fields: {
							ccname: {
								validators: {
									notEmpty: {
										message: "Credit card name is required"
									}
								}
							},
							ccnumber: {
								validators: {
									notEmpty: {
										message: "Credit card number is required"
									},
									creditCard: {
										message: "The credit card number is not valid"
									}
								}
							},
							ccmonth: {
								validators: {
									notEmpty: {
										message: "Credit card month is required"
									}
								}
							},
							ccyear: {
								validators: {
									notEmpty: {
										message: "Credit card year is required"
									}
								}
							},
							cccvv: {
								validators: {
									notEmpty: {
										message: "Credit card CVV is required"
									},
									digits: {
										message: "The CVV value is not valid. Only numbers is allowed"
									}
								}
							}
						},
						plugins: {
							trigger: new FormValidation.plugins.Trigger,
							bootstrap: new FormValidation.plugins.Bootstrap({
								eleValidClass: ""
							})
						}
					})), (t = new KTWizard(i, {
						startStep: 1,
						clickableSteps: !1
					})).on("change", (function (t) {
						if (!(t.getStep() > t.getNewStep())) {
							var i = o[t.getStep() - 1];
							return i && i.validate().then((function (i) {
								"Valid" == i ? (t.goTo(t.getNewStep()), KTUtil.scrollTop()) : Swal.fire({
									text: "Sorry, looks like there are some errors detected, please try again.",
									icon: "error",
									buttonsStyling: !1,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light"
									}
								}).then((function () {
									KTUtil.scrollTop()
								}))
							})), !1
						}
					})), t.on("changed", (function (t) {
						KTUtil.scrollTop()
					})), t.on("submit", (function (t) {
						Swal.fire({
							text: "All is good! Please confirm the form submission.",
							icon: "success",
							showCancelButton: !0,
							buttonsStyling: !1,
							confirmButtonText: "Yes, submit!",
							cancelButtonText: "No, cancel",
							customClass: {
								confirmButton: "btn font-weight-bold btn-primary",
								cancelButton: "btn font-weight-bold btn-default"
							}
						}).then((function (t) {
							t.value ? e.submit() : "cancel" === t.dismiss && Swal.fire({
								text: "Your form has not been submitted!.",
								icon: "error",
								buttonsStyling: !1,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn font-weight-bold btn-primary"
								}
							})
						}))
					})))
				}()
		}
	}
}();
jQuery(document).ready((function () {
	KTLogin.init()
}));