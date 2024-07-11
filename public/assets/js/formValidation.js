// document.getElementById('adminFormValidate').addEventListener('submit', function (event) {
jQuery('#adminFormValidate').validate({
    rules: {
        email: {
            required: true,
            remote: {
                url: appPath + 'auth/check_email_exist_forgot',
                type: "post"
            }
        },
        password: {
            required: true,
            minlength: 6,
        }
    },
    messages: {
        email: "<p class='text-danger'>Please Enter Email ID*</p>",
        password: {
            required: "<p class='text-danger'>Please Enter Admin password*</p>",
            minlength: "<p class='text-danger'>Please Enter minimum 6 Digit your password</p>",
        }
    }
});
// });

