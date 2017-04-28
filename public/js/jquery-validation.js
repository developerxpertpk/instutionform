$(document).ready(function(){

    $(function(){
        $("form[name='school_register']").validate({

            rules: {
                school_name :"required|alpha-num",
                school_address:"required|alpha-num",
                zip:"required|alpha_num|min:4|max:10",
                country:"required|alpha",
                state:"required|alpha",
                city:"required|alpha"

            },

            messages:{
                school_name: "Please enter your school name",
                school_address: "Please enter your school address",
                zip: "Please enter your zip",
                country: "Please enter country",
                state: "Please enter state",
                city:"Please enter city",
            },
            submitHandler: function(form) {
                form.submit();
            }


        });
    });


});