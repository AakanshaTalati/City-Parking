<?php
include('user_session.php');

$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);



?>
<html>
<head> 
<title> WELCOME </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
a
{
color:#111;
}
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
<body >

<font size = 5>

<h1 style="color:#fff;" align="center"><b>CITY PARKING</b></h1>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     
	  
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
        <li><a> <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i></a> </li>

		<li class = "active"><a  href = "welcome_screen.php" name = "entity" >  Entity </a></li>
		<li class = "active"><a  href = "user_records.php" name = "entity" >  Listing </a></li>
				
		<li><a  href = "logout.php" name = "logout" > logout </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<li  class = "nav navbar-nav navbar-middle"><a  href = "admin_registration.php" name = "add" float = "left" ><i> insert entry</i> </a></li>
<br><br>
<h1 align=center style="color:white">ENTITY</h1>
<div class="container">
<?php

$sql = "SELECT * FROM `entity`";
$entities = mysql_query($sql);

echo "<table style='color:#111;border-radius:10px;opacity:0.5;background-color:#fff;width:91%;margin-left:59px;border:2px solid #111;' border=1 class='table table-hover' >
<tr>
  <tr>
    

    <th>Entity_Name</th>		
    <th>Entity_incharge</th>
	<th>Username</th>
	<th>is_active</th>

	<th>Action</th>
	
	
  </tr>
</tr>";
while($entity = mysql_fetch_array($entities)){

echo "<tr>";


echo "<td>" . $entity['Entity_name'] . "</td>";
echo "<td>" . $entity['Entity_incharge'] . "</td>";
echo "<td>" . $entity['Incharge_Username'] . "</td>";

echo "<td>" . $entity['is_active'] . "</td>";

 
echo "<td><a style='color:blue;' href='admin_update_info.php?id=" . $entity['Entity_ID']."'>EDIT</a>"; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php $Msg = "Are you sure to delete"; ?>
<a onClick="return confirm('Are you sure to delete');" style="color:red;" href="welcome_screen.php?id=<?php echo $entity['Entity_ID']; ?>"><b>X</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo "<a  href='user_records.php?id=" . $entity['Entity_ID']."'><b>GO</b></a></td>";

echo "</tr>";

}

echo "</table>";

if(isset($_GET['id']))
{
$id=$_GET['id'];
	

$DeleteQuery = "DELETE FROM `entity` WHERE `Entity_ID`='$id'";          
$sql=mysql_query($DeleteQuery);

}
?>



</body>
</html>