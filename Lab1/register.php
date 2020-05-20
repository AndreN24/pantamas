<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jsFunctions.js"    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"    ></script>

    <head>
    <h1>Registration Form  </h1>
        <form id="myForm" method="POST" onsubmit="return false;" >

            <label for="email">E-mail:</label>
            <input type="text" id="email"  name="femail"><br>
            
            <label for="password">Password:</label>
            <input type="text" id="password"  name="fpassword"><br>


            <input type="submit" value="Submit" id="submit" onclick="checkForm();" >
          </form>
          <h1 id="result"></h1>
          <script>

        function checkForm(){
            var p = $('#password').val();  //gets password value
            var email = $('#email').val(); //gets email value

            if (checkInput(p, email)){

            sendAjax("registration.php",{femail:email, fpassword:p}); //starts ajax execution
            }
            return false;

        }

            

        </script>
    </head>
    <body>
    <a href="login.php"> Already a member?</a>
    </body>
</html>