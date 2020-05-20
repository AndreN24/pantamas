<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="jsFunctions.js" ></script>


    <head>

    <?php
    session_start();
    if (isset($_SESSION['email'])){   
        header("Location: index.php");
    }
    
    ?>
    <h1>Login  </h1>
        <form id="myForm" method="POST" onsubmit="return false;" >

            <label for="email">E-mail:</label>
            <input type="text" id="email"  name="femail"><br>
            
            <label for="password">Password:</label>
            <input type="text" id="password"  name="fpassword"><br>


            <input type="submit" value="Submit" id="submit" onclick="Start();">
            
          </form>
          <h1 id="result"></h1>

    </head>
    <body>
    <script>

    function Start(){
        email = $('#email').val();
        password = $('#password').val();

        sendAjax("CheckLogin.php", {femail:email, fpassword:password});
        if ($('result').val() === "Succeessfully logged in"){
                window.location.href = "index.php";
            }
            

    }

    </script>
    <a href="register.php"> Not registered?</a>

    </body>
</html>