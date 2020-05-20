<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script   src="https://code.jquery.com/jquery-3.5.1.js"    ></script>

    <head>
    <h1>Registration Form  </h1>
        <form id="myForm" method="POST" action="registration.php" onsubmit="return checkForm();" >

            <label for="email">E-mail:</label>
            <input type="text" id="email"  name="femail"><br>
            
            <label for="password">Password:</label>
            <input type="text" id="password"  name="password"><br>


            <input type="submit" value="Submit" id="submit">
            
          </form>
          <script>

            $(document).ready(function (){
                checkForm = function () {
                    var p = document.getElementById("password").value;  
                    var errors = [];
                    if (p.length < 6) {
                    errors.push("Your password must be at least 6 characters"); 
                    }
                    if (p.search(/[a-z]/i) < 0) {
                        
                        errors.push("Your password must contain at least one letter.");
                    }
                    if (p.search(/[0-9]/) < 0) {
                        errors.push("Your password must contain at least one digit."); 
                    }
                    if (errors.length > 0) {
                        alert(errors.join("\n"));
                        return false;
                    }
                    return true;
                }
            });
            

        </script>
    </head>
    <body>
    <a href="login.php"> Already a member?</a>
    </body>
</html>