
$(document).ready(function(){

    $("#validate_form").validate({

    rules: {
        school_name :{
            required: true,
            minlength: 2,
            maxlength: 50,
        },
        school_address: {
            required:true,
            minlength: 2,
            maxlength: 200,
        },
        zip: {
            required:true,
        },
        profile :{
            extension:"jpg|jpeg|png|gif",
        },

        'image[]':{
           // required: true,
            extension: "jpg|jpeg|png|gif",
        },
        'document[]':{
            extension: "pdf|doc|docx",
        }
    }
    ,
    messages:{
        school_name: {
            require: "school name is required",
            minlength: "Your school name must be at least 2 characters long ",
            maxlength:"Your school name max 100  characters long  "
        },
        school_address:{
            require: "Please enter your school address",
            minlength: "Your school address must be at least 2 characters long ",
            maxlength:"Your school address max 100  characters long  ",
        },

        zip:{
            require:"Please enter your zip code or postal code",
        },
        profile:{
            extension:"image should be mime type ",
        },

        'image[]':{
            extension:" image must be png ,jpg ,jpeg"
        },
        'documnet[]':{
             extension:" document must be pdf,doc and docx"
        }
    },
    submitHandler: function (form) {
        form.submit();
    }
});

});
