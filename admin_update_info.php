<?php
include('user_session.php');
if($_GET['id'])
{
	
	$entity_id = $_GET['id'];
	$update_date = date("Y-m-d H:i:s");
	$qry = "UPDATE `entity` set update_date = '$update_date' where Entity_ID = $entity_id ";
	$result = mysql_query($qry);
}

$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);

?>

<html>
<head>
<style>
i
{
color:#099999;
padding-top:10px;
}
input[type=submit] {

width:20%;
background-color:#099999;
color:#fff;
border:2px solid #fff;
padding:10px;
font-size:20px;
cursor:pointer;
border-radius:10px;
margin-bottom:15px;
margin-top:15px;
}
body
{ 
background: url(b1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.dev
{

border-radius:10px;
border:2px double #099999;
width:500px;

}

</style>
<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>

</head>
<title>Update Form</title>
<body>
<font size = 3>
<h1 style="color:#099999;" align="center">CITY PARKING</h1><nav class="navbar navbar-inverse">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      
    </div>
	
    <div>
      <ul class="nav navbar-nav navbar-right">
       <!--<li><a  href = "welcome_screen.php" name = "entity" ><span class="glyphicon glyphicon-user"></span>  ENTITY </a></li>
		<li class = "active"><a  href = "admin_records.php" name = "user" ><span class="glyphicon glyphicon-user"></span>  USER </a></li>-->
		 <li><a> <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i></a> </li>
		<li><a  href = "logout.php" name = "logout" >  LOGOUT </a></li>
        
      </ul>
    </div>
  </div>
</nav>


<h1 align=center style="color:white">Edit Entity</h1>
<?php
//$x= $_GET['id'];
//echo $x;
if(isset($_GET['id']))
{
$id=$_GET['id'];

if(isset($_POST['submit']))
{
$sql3=mysql_query("UPDATE `entity` SET `Entity_name` = '$_POST[ename]',`Entity_incharge` = '$_POST[eIncharge]',`Incharge_Username` = '$_POST[uname]',`is_active` = '$_POST[active]' WHERE `entity`.`Entity_ID` = '$id'");
//echo ("UPDATE `entity` SET `Entity_ID` = '$_POST[ID]',`Entity_name` = '$_POST[ename]',`Entity_incharge` = '$_POST[eIncharge]',`Incharge_Username` = '$_POST[uname]',`Incharge_Password` = '$_POST[pwd]',`Incharge_Email` = '$_POST[email]',`is_superadmin` = '$_POST[supadmin]',`is_subadmin` = '$_POST[subadmin]',`is_entity` = '$_POST[entity]',`is_active` = '$_POST[active]',`update_date` = '$_POST[update_date]',`create_date` = '$_POST[create_date]' WHERE `entity`.`Entity_ID` = '$id'");
if($sql3)
{
header("location:welcome_screen.php");
}
}
$sql1=mysql_query("SELECT * FROM entity where Entity_ID = '$id'");
$sql2=mysql_fetch_array($sql1);
?>
<div align="center">
<div class="dev">
<form name="form" method="post" action="<?php $_PHP_SELF ?>">
<br>

<i>Entity_Name:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="ename" value="<?php echo $sql2['Entity_name']; ?>" required pattern="[a-zA-Z0-9]+" ></br>
<br>
<i>Entity_Incharge:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="eIncharge" value="<?php echo $sql2['Entity_incharge']; ?>" required pattern="[a-zA-Z]+" ></br>
<br>
<i>Incharge_Username:</i>
<input type="email" name="uname" value="<?php echo $sql2['Incharge_Username']; ?>" required></br>
<br>
<i>is_active:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="active" value="<?php echo $sql2['is_active']; ?>"></br>

<br>

<!--<button type="submit" size = "10" value=" Send" class="btn btn-primary btn-lg btn-success center-block" id="submit"> SUBMIT </button>-->



<input type="submit" name="submit" value="submit" id="submit">
</form></div>
</div><?php

}
?>
</body>
</html>