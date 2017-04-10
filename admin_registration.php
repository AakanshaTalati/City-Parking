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
<link rel="stylesheet" href="">
<!--<style>
.main{
width:100%;
}
.art{
display:inline;
float:left;
width:50%;
}
.dev{
display:inline;
float:left;
width:30%;
}
.submit{
width:50%;
background-color:#FFFFFF;
color:green;

padding:10px;
font-size:20px;
cursor:pointer;
border-radius:5px;
margin-bottom:15px;
margin-top:15px;
}
</style>-->

<style>
input[type=submit] {

width:20%;
background-color:#526666;
color:#fff;
border:2px solid #fff;
padding:10px;
font-size:20px;
cursor:pointer;
border-radius:10px;
margin-bottom:15px;
margin-top:15px;
}

i
{
color:#fff;
padding-top:10px;
}

body
{ 
background: url(b1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
input[type=submit] {

width:20%;
background-color:##526666;
color:#fff;
border:2px solid #fff;
padding:10px;
font-size:20px;
cursor:pointer;
border-radius:10px;
margin-bottom:15px;
margin-top:15px;
}
.admin
{
width:100px;

}


.dev
{
background-color:transparent;
border-radius:10px;
border:2px double #fff;
width:500px;
}
</style>
</head>

<body>
<font size = 3>
<h1 style="color:#fff;" align="center"><a style="color:white" href="welcome_screen.php">CITY PARKING</a></h1>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      
    </div>
	
    <div>
      <ul class="nav navbar-nav navbar-right">
        <li><a> <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i></a> </li>

		
				
		<li><a  href = "logout.php" name = "logout" > logout </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<title>SuperAdmin Form</title>
<h1 align=center style="color:white">Insert New Entity</h1>
<!--<body>-->
<div align="center">
<form name="form"  method="post" action="">
<!--<div class=main>

<div class=dev>-->
<br>
<div class="dev"><br><br> 


<i>Entity Name:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="ename" value=""  required pattern="[a-zA-Z0-9]+"><br><br>
<i>Capacity:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="number" name="cap" required></br>
<br>
<i>Entity Incharge:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="eIncharge" value=""  required pattern="[a-zA-Z0-9]+">
<br><br>
<i>Incharge Username:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="email" name="uname" value=""  required>
<br/><br>
<i>Incharge Password:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" name="pd" value=""  required>

</br>
<br>

<input type="submit" name="submit" value="Submit">
<br>
<?php

if(isset($_POST['submit']))
{
	
 
//$id = $_POST['ID'];
$ename = $_POST['ename'];
$ein = $_POST['eIncharge'];
$uname = $_POST['uname'];
$pwd = md5($_POST['pd']);
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
$token=random_string(50);
//echo $id;
//$email = $_POST['email'];
//$superadmin = $_POST['supadmin'];
//$subadmin = $_POST['subadmin'];

//$active = $_POST['active'];
//$update_date = $_POST['update_date'];
$cap= $_POST['cap'];
//$timezone = date_default_timezone_get();
//$create_date = $_POST['create_date'];

//echo "The current server timezone is: " . $timezone;
//echo "INSERT INTO entity (Entity_ID,Entity_name,Entity_incharge,Incharge_Username,Incharge_Password,Incharge_Email,flag) VALUES ('$id','$ename','$ein','$uname','$pwd','$email','$flag')"; exit;

$sel=mysql_query("Select * from entity where `Incharge_Username`='$uname' ");
$sel1=mysql_num_rows($sel);
$sel2=mysql_fetch_array($sel);
if($sel1 > 0)
{ 


echo "<i style='color:red;'> username Already exists</i>";

}
else 
{
mysql_query ("INSERT INTO `entity` (`Entity_name`, `Entity_incharge`, `Incharge_Username`, `Incharge_Password`,`token`,`capacity`) VALUES ('$ename','$ein','$uname','$pwd','$token','$cap')");
	
	header("location:mail.php?id=$uname&name=$ein");
}	
}



	?>

<br><br></div>

<!--</div>-->
</form>
</div>
</body>
</html>