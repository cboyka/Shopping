<?php
session_start();
$connect = mysqli_connect("localhost","root","", "testing");


if(!isset($_SESSION['admin_name']))
echo '<script>window.location="index.html";</script>';

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>
	Basket
	</title>
	<script src="jquery.min.js"></script>
	<link rel="stylesheet" href="bootstrap.min.css" />
	<script src="bootstrap.min.js"></script>
	<script>
		function reload()
		{
			window.location="basket.php";
		}
	</script>
<style>
	body  
  {  
   background:url('images/basket_bg.jpg') no-repeat fixed center;  
   background-size:cover;
   height:auto;
   width:auto;
  } 
</style>
</head>
<body >
	<div  style="clear:both"></div>
			<br />
			<h3 align="center" class="text-danger" style="font-size:60px;background-color:#3284b3;width:auto">Order Details</h3>
			<div class="table-responsive" style="border:1px solid #333; background-color:#3cbcbe; border-radius:15px; padding:16px;opacity:0.9;width:70%;height:auto;float:left;margin-left:15%;margin-top:100px">
				<table class="table table-bordered" style="font-size:20px;border:1px solid #333; background-color:skyblue; border-radius:15px; padding:16px;opacity:0.9;width:90%;margin-top:20px" align="center"	>
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
						<td><a href="basket.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="4" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
		<br>
		<br>
		<button onclick="reload()" class="btn btn-primary" style="float:right;margin-right:45%;width:200px;height:50px;margin-top:40px">Refresh</button>
	</body>
	</html>