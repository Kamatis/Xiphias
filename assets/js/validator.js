// GLOBAL FIELDS
var minLength = 0, maxLength = 0;
var appendingTitle;

// VALIDATION RULES
var validRules = {
    required:   { message: "This field is required.", pattern: "^(?!\\s*$).+" },
    alpha_num:  { message: "Can only use letters(a-z) and numbers(0-9).", pattern: "^[a-zA-Z0-9_]+$" },
    alphanumspace: {message: "Can only use letters(a-z) and space", pattern: "^[a-zA-Z ]+$"},
    reqlength:  { message: "Must be " + minLength + " - " + maxLength + " characters long", pattern: "" },
    email:      { message: "Valid Email Address", pattern: "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" },
    match:      { message: "Passwords must match.", to: "", text: ""},
    nomatch:    { message: "Username and password must be different.", to: "", text: "" },
    exist:      { message: " not already in use." }
};

$(function(){
    $('[data-toggle="popover"]').popover();
});

// check validation of all inputs tagged with required
function checkRequired(){
    var isValid = true;
    $('input').each(function() {
       var element = $(this);
       if (element.val() == "") {
           isValid = false;
       }
    });
    return isValid;
}

// check username and password
function checkUser(un, pw, callback){
    return $.ajax({
        url: "http://"+ window.location.hostname + "/xiphias/index.php/pages/checkUser",
        type: "post",
        cache: false,
        data: { username: un, password: pw }
    })
    .done(callback)
    .fail(function(jqXHR, textStatus, errorThrown) {
        alert("An error occured!\n" + xhr);
    });
}



// check validation with pattern
function isValid(validation, stringPattern, text){
    if(validation == "match")
    {
        return text == validRules[validation]['text'];
    }
    else if(validation == "nomatch")
    {
        return text != validRules[validation]['text'];
    }
    else
    {
        var pattern = new RegExp(stringPattern, "i");
        return pattern.test(text);
    }
}

function popOver(element){
    element
        .attr('title', appendingTitle)
        .popover('fixTitle')
        .popover('setContent');

    element.popover('show');
}

$('input.validation').on('input', function(e) {
    appendingTitle = "";
    minLength = $(this).data("min-length");
    maxLength = $(this).data("max-length");

    validRules['reqlength']['message'] = "Must be " + minLength + " - " + maxLength + " characters long";
    validRules['reqlength']['pattern'] = "^[a-zA-Z0-9_ ]{" + $(this).data("min-length") + "," + $(this).data("max-length") + "}$";
    validRules['match']['to'] = $(this).data("match");
    validRules['nomatch']['to'] = $(this).data("match");
    validRules['match']['text'] = $(validRules['match']['to']).val();
    validRules['nomatch']['text'] = $(validRules['nomatch']['to']).val();

    var arr = $(this).data("valid").split(' ');

    // check all validation requirements
    // re-append appropriate message for the user
    var i;
    var errorCount = 0;
    for (i = 0; i < arr.length; i++)
    {
        if(arr[i] == "exist")
        {
			$.ajax({
                url: "user.php",
                type: "get",
                data: { table:$(this).data('col'), text: $(this).val()},
				placeholder: $(this).attr('placeholder'),
				message: validRules[arr[i]]['message'],
                success: function(response) {
                    if(response == "mayo pa")
                        appendingTitle += "<span class=\"glyphicon glyphicon-ok color-green tip\" aria-hidden=\"true\"> " + this.placeholder + this.message + "</span><br>";    
					else{
                        appendingTitle += "<span class=\"glyphicon glyphicon-remove color-red tip\" aria-hidden=\"true\"> " + this.placeholder + this.message + "</span><br>";
						errorCount++;
					}
				},
                error: function(xhr) {
                    alert("An error occured!\n" + xhr);
                },
				async:   true
            });
		}
        else
        {
            if(isValid(arr[i], validRules[arr[i]]['pattern'], $(this).val()))
            {
                appendingTitle += "<span class=\"glyphicon glyphicon-ok color-green tip\" aria-hidden=\"true\"> " + validRules[arr[i]]['message'] + "</span><br>";
            }
            else
            {
                appendingTitle += "<span class=\"glyphicon glyphicon-remove color-red tip\" aria-hidden=\"true\"> " + validRules[arr[i]]['message'] + "</span><br>";
                errorCount++;
            }
        }
    }

    // tag input as invalid
    // this will be checked when submit button is clicked
    if(errorCount != 0)
    {
        if($(this).attr('class') != 'invalid')
            $(this).addClass("invalid");

        $(this).siblings(".x-mark").show();
    }
    else
    {
        $(this).removeClass("invalid");
        $(this).siblings(".x-mark").hide();
    }

    popOver($(this));
});

$('.submit-validation').on('click', function(e){
    e.preventDefault();
    appendingTitle = "";
    if(!checkRequired()){
        appendingTitle = "All fields are required.";
        popOver($(this));
        e.preventDefault();
    }
    else{
    	checkUser($('#txtUsername').val(), $('#txtPassword').val(), function(userExist) {
            if(userExist!= "ok")
            {
                appendingTitle = "Invalid username or password.";
                popOver($('.submit-validation'));
                e.preventDefault();
            }
            else{
                $('#porm').submit();
            }
        });
    }
});