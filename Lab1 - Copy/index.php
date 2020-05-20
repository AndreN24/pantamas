<?php
    session_start();
    if (isset($_SESSION['email'])){   
    }
    else{
        header("Location: login.php?");
    }
    
    ?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="stylecomments.css">
    <script   src="https://code.jquery.com/jquery-3.5.1.js"    ></script>

    <head>
        <a href="logout.php"> Click me to logout</a>
        <form id="myForm"  method="POST" action="server.php" onsubmit="return checkForm();" >

            <label for="Name">Name: </label>
            <input type="text" id="name" name="fname"><br>

            <label for="email">E-mail:</label>
            <input type="text" id="email" name="femail"><br>
            
            <label id="commentText" for="comment">Comment:</label>
            <input type="text" id="comment"  name="fcomment"><br>


            <input type="submit"  value="Submit" id="submit">
            
          </form>


  
          <?php


            $db = new SQLite3 ("DB/comments.db");
            $res = $db->query('SELECT * FROM comments');
            while ($row = $res->fetchArray()) {
                echo " <h1>ID: {$row['id']}, EMAIL: <i>{$row['email']}</i>, NAME: {$row['names']}</h1> COMMENT: {$row['comment']} <br><br>";
                
            }
            
            ?>

          <script>


            $(document).ready(function (){
                checkForm = function () {

                    const myForm = document.getElementById("myForm");
                    

                    var name = document.getElementById("name").value;              
                    var email = document.getElementById("email").value;
                    var comment = document.getElementById("comment").value;
                    


                        if (name.trim().length > 0 && email.trim().length > 0 && comment.trim().length > 0){ // check if email, name and comment is not empty
                            if (email.includes("@") && email.includes(".")){        //check if email includes . and @
                                return true;
                                
                            }
                            else{
                                alert("Email error");                               
                                return false;
                            }
                        }
                        else{
                            alert("Name length: "+name.length+ " Email length: " + email.length + " Comment length: " + comment.length+". The length of all values must be greater than 0!");
                            return false;
                    }
                }
            });
            
          </script>
    </head>
    <body>

    </body>

</html>