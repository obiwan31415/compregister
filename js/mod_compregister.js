//alert("Welcome to Comp Register Form Module");
function validateForm() {
    var x = document.forms["compregister"]["firstname"].value;
    if (x==null || x=="") {
        alert("First name must be filled out");
        return false;
    }
}

$(function() { 
       $('#btn_send').click( function() { 
             $('#btn_send').css("background", "red");
       });
});