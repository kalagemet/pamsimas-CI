//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        mUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
        //login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var handleFormSwitch = function() {
        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    cabang: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form=$('#m-form_login')
            form.attr('action',form.attr('action')).trigger('submit');
            // form.ajaxSubmit({
            //     // url: '',
            //     // success: function(response, status, xhr, $form) {
            //     // 	// similate 2s delay
            //     // 	setTimeout(function() {
	        //     //         btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	        //     //         showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
            //     //     }, 2000);
            //     // }
            // });
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#m_login_sigin_admin').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    nama: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form=$('#m-form_login-admin')
            form.attr('action',form.attr('action')).trigger('submit');
            // form.ajaxSubmit({
            //     url: '',
            //     success: function(response, status, xhr, $form) {
            //     	// similate 2s delay
            //     	setTimeout(function() {
	        //             btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	        //             form.clearForm();
	        //             form.validate().resetForm();

	        //             // display signup form
	        //             displaySignInForm();
	        //             var signInForm = login.find('.m-login__signin form');
	        //             signInForm.clearForm();
	        //             signInForm.validate().resetForm();

	        //             showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
	        //         }, 2000);
            //     }
            // });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});

jQuery.extend(jQuery.validator.messages, {
    required: "Field tidak boleh kosong !!!",
    remote: "isi field tidak sesuai.",
    email: "Alamat email tidak valid.",
    url: "URL tidak valid.",
    date: "Tanggal tidak valid.",
    dateISO: "(ISO) Tanggal tidak valid.",
    number: "masukan nomor yang valid.",
    digits: "Hanya digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Batas Maksimal {0} characters."),
    minlength: jQuery.validator.format("Masukan Minimal {0} characters."),
    rangelength: jQuery.validator.format("Masukan nilai antara {0} dan {1} characters long."),
    range: jQuery.validator.format("Masukan nilai antara {0} dan {1}."),
    max: jQuery.validator.format("Masukan nilai lebih kecil atau sama dengan {0}."),
    min: jQuery.validator.format("Masukan nilai lebih besar atau sama dengan {0}.")
});