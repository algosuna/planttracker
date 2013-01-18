<?php
session_start();
require 'db_config.php';
require_once 'functions.php';

  //////////////////////
 ///////SIGN UP////////
//////////////////////

if($_POST['did_signup']=='true'){
	$name=clean_input($_POST['name']);
	$email=clean_input($_POST['email']);
	$password=clean_input($_POST['password']);
	$repassword=clean_input($_POST['repassword']);
	$sha_password=sha1($input_password);
	$valid=true;

	if($password!=$repassword){
		$valid=false;
		$password_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your passwords don't match!</div>";
	}

	if(strlen($name)>=4){
		$query_name="SELECT admin_name
					 FROM admin
					 WHERE admin_name='$name'
					 LIMIT 1";
		$result_name=mysql_query($query_name);
		if(mysql_num_rows($result_name)==1){
			$valid=false;
			$name_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Oddly enough, someone has that name...try another?</div>";
		}
	}else{
		$valid=false;
		$length_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>That name is not long enough...</div>";
	}
	if(check_email_address($email)==true){
		$query_email="SELECT admin_email
					  FROM admin
					  WHERE admin_email='$email'
					  LIMIT 1";
		$result_email=mysql_query($query_email);
		if(mysql_num_rows($result_email)==1){
			$valid=false;
			$email_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Looks like someone has the same email!</div>";
		}
	}else{
		$valid=false;
		$valid_email_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>That is not a valid email.</div>";
	}

	if($valid==true){
		$query_insert="INSERT INTO admin
					   (admin_name,admin_email,admin_password)
					   VALUES
					   ('$name','$email','$sha_password')";
		$result_insert=mysql_query($query_insert);
		if(mysql_affected_rows()==1){
			$_SESSION['signed_in']=true;
			$_SESSION['admin_id']=mysql_insert_id();
			setcookie('signed_in','true',time()+60*60*24*14);
			setcookie('admin_id',$_SESSION['admin_id'],time()+60*60*24*14);

			header('location:plant-form.php');
		}else{
			$db_error="<div class='error'><button type='button' class='close' data-dismiss='alert'>&times;</button>Cosas que suceden, con el apag&oacute;n...</div>";
		}
	}
}

  /////////////////////
 ///////SIGN IN///////
/////////////////////

if($_POST['did_signin']=='true'){
	$email=clean_input($_POST['email']);
	$password=clean_input($_POST['password']);
	$sha_password=sha1($password);
	$valid=true;

	if(strlen($email)==0 OR strlen($password)==0){
		$valid=false;
		$empty_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Please type in your email and password.</div>";

	}

	if(check_email_address($email)==true){
		$query_email="SELECT admin_email
					  FROM admin
					  WHERE admin_email='$email'
					  LIMIT 1";
		$result_email=mysql_query($query_email);
		if(mysql_num_rows($result_email)!=1){
			$valid=false;
			$mismatch_email_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>It appears this email does not have an account.</div>";
		}
	}else{
		$valid=false;
		$valid_email_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>That is not a valid email.</div>";
	}
	
	if($valid==true){
		$query_login="SELECT admin_email,admin_password
					  FROM admin
					  WHERE admin_email='$email'
					  AND admin_password='$sha_password'
					  LIMIT 1";
		$result_login=mysql_query($query_login);
		if(mysql_num_rows($result_login)==1){
			$row_login=mysql_fetch_array($result_login);
			
			setcookie('signed_in','true',time()+60*60*24*14);
			setcookie('admin_id',$row_login['admin_id'],time()+60*60*24*14);
			
			$_SESSION['signed_in']=true;
			$_SESSION['admin_id']=$row_login['admin_id'];
			
			header('location:plant-form.php');
		}else{
		$valid=false;
		$password_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>That is not the correct password.</div>";
		}
	}else{
		$valid=false;
		$password_error="<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>That is not..well...I don't know...</div>";
	}
}

///////////////////////////////////////////////////////////////////////////////////////
if($_COOKIE['signed_in']==true){
	$_SESSION['signed_in']=true;
	$_SESSION['admin_id']=$_COOKIE['admin_id'];
		$admin_id=$_SESSION['admin_id'];
		$query_user="SELECT * FROM admin
					 WHERE admin_id=$admin_id
					 LIMIT 1";
		$result_user=mysql_query($query_user);
		$row_user=mysql_fetch_array($result_user);

$admin_id=$row_user['admin_id'];
$current_user=$row_user['username'];
}