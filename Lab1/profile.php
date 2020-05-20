<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script   src="https://code.jquery.com/jquery-3.5.1.js"    ></script>
    <script   src="jsFunctions.js"    ></script>


    <head>
    <div>

    <div id="sdiv">
            <h1 >Profile <button type="submit" id="searchbtn" onclick="window.location.href='index.php'">Back</button></h1>
            

            </div>
    </div>
        <form id="myForm" method="POST" onsubmit="return false;" >

            <label for="email">New E-mail:</label>
            <input type="text" id="email"  name="femail"><br>
            
            <label for="password">Old Password:</label>
            <input type="text" id="oldPassword"  class="password" name="fOldPassword"><br>

            <label for="password">New Password:</label>
            <input type="text" id="newPassword" class="password" name="fNewPassword"><br>

            <input type="submit" value="Change" id="submit" onclick="checkForm();" >
          </form>
          <h1 id="result"></h1>
    </head>
    <body>

    <script>
    
    function checkForm(){

        var email = $('#email').val();  //gets email value
        var oldPassword = $('#oldPassword').val();  //gets oldpassword value
        var newPassword = $('#newPassword').val();  //gets newpassword value

         if (checkInput(newPassword, email)){
             sendAjax("profileChecker.php", {femail:email, fnewpassword:newPassword, foldpassword:oldPassword});
         }
    }
    
    
    </script>
    </body>
</html>