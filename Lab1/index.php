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
    <div id="sdiv">
            <a href="logout.php" id="logout"> Click me to logout</a>

            <input type="text" id="search" placeholder="Search..">
            <button type="submit" id="searchbtn" onclick="Search();">Submit</button>
            <button type="submit" id="searchbtn" onclick="window.location.href='profile.php'">Profile</button>

            </div>

        
        <form id="myForm"  onsubmit="return false;" >

            <label for="Name">Name: </label>
            <input type="text" id="name" name="fname"><br>
            
            <label id="commentText" for="comment">Comment:</label>
            <textarea type="text" id="comment"  name="fcomment"></textarea>

            <label  for="image">Image URL:</label>
            <textarea type="text" id="image"  name="fimage"></textarea>



            <input type="submit"  value="Submit" id="submit" onclick="checkForm();">
            
          </form>
          <div id="myDiv">
          </div>


          <script>

            function checkForm () {                    
                var name = $('#name').val();              
                var comment = $('#comment').val();
                var url = $('#image').val();

        

                if ($.trim(name).length > 0 && $.trim(comment).length > 0){ // check if email, name and comment is not empty                 
                    sendAjax(name, comment, "", url);
                }
                else{ //error message.
                    alert("Name length: "+name.length+ "\n Comment length: " + comment.length+" \nThe length of all values must be greater than 0!");
                }
            }

            function Search (){
                var search = $('#search').val();
                if (search.length > 0){
                sendAjax("", "", search, "");
                }
                else{
                    alert("You need to input atleast one character to search");
                }
            }

            function sendAjax(name, comment, search, imageURL){
                $.post("server.php", {fname:name, fcomment:comment, fsearch:search, image:imageURL}, function(result){ // ajax call on server.php with a post request
                        console.log(result);
                        var data = JSON.parse(result); //parse result in  json
                        $('#myDiv').html(""); // clear div
                        for (i = 0; i < data.length; i++) { //write out all the data recieved from the database.
                        $('#myDiv').append("<h1>ID: "+data[i].id +
                        "<img src="+data[i].image+">"+
                         " EMAIL: <i>"+data[i].email+
                         "</i> NAME: "+data[i].names+
                         "</h1> <strong>COMMENT:</strong> <em>"+data[i].comment+"</em> \n");
                        }
                    });    
            }

            
          </script>
    </head>
    <body>

    </body>

</html>