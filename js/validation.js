
// validates text only
function Validate(txt) {
    txt.value = txt.value.replace(/[^A-Za-z0-9]/g, '');
}
// validate email
function email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
    document.getElementById("1").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
    }
    else
    {
    document.getElementById("1").innerHTML	= "<span class='valid'>Thanks, you have entered a valid Email address!</span>";	
    }
}

function emailCheck() {
    if ($("#email").val() == "") {
      $("#email").addClass("is-invalid");
      return false;
    } else {
      var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
      if (regMail.test($("#email").val()) == false) {
        $("#email").addClass("is-invalid");
        $("#5").html("Invalid email");
        return false;
      } else {
        $("#5").html("<span class='valid'>Valid email</span>");
        return true;
      }
    }
  }
function checksimilarity(){
    var password = $("#password").val();
    var cpassword = $("#cpassword").val();
    if(password != cpassword){
        $("#match").html("Passwords do not match");
        return false;
    }
    else{
        $("#match").html("");
        return true;
    }
}

function strong() {
    var isit= false;
    var pass = $("#password").val();
  var lowerCaseLetters = /[a-z]/g;
  if(pass.match(lowerCaseLetters)) {  
      $("#1").html("");
      isit= true;
  } else {
      $("#1").html("Please add lowercase characters");
      isit= false;
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(pass.match(upperCaseLetters)) {  
      $("#2").html("");
      isit= true;
  } else {
      $("#2").html("Please add upperrcase characters");
      isit= false;
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(pass.match(numbers)) {  
      $("#3").html("");
      isit= true;
  } else {
      $("#3").html("Please add numbers");
      isit= false;
  }
  
  // Validate length
  if(pass.length >= 8) {
      $("#4").html("");
      isit= true;
  } else {
      $("#4").html("Please add 8 characters");
      isit= false;
  }
  return isit;
}

