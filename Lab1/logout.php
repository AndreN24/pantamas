<?php

session_start();
if (session_status() == "2") // if session is started
{
session_destroy();
echo "Sucessfully logged out";
}
else{
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html>
    <head>
    <form id="myForm" action="login.php" >

    <input type="submit" value="Click me to login again" id="submit">

</form>
    </head>
</html>