//DELETE USER
function deltUser(x){
    swal({
        title:"Are you sure?",
        text:"Once you remove this accountant there is no way back",
        icon:"warning",
        buttons: true,
        closeOnConfirm: true,
      })
      .then((isConfirm)=>{
        if(isConfirm){
          window.location.href = "deltUser.php?id="+x;
        }else{
          swal("Cancelled.!","The voter is safe","error");
        }
      })
    ;
}

//DELETE STORE
function dltCateg(x){
    swal({
        title:"Are you sure?",
        text:"Once you remove this category there is no way back",
        icon:"warning",
        buttons: true,
        closeOnConfirm: true,
      })
      .then((isConfirm)=>{
        if(isConfirm){
          window.location.href="dltCategory.php?id="+x;
        }else{
          swal("Cancelled.!","The voter is safe","error");
        }
      })
    ;
}

function disp(){ $('#popbox').show(500); }
function hid(){ $('#popbox').hide(500); }
function sub(){ 
    if(validt()){
        var start = new Date($('#endd').val());
        if ($.trim(start) != '') {
            window.location.href = "initiate.php?tyme="+start.toISOString();
        }
    }
}

function validt(){
    if($.trim($('#endd').val()) == ''){ 
        $('#endd').focus();
        swal("Warning.!","The end date must be filled","warning");
        return false;
    }
    return true;
}


function alertz(x){ x.style.display = 'none'; }


function updateProfile(form, old){
    var validationVerified=true;
    var errorMessage="";

    if (old != form.oldpass.value) {
        errorMessage += "You Input Wrong Password, Try again! \n";
        form.oldpass.focus();
        validationVerified = false;
    }   

    if (form.newpass.value.length < 6) {
        form.newpass.focus();
        errorMessage+="The password should have atleast 6 characters!\n";
        validationVerified = false;
    }

    if (form.newpass.value != form.cnewpass.value) {
            form.cnewpass.focus();
            errorMessage+="New password and Confirm password do not match!\n";
            validationVerified = false;
        }

    if (!validationVerified) {  swal(errorMessage, {icon: "warning"}); }
    return validationVerified;
}