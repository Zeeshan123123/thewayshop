$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    let formDataObject = {};
    let _token = $('meta[name="csrf-token"]').attr('content');
    formDataObject['name'] = $("#name").val();
    formDataObject['email'] = $("#email").val();
    formDataObject['subject'] = $("#subject").val();
    formDataObject['message'] = $("#message").val();
    $('#submit').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: "/ajax/sendEmail",
        data:{
            data: formDataObject,
            _token: _token
        },
        success : function(response){
            if (response.code === 200){
                $('#submit').attr('disabled', false);
                formSuccess(response.msg);
            } else {
                $('#submit').attr('disabled', false);
                formError();
                submitMSG(false,response.msg);
            }
        }
    });
}

function formSuccess(msg){
    $("#contactForm")[0].reset();
    submitMSG(true, msg);
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
