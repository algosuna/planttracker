<?php
require 'db/validate.php';
if($_SESSION['signed_in']!=true){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Plant Tracker | New Plant</title>

	<meta http-equiv="viewport" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      h1,p.lead{
      	text-align:center;
      }
      .row a{
        text-align:center;
      }

    </style>
	<link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">

    	<h1>Plant Tracker</h1>
      <p class="lead">Nothing to see here yet!</p>

    	<!--<form class="form-signin" action="signup.php" method="post">
    		<h2 class="form-signin-heading">Please sign up<br /><small>Just for security and stuff...</small></h2>
    		<input type="text" name="name" class="input-block-level" placeholder="Name" value="<?php if($valid==false) echo $name ?>">
    		<?php echo $name_error ?><?php echo $length_error ?>
    		<input type="text" name="email" class="input-block-level" placeholder="Email address" value="<?php if($valid==false) echo $email ?>">
    		<?php echo $email_error ?><?php echo $valid_email_error ?>
    		<input type="password" name="password" class="input-block-level" placeholder="Password">
    		<input type="password" name="repassword" class="input-block-level" placeholder="Re-type Password">
    		<?php echo $password_error ?>
	    	<button class="btn btn-large btn-primary" type="submit">Sign up</button>
	    	<input type="hidden" name="did_signup" value="true" />
	    	<?php echo $db_error ?>
	    </form>
      -->

      <!--
      <div class="row">
        <div class="span3 offset3">
          <footer>
            <a href="/">Sign out</a>
          </footer>
        </div>
      </div>-->

	</div> <!-- /container -->

	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/js/bootstrap.min.js">
    $(".alert").alert()
    </script>
</body>
</html>