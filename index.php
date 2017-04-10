<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
$a=mysql_query("select is_superadmin from entity where is_superadmin=true and is_active=1");
$b=mysql_query("select is_subadmin from entity where is_subadmin=true and is_active=1");
if($a)
{
header("location: welcome_screen.php");
}
else if($b)
{
header("location: parking_update.php");
}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>LOGIN PAGE</title>
<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>
 
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body >
<div id="main">
<h1><b id="c" style="color:white;">  &nbsp;&nbsp;CITY PARKING</b></h1>
<div id="login">
<form action="" method="post">
<h4><label>UserName :</label>
<input id="name" name="uname" placeholder="Email-ID" type="email">
</h4><h4><label>Password :</label>
<input id="password" name="pwd" placeholder="**********" type="password">
</h4>
<b><input name="submit" type="submit" value=" Login " ></br></b>
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>