$(document).ready(function(){
// $('.user-details-form').hide();

// $('.guest-checkout').click(function(){
// 	$('.user-details-form').toggle('hide');
// });
// $('.already-user').click(function(){
// 	$('#loginModal').modal('show');
// });


$("#joinUs").validate({
	rules:{
		name: "required",
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 10
        },
        password:{
            required: true,
            minlength: 5
        },
        con_password:{
            required: true,
            equalTo:"#password"
        },
	},
	messages: {
        name: "Please Enter your full Name",
        email: "Please Enter a valid email address",
        phone: "Please Enter a valid Mobile Number",
        password: {
            required: 'Please provide a password',
            minlength: 'Your password must be 5 characters long',
        },
        con_password:{
            required: 'Please re-enter the password',
            equalTo: 'Please re-enter the same password again',
        },
    },
    //submit handler
    submitHandler: function(form) {
        form.submit();
    }
});

// $("#joinUs").validate({
// 	rules:{
// 		name: "required",
//         email: {
//             required: true,
//             email: true
//         },
//         phone: {
//             required: true,
//             number: true,
//             minlength: 10,
//             maxlength: 10
//         },
//         password:{
//             required: true,
//             minlength: 5
//         },
//         con_password:{
//             required: true,
//             equalTo:"#password"
//         },
// 	},
// 	messages: {
//         name: "Please Enter your full Name",
//         email: "Please Enter a valid email address",
//         phone: "Please Enter a valid Mobile Number",
//         password: {
//             required: 'Please provide a password',
//             minlength: 'Your password must be 5 characters long',
//         },
//         con_password:{
//             required: 'Please re-enter the password',
//             equalTo: 'Please re-enter the same password again',
//         },
//     },
//     //submit handler
//     submitHandler: function(form) {
//         form.submit();
//     }
// });

});