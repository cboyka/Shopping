<?php  
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");  
if(isset($_POST["login"]))   
{  
	if(!empty($_POST["member_name"]) && !empty($_POST["member_password"]))
	{
  		$name = mysqli_real_escape_string($connect, $_POST["member_name"]);
  		$password = md5(mysqli_real_escape_string($connect, $_POST["member_password"]));
  		$sql = "Select * from admin_login where admin_name = '" . $name . "' and admin_password = '" . $password . "'";  
  		$result = mysqli_query($connect,$sql);  
  		$user = mysqli_fetch_array($result);
  		$_SESSION["admin_name"] = $name;  
  		if($user)   
  		{  
   			if(!empty($_POST["remember"]))   
   			{  
    			setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));  
    			setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
   			}  
   			else  
   			{  
    			if(isset($_COOKIE["member_login"]))   
    			{  
     				setcookie ("member_login","");  
    			}  
    			if(isset($_COOKIE["member_password"]))   
   				{  
     				setcookie ("member_password","");  
   				}  
   			}  
   			header("location:homepage.php"); 
  		}  
  		else  
  		{  
   			$message = "Invalid Login";  
  		} 
	}
 	else
 	{
  		$message = "Both are Required Fields";
 	}
}  
 ?>  
<html>  
 <head>  
  <title>CS_Shopping</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <style>  
  body  
  {  
   background:url('images/bg.jpg') no-repeat fixed center;  
   background-size:cover;
   height:auto;
   width:auto;
  }  
  .box  
  {  
   width:700px;  
   padding:20px;   
  }  
  </style>  
 </head>  
 <body> 
  <div class="container box" style="margin-top:200px;background:url('images/bg1.png') no-repeat center;background-size:cover">  
   <form action="" method="post" id="frmLogin"> 
    <h3 align="center">WELCOME TO <i><b>CS_Shopping</i></b></h3><br />
    <div class="form-group" >  
     <label for="login">Username</label>  
     <input name="member_name" type="text" value=" " class="form-control" autofill="false" />  
    </div>  
    <div class="form-group">  
     <label for="password">Password</label>  
     <input name="member_password" type="password" value="" class="form-control" autofill="false" />   
    </div>  
    <div class="form-group">  
     <input type="checkbox" name="remember-me" />  
     <label for="remember-me">Remember me</label>  
    </div>  
    <div class="form-group">  
     <div style="margin-left:190px;margin-top:100px"><input type="submit" name="login" value="Login" class="btn btn-primary btn-lg btn-block" style="width:300px;"></span></div>  
    </div>   
   </form>  
   <br />  
  </div>  
 </body>  
</html>
 




