<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

$genderquery = "SELECT gender from admin_login";
$genderresult = mysqli_query($connect, $genderquery); 
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
		<p style="float:right" ><a href="Login/logout.php"><button class="btn btn-danger" style="margin:5px">Logout</button></a></p>
		<br />
		<br/>
		<h3 align="right"><b><span style="text-transform:uppercase"><?php echo $_SESSION["admin_name"]; ?></span><img src='images/M.png' width="80px" height="80px"></b>
		</h3>
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
			<div  style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive" style="border:1px solid #333; background-color:skyblue; border-radius:15px; padding:16px;opacity:0.9">
				<table class="table table-bordered" style="border:1px solid #333; background-color:skyblue; border-radius:15px; padding:16px;opacity:0.9"	>
					<tr>
						<th width="10%">Id</th>
						<th width="30%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					$id=0;
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$id += 1;
					?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="home.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>