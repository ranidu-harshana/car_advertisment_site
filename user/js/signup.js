function validateName(event){
    if( !((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)) ){
        event.preventDefault();
        document.getElementById('name_err').setAttribute("style", "display:inline;color:red;");
    }else{
        document.getElementById('name_err').setAttribute("style", "display:none");
    }
}

function passwordValidate(){
    var pass_val = document.getElementById("pass").value;
    if(pass_val.length > 0){
        document.getElementById("pass_check").setAttribute("style","display:block");
        if(pass_val.length > 8){
            document.getElementById("inc_char12_0").setAttribute("style","display:inline;color: green");
            document.getElementById("inc_char12_1").setAttribute("style","display:none");
        }else{
            document.getElementById("inc_char12_0").setAttribute("style","display:none");
            document.getElementById("inc_char12_1").setAttribute("style","display:inline;color: red");
        }

        if(/\d/.test(pass_val)){
            document.getElementById("inc_onenumber_0").setAttribute("style","display:inline;color: green");
            document.getElementById("inc_onenumber_1").setAttribute("style","display:none");
        }else{
            document.getElementById("inc_onenumber_0").setAttribute("style","display:none");
            document.getElementById("inc_onenumber_1").setAttribute("style","display:inline;color: red");
        }

        if(/[a-z]/.test(pass_val)){
            document.getElementById("inc_lowercase_0").setAttribute("style","display:inline;color: green");
            document.getElementById("inc_lowercase_1").setAttribute("style","display:none");
        }else{
            document.getElementById("inc_lowercase_0").setAttribute("style","display:none");
            document.getElementById("inc_lowercase_1").setAttribute("style","display:inline;color: red");
        }

        if(/[A-Z]/.test(pass_val)){
            document.getElementById("inc_uppercase_0").setAttribute("style","display:inline;color: green");
            document.getElementById("inc_uppercase_1").setAttribute("style","display:none");
        }else{
            document.getElementById("inc_uppercase_0").setAttribute("style","display:none");
            document.getElementById("inc_uppercase_1").setAttribute("style","display:inline;color: red");
        }
    }else{
        document.getElementById("pass_check").setAttribute("style","display:none");
    }
}