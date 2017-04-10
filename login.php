<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['uname']) || empty($_POST['pwd'])) {
$error = "Username or Password is invalid";

}
else
{
// Define $username and $password
$username=$_POST['uname'];
$password=md5($_POST['pwd']);

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// Selecting Database
$db = mysql_select_db("parking", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from entity where Incharge_Password='$password' AND Incharge_Username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
$x=mysql_query("select * from entity where Incharge_Password='$password' AND Incharge_Username='$username' AND is_superadmin=true and is_active=1 "); 
$row1 = mysql_num_rows($x);
$y=mysql_query("select * from entity where Incharge_Password='$password' AND Incharge_Username='$username' AND is_subadmin=true AND is_active=1"); 
$row2 = mysql_num_rows($y);
if($row1==1)
{
header("location: welcome_screen.php"); // Redirecting To Other Page
} 
else if($row2==1)
{
header("location: parking_update.php");
}

else {
$error = "Username or Password is invalid";
echo $error;

}
mysql_close($connection); // Closing Connection
}
else {
$error = "Username or Password is invalid";
echo $error;
}

}
} 
?>