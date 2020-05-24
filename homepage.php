<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

if(!isset($_SESSION['admin_name']))
echo '<script>window.location="index.php";</script>';

$genderquery = "Select * from admin_login where admin_name ='".$_SESSION["admin_name"]."'";
$genderresult = mysqli_query($connect, $genderquery);
$genderarray = mysqli_fetch_array($genderresult);
$gender = $genderarray["gender"];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CS Shopping Cart</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body style="background:url('images/header.jpg') no-repeat fixed;background-color:#abf0e9">
		<br/>

		<div style="background-color:blue;width:50%;float:right;height:60px;">
			<p style="float:right" ><a href="Login/logout.php"><button class="btn btn-danger" style="margin-top:15%;margin-right:15px">Logout</button></a></p>
			
				<a href="basket.php" target="_blank"><img src="images/basket.png" width="50px" height="50px" style="margin-top:8px;float:right;margin-right:360px"></a>
				

		<h3><img src='images/<?php echo $gender;?>.png' width="80px" height="80px" style='margin-left:36%;position:absolute;margin-top:0px'><span style="text-transform:uppercase;margin-left:40%;"><i>My Basket</i></span><br/><br/><br/><span style="text-transform:uppercase;margin-left:73%;"><?php echo $_SESSION["admin_name"]; ?></span><br/><br/><br/></h3>
		

	</div>
		<div class="container">
			<br />
			<br />
			
			<br /><br />
			<?php
				$query = "SELECT * FROM tbl_product ORDER BY name ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="home.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#a8eded; border-radius:15px; padding:16px;opacity:0.9;margin-top:10px" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" width="500" height="600" /><br />

						<h4 class="text-outline-light"><?php echo $row["name"]; ?></h4>

						<h4 style="color:red">$ <?php echo $row["price"]; ?></h4>

						<input type="number" name="quantity" value="1" class="form-control" style="width:100px" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>

			</div>
			<?php
					}
				}
			?>
	</div>
	<br />
	<div style="height:150px">
	</div >
	</body>
</html>