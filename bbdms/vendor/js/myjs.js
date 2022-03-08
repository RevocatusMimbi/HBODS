//confirm password.
function confirmpass(form){
    var verified = true;
    var msg = "";

    if(form.pwd.value != form.cpwd.value){
        msg += "your password does not match, try again";
        verified = false;

    }
    
    if(!verified){

        alert(msg);
    }

    return verified;

}