<?php
include('user_session.php');
if(isset($_GET['id']))
{
$id=$_GET['id'];

}

//$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$id'");
$ent=mysql_query("Select `Entity_incharge` from entity");
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
<body> 
<font size = 5>
<h1 style="color:#fff;" align="center"><a style="color:white" href="welcome_screen.php">CITY PARKING</a></h1>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
   
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
	  <li><a> <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i></a> </li>
	  
		<li><a  href = "logout.php" name = "logout" style="margin-top:10px;" > LOGOUT </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<h1 align=center style="color:white">Search Records</h1>
<div align="center">
<form action='<?php $_PHP_SELF ?>' method="post"> <input type=date placeholder="date" style="margin-top:10px;" name="from_date" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text style="width:250px;" name="vehicle" placeholder="GJ 00 QQ 1111"> 
<!--<li><input type=date style="margin-top:10px;" name="to_date" value="" > </a></li>-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
		<input type=submit name="go" style="padding-top:-10px;width:50;height:40;border-radius:35px;" value="GO" >
		</form>
		</div><br>
<?php


if(isset($_POST['from_date']))
{
$date=$_POST['from_date'];
//$date1=$_POST['to_date'];
$vehicle=$_POST['vehicle'];

//$entity=$_POST['entity'];




//$sql1 = "SELECT * FROM book where DATE(`in_time`)='$date' and `entity_id`='$id' or `vehicle_no`='$vehicle'	";
$sql1 = "SELECT * FROM book where DATE(`in_time`)='$date' or `vehicle_no`='$vehicle'	";
$a1 = mysql_query($sql1);
echo "<table style='border-radius:10px;opacity:0.5;background-color:#fff;color:#111;width:91%;margin-left:59px;' border=1 class='table table-hover' >

  <tr>
    <th>vehicle_no</th>
	<th>intime</th>
    <th>outtime</th>		
    <th>parkingblock</th>
	</tr>
";
while($b = mysql_fetch_array($a1)){

echo "<tr>";

echo "<td>" . $b['vehicle_no'] . "</td>";
//echo "<td>" . $b['Token No'] . "</td>";
echo "<td>" . $b['in_time'] . "</td>";
echo "<td>" . $b['out_time'] . "</td>";
echo "<td>" . $b['park_block'] . "</td>";
//echo "<td>" . $b['Time allotted'] . "</td>";
//echo "<td>" . $b['Contact'] . "</td>";
//echo "<td>" . $b['Email'] . "</td>";
 /*echo "<td>" . $b['Contact'] . "</td>";
echo "<td>" . $b['Email'] . "</td>";
echo "<td>" . $b['update_date'] . "</td>";
echo "<td>" . $b['create_date'] . "</td>";

 
//echo "<td><a  href='parking_lot_registration.php?id=" . $b['Vehicle No']."'>Update</a></td>";
//echo "<td><a href='parking_update.php?id=".$b['Vehicle No']."'>X</a></td><tr>";*/

echo "</tr>";


}
echo "</table>";
}
else
{

$sql1 = "SELECT * FROM book ";
$a1 = mysql_query($sql1);
echo "<table style='border-radius:10px;opacity:0.5;background-color:#E6E6E6;width:91%;margin-left:59px;' border=1 class='table table-hover' >

  <tr>
    <th>vehicle_no</th>
	<th>intime</th>
    <th>outtime</th>		
    <th>parkingblock</th>
	<th>entity</th>
	</tr>
";
while($b = mysql_fetch_array($a1)){

echo "<tr>";

echo "<td>" . $b['vehicle_no'] . "</td>";
//echo "<td>" . $b['Token No'] . "</td>";
echo "<td>" . $b['in_time'] . "</td>";
echo "<td>" . $b['out_time'] . "</td>";
echo "<td>" . $b['park_block'] . "</td>";
echo "<td>" . $b['entity_id'] . "</td>";
echo "</tr>";


}
echo "</table>";
}
?>
	
	
	
</body>
</html>
