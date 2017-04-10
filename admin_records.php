<?php
include('user_session.php');
$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);

?>

<html>
<head>
<title>User Listing</title>



<style>
body
{ 
background: url(b1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-info">
<font size = 5>
<h1 style="color:#fff;" align="center">CITY PARKING</h1>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge']; ?></i></b>
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
        <li><a  href = "welcome_screen.php" name = "entity" >  ENTITY </a></li>
		<li class = "active"><a  href = "admin_records.php" name = "user" >  USER </a></li>
		
		<li><a  href = "logout.php" name = "logout" > LOGOUT </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<?php
$sql1 = "SELECT * FROM entity";
$a1 = mysql_query($sql1);
echo "<table style='border-radius:10px;opacity:0.5;background-color:#fff;width:91%;margin-left:59px;' border=1 class='table table-hover' >
<tr>
  <tr>
    <th>Entity_ID</th>
	<th>Entity_incharge</th>
    <th>Incharge_Username</th>		
    <th>Incharge_Password</th>
	<th>Incharge_Email</th>
	<th>update_date</th>
	<th>create_date</th>
	<th></th>
 </tr>
</tr>";
while($b = mysql_fetch_array($a1)){

echo "<tr>";
echo "<td>" . $b['Entity_ID'] . "</td>";
echo "<td>" . $b['Entity_incharge'] . "</td>";
echo "<td>" . $b['Incharge_Username'] . "</td>";
echo "<td>" . $b['Incharge_Password'] . "</td>";
echo "<td>" . $b['Incharge_Email'] . "</td>";
echo "<td>" . $b['update_date'] . "</td>";
echo "<td>" . $b['create_date'] . "</td>";
/*echo "<td>" . $b['Contact'] . "</td>";
echo "<td>" . $b['Email'] . "</td>";
echo "<td>" . $b['update_date'] . "</td>";
echo "<td>" . $b['create_date'] . "</td>";

 
//echo "<td><a  href='parking_lot_registration.php?id=" . $b['Vehicle No']."'>Update</a></td>";
//echo "<td><a href='parking_update.php?id=".$b['Vehicle No']."'>X</a></td><tr>";*/
echo "<td><a  href='user_records.php?id=" . $b['Entity_ID']."'><b>GO</b></a></td>";
echo "</tr>";


}
echo "</table>";

?>
	
	
	
	
</body>
</html>
