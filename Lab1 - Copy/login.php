<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script   src="https://code.jquery.com/jquery-3.5.1.js"    ></script>

    <head>

    <?php
    session_start();
    if (isset($_SESSION['email'])){   
        header("Location: index.php");
    }
    
    ?>
    <h1>Login  </h1>
        <form id="myForm" method="POST" action="CheckLogin.php">

            <label for="email">E-mail:</label>
            <input type="text" id="email"  name="femail"><br>
            
            <label for="password">Password:</label>
            <input type="text" id="password"  name="fpassword"><br>


            <input type="submit" value="Submit" id="submit">
            
          </form>
    </head>
    <body>
    <a href="register.php"> Not registered?</a>

    </body>
</html>