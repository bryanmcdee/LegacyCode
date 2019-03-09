$( document ).ready(function() {
    initiallizeFormValidator();
    hideFormFeedbackMessage();
    contactFormSubmitClickEvent();
});

var initiallizeFormValidator = function(){
    $('#contactForm').validator();
}

var hideFormFeedbackMessage = function(){
    hideElement('formSuccessMessage');
    hideElement('formErrorMessage');
}

var contactFormSubmitClickEvent = function(){
    $('#contactForm').validator().on('submit', function (e) {
        hideFormFeedbackMessage(); 
        if (e.isDefaultPrevented()) {
            // Handle invalid form if needed
        } else {            
            e.preventDefault();          
            submitForm(getFormContent());
        }
    });
}

var getFormContent = function(){
    var form = {
        name: $("#name").val(),
        email: $("#email").val(),
        message: $("#message").val(),
        honeypotEmail: $("#honeypotEmail").val()
    }
    return form;
}

var submitForm = function(form){
    $.ajax({
        type: "POST",
        url: "php/contact.php",
        data: "name=" + form.name + "&email=" + form.email + "&message=" + form.message+ "&honeypotEmail=" + form.honeypotEmail,
        success : function(returnText){
            if (returnText == "success"){
                submitFormSuccess();
            } else{
                submitFormError(returnText);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { 
            submitFormError(); 
        }
    });
}

var submitFormSuccess = function() {
    clearForm();
    hideElement('contactForm');
    showElement('formSuccessMessage'); 
}

var submitFormError = function(text){
    $('#phpErrorMessage').text(text);
    showElement('formErrorMessage'); 
}

var clearForm = function(){
    $("#name").val('');
    $("#email").val(''),
    $("#message").val('')
}

hideElement = function(elementId){
    $('#' + elementId).hide();
}

showElement = function(elementId){
    $('#' + elementId).show();
}