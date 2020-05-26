<?php  
session_start();
$connect = mysqli_connect("localhost","root","","testing");

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
        header("location:index.html"); 
        fwrite('index.html','<script> alert(1);</script>');
  		} 
	}
 	else
 	{
  		$message = "Both are Required Fields";
      header("location:index.html");
 	}  
 ?> 