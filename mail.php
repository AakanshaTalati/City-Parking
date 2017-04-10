<?php
include('user_session.php');
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);

?>
<html>
<head>
<style>
body
{ 
background: url(b1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
i
{
color:#fff;
}
.a21
{
display:inline;
}

input[type=submit] {

width:20%;
background-color:#E6E6E6;
color:#111;
border:2px solid #fff;
padding:10px;
font-size:20px;
cursor:pointer;
border-radius:10px;
margin-bottom:15px;
margin-top:15px;
}
#aa
{

border-radius:10px;
border:2px double #fff;
width:500px;
}


</style>
<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>


</head>
<body>
<font size = 3>
<h1 style="color:#fff;" align="center">CITY PARKING</h1>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
            <a class="navbar-brand" href="welcome_screen.php"><i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge']; ?></i></a>
    </div>
	
    <div>
      <ul class="nav navbar-nav navbar-right">
       <!--<li><a  href = "welcome_screen.php" name = "entity" ><span class="glyphicon glyphicon-user"></span>  ENTITY </a></li>
		<li class = "active"><a  href = "admin_records.php" name = "user" ><span class="glyphicon glyphicon-user"></span>  USER </a></li>-->
		
		<li><a  href = "logout.php" name = "logout" >LOGOUT </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<body>
<div align="center">
<form action="gmail.php" method="post">
<br>

<div id="aa" align="center">
<div class="a1">
<div id="a11"><br>
<i>Authentication Gmail id:</i>
        <input type="email" name="aid" placeholder="Enter your id" value="parkingartdev@gmail.com" required/>
</div><div id="a12">        <br><i>Password:</i>
		<input type="password" name="pws" placeholder="********" value="122104ad" required /><br></div></div>
<div class="a1"> 
		<div class="a1">

		<div id="a31">
		<br><i>Receiver's Name :</i>
		<input type="text" name="rname" value="<?php echo $name ?>" required pattern="[a-zA-Z]+"/>
		<br/></div><div id="a32">
<br>		<i>Receiver's Mail:</i>
		<input type="email" name="rid"  value="<?php echo $id ?>" required/><br/>
</div></div>
<input type="submit" name="submit" value="Submit">
</div>
</form></div>
</body>
</html>
