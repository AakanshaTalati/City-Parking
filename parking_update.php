<?php
include('user_session.php');

$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);


?>

<html>
<head>

<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>


<style>
#x
{
margin-top:20px;
padding-bottom:20px;
color:#fff;
}
th
{
width:15%;
}
.navbar navbar-inverse
{
background-color:#fff;
}
body
{ 
background: url(b1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
#aa
{

}
i
{
color:#fff;
}
</style>
</head>
<body >
<font size = 3>
<h1 id="x" align="center">CITY PARKING</h1>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <li><a class="navbar-brand" href="parking_lot_registration.php"><b id="welcome"><i>Welcome : <?php echo $b['Entity_incharge'];  ?></i></b></a></li>
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
     <li><form action="parking_update.php" method="post">   
		<input type=date style="margin-top:20px;" name="date" value="<?php echo date("Y-m-d");?>" > </a></li><li>
        &nbsp; &nbsp; &nbsp; 
		<input type=submit name="go" style="width:50;height:40;margin-top:20px;border-radius:35px;" value="GO" > </a></li>
		</form>
		<!--<li><a> <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i></a> </li>-->
		<li><a  href = "logout.php" name = "logout" style="margin-top:8px;" > <h4>LOGOUT </h4></a></li>
        
      </ul>
    </div>
  </div>
</nav>
<li><a class="navbar-brand" href = "parking_lot_registration.php" name = "add" id="aa"> <i>INSERT ENTRY </i></a></li>
<h1 align=center style="color:white">Records</h1>
<br><br>
<?php
if(isset($_POST['date']))
{
$date=$_POST['date'];
/*
$sel_date=mysql_query("select in_time from book");
$date1=array();


while($se_dat = mysql_fetch_array($sel_date))
{
$date1=date('Y-m-d', strtotime($se_dat['in_time']));
} 
 
if(strtotime($date1) == strtotime($date)){
// echo $date1; echo "<br>";
 echo $date1;*/	 
$sql1 = "SELECT * FROM book where `Entity_ID`='$login_session' AND DATE(`in_time`)='$date' ";


$a1 = mysql_query($sql1);
echo "<table style='opacity:0.5;background-color:#E6E6E6;width:91%;margin-left:59px;' border=1 class='table table-hover' >



  <tr>
    
	<th style='width:10%;'>Vehicle No</th>
    		
    <th style='width:10%;'>Intime</th>
	<th style='width:10%;'>Outtime</th>
	<th style='width:10%;'>Block</th>
	<th style='width:10%;'></th>

</tr>";
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
 
echo "<td><a style='color:green;' href='parking_lot_registration.php?id=" . $b['vehicle_no']."'>Update</a></td>";

echo "</tr>";


}
echo "</table>";



}
else
{
$sql1 = "SELECT * FROM book where `Entity_ID`='$login_session' ";


$a1 = mysql_query($sql1);
echo "<table style='opacity:0.5;background-color:#E6E6E6;width:91%;margin-left:59px;' border=1 class='table table-hover'>
<tr>
  <tr>
    
	<th style='width:10%;'>Vehicle No</th>
    		
    <th style='width:10%;'>Intime</th>
	<th style='width:10%;'>Outtime</th>
	<th style='width:10%;'>Block</th>
	<th style='width:10%;></th>
	
 </tr>
</tr>";
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
 
echo "<td><a  href='parking_lot_registration.php?id=" . $b['vehicle_no']."'>Update</a></td>";

echo "</tr>";


}
echo "</table>";


}
?>

</body>
</html>