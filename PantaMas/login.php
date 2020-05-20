<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<!------ Include the above in your HEAD tag ---------->

<html>
<head>
</head>
<body>
    <script>
    function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
                 // The current login status of the person.
        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
        testAPI(response.authResponse.userID, response.email);
        } else {                                 // Not logged into your webpage or we are unable to tell.
        }
    }
    function checkLoginState() {               // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function(response) {   // See the onlogin handler
        statusChangeCallback(response);
        });
    }
    window.fbAsyncInit = function() {
        FB.init({
        appId      : '3117852921599127',
        cookie     : true,                     // Enable cookies to allow the server to access the session.
        xfbml      : true,
        version    : 'v7.0'
        });
        FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
        statusChangeCallback(response);        // Returns the login status.
        });
    };
    
    (function(d, s, id) {                      // Load the SDK asynchronously
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    function testAPI(id, email) {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
        console.log('Welcome!  Fetching your information.... ');
        var email;
        FB.api(
            "/"+id,
            'GET',
            {"fields":"birthday,name,email,hometown"},
            function(response) {
                window.location.href = "RegisterUser.php?name=" + response.name+" &id="+response.id+" &email="+response.email;
            }
        );
    }
    </script>

    <div id="status">
    </div>
    </body>
    
<link rel="stylesheet" href="css\style.css">

<div class="header">
    <ul class="topnavbar">
        <li><a href="login.php">Log In</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

    <div class="logo">
    <picture>
    <img src="Pantamas_logga.png" alt="logo" height="70" width="300">
    </picture> <br> <br>
    </div>

    <ul class="bottomnavbar">
    <li><a href="contact.php">Contact</a></li>
    <li><a href="FAQ.php">FAQ</a></li>
    <li><a href="about.php">About</a></li>
    </ul>
</div>

<h1>
    Welcome to Pantamás!
</h1>


<p class="divider-text">
    <span class=""></span>
</p>

</html>

<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<p>
    <fb:login-button onclick="checkLoginState();"  scope="public_profile,email" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i> </fb:login-button>
	</p>
	<p class="divider-text">
        <span class="">OR</span>
    </p>

	<form>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Email address" type="email">
    </div>

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Password" type="password">
    </div> 

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Log In  </button>
    </div>

    <p class="text-center">Don't have an account? <a href="register.php">Create an account</a> </p>                                                                 
</form>
</article>