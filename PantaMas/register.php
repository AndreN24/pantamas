<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<!------ Include the above in your HEAD tag ---------->

<html>
<link rel="stylesheet" href="css\style.css">

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
		<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
	</p>
	<p class="divider-text">
        <span class="">OR</span>
    </p>

	<form>
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Full name" type="text">
    </div>

    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="User name" type="text">
    </div>

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
        <input class="form-control" placeholder="Create password" type="password">
    </div> 

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Repeat password" type="password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div>

    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
</form>
</article>