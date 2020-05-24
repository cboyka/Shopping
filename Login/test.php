<?php

session_start();

if(isset($_SESSION['views']))
{

	$_SESSION['views'] += 1;

}
else
{
	$_SESSION['views'] = 1;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>
		tesing
	</title>
</head>
<body>
	<p> Number of views : <?php echo $_SESSION['views']; ?></p>
	<button onlick="<? echo 'hello'; ?>" style="height:30px;width:100px;"> reset</button>
</body>
</html>