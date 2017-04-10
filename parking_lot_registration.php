<?php
error_reporting(0);
include('user_session.php');
$ent=mysql_query("Select `Entity_incharge` from entity where Entity_ID='$login_session'");
$enti=mysql_num_rows($ent);
$b = mysql_fetch_array($ent);


// Get Parking block capacity from entity table -- START

$entity_id = $login_session;
$res = mysql_query("select capacity from entity where Entity_ID = $entity_id");
//echo $res;
$Capacity = mysql_fetch_array($res);
$Capacity = $Capacity['capacity'];
// Get Parking block capacity from entity table -- OVER

// Get booked block from book table -- START
$res = mysql_query("select * from book where entity_id = $entity_id");
$booked= array();
$Current_date = date("Y-m-d");
while($data = mysql_fetch_array($res))
{
	$date = explode(" ",$data['in_time']);
	if($data['in_time'] != NULL && $data['out_time'] == NULL && $date[0] == $Current_date)
		$booked[] = $data['park_block'];
}
// Get booked block from book table -- OVER

$reserved = array(); // fetch all reserved parking slot by app from 
$column = 10;

// handle post request and save data into database.
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Current_date = date("Y-m-d");
	$vehicle_no = $_REQUEST['vehicle_no'];
	$in_time = date("Y-m-d H:i:s");
    $block = $_REQUEST['block'];
	
	$res = mysql_query("select * from book where entity_id = $entity_id AND out_time IS NULL AND vehicle_no = '$vehicle_no' AND DATE_FORMAT(in_time, '%Y-%m-%d') = '$Current_date' ");
	$DuplicateCount = mysql_num_rows($res);
	if($DuplicateCount > 0)
	{	
		header("location:parking_lot_registration.php?status=duplicate");
	}
	else
	{
		$qry = "INSERT INTO book (`vehicle_no`,`entity_id`,`in_time`,`park_block`) VALUES ('$vehicle_no',$entity_id,'$in_time','$block' )";
		$result = mysql_query($qry);
		if($result)
			header("location:parking_update.php?status=success");
		else
			header("location:parking_update.php?status=error");
	}
}

// When click on Exit then update book table and free parking block -- START
if($_GET['exit'])
{
	$block = $_GET['block'];
	$entity_id = $_GET['entity_id'];
	$out_time = date("Y-m-d H:i:s");
	$qry = "UPDATE book set out_time = '$out_time' where entity_id = $entity_id AND park_block = '$block' ";
	$result = mysql_query($qry);
	if($result)
		header("location:parking_update.php?status=successexit");
	else
		header("location:parking_lot_registration.php?status=errorexit");	
}
// When click on Exit then update book table and free parking block -- OVER

?>

<html>
<head>
<link rel="stylesheet" href="boo.css">
<link rel="stylesheet" href="bootheme.css">
<script src="boo.js"></script>
<script src="jquery.js"></script>
  <link rel="stylesheet" href="style.css">
<style>
#x
 {
 background-color:#E6E6E6;
border:2px solid black;
padding-top:50px;
padding-bottom:30px;
padding-left:20px;
padding-right:20px;
margin-bottom:10px;
border-radius:20px;
width:350px;
height:250px;	
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="text/javascript">
		var gSelected; // global variable
		var isReserved = 0; // global variable
		// when click on radio button td background color will be change to green and remove from previous clicked radio td back color to white
		function btnClick(v,r)
		{
			if(gSelected !== undefined)
			{
				if(isReserved === 1)
					document.getElementById("td_" + gSelected).style.backgroundColor = 'purple';
				else
					document.getElementById("td_" + gSelected).style.backgroundColor = 'white';
			}
			document.getElementById("td_" + v.value).style.backgroundColor = 'green';
			document.getElementById("block").value = v.value;
			gSelected = v.value;
			isReserved = r;
		}
		// radio buttom selection validation for at least one
		function validate()
		{
			var radios = document.getElementsByName("book");
			var formValid = false;
			
			var i = 0;
			while (!formValid && i < radios.length) {
				if (radios[i].checked) formValid = true;
				i++;
			}
			if (!formValid) alert("Select at least one parking block!");
			return formValid;                
		}
	</script>
</head>
<title>Booking</title>
<body >
<font size = 3>
<h1 style="color:#fff;" align="center"><a style="color:white" href="parking_update.php">CITY PARKING</a></h1>
<!--<h1 style="color:#099999;" align="center">CITY PARKING</h1>-->

<br/>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
       <i> <b id="welcome">Welcome :<?php echo $b['Entity_incharge'];  ?></b></i>
    </div>
	
    <div>
      <ul class="nav navbar-nav navbar-right">
       <!--<li><a  href = "welcome_screen.php" name = "entity" ><span class="glyphicon glyphicon-user"></span>  ENTITY </a></li>
		<li class = "active"><a  href = "admin_records.php" name = "user" ><span class="glyphicon glyphicon-user"></span>  USER </a></li>-->
		<li><a  href = "logout.php" name = "logout" >  LOGOUT </a></li>
      </ul>
    </div>
  </div>
</nav>

<h1 align=center style="color:white">Book the Parking Block</h1>
<div style="float:left;margin-right:20px;margin-left:150px;margin-top:100px;width=100;"  id='x'>

<?php if($_REQUEST['status'] == "duplicate"): ?>
	<p><font color="red">Duplicate vehicle found, Please try again.</font></p>
<?php endif; ?>

<?php if($_REQUEST['status'] == "success"): ?>
	<p><font color="green">Block has been booked successfully.</font></p>
<?php endif; ?>

<?php if($_REQUEST['status'] == "error"): ?>
	<p><font color="red">Error occurred while booking block.</font></p>
<?php endif; ?>

<?php if($_REQUEST['status'] == "successexit"): ?>
	<p><font color="green">Block has been free successfully.</font></p>
<?php endif; ?>

<?php if($_REQUEST['status'] == "errorexit"): ?>
	<p><font color="red">Error occurred while updating block.</font></p>
<?php endif; ?>

<form name="form" method="post" action="parking_lot_registration.php">
<table>
	<tr>
		<td style="font-size:15;color:#099999">Vehicle No :</td>
		<td style="font-size:15;color:#111"><input type="text" name="vehicle_no" value="" placeholder="GJ 00 MN 1111" required pattern="([A-Z]{2})\s([0-9]{2})\s([A-Z]{2})\s([0-9]{4})"/></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td style="font-size:15;color:#099999">Block:</td>
		<td style="font-size:15;color:#111"><input type="text" id="block" name="block" value="" readonly placeholder="Block" required /></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2" align="center">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" style="margin-top:-17px;margin-left:25px;width:78%;;" name="submit" value="Book" onClick="return validate();" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>
</div>
	<div style="float:right;width:600px;margin-right:200px;margin-top:60px;">
		<table width="100%">
			<tr>
				<td style="font-size:12;color:#099999">Capacity: <?php echo $Capacity; ?></td>
				<td >&nbsp;&nbsp;</td>
				<td style="font-size:12;color:#099999">Booked: <?php echo count($booked); ?></td>
				<td>&nbsp;&nbsp;</td>
				<td style="font-size:12;color:#099999">Available: <?php echo ($Capacity-count($reserved)-count($booked)); ?></td>
				<td>&nbsp;&nbsp;</td>
				<td style="font-size:12;color:#099999" bgcolor="red">&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="font-size:12;color:#099999">&nbsp;Booked</td>
				<td>&nbsp;&nbsp;</td>
				<td style="font-size:12;color:#099999" bgcolor="green">&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="font-size:12;color:#099999">&nbsp;Selection</td>
			</tr>
		</table>
		<br />
		<table border="1" cellpadding="15" style="border-radius:20px;border:2px solid #099999;" width="100%">
			<?php for($i=1;$i<=$Capacity;$i++): ?>
				<?php // set td color
					$color = "white"; // default is white
					if(in_array($i,$booked)) // if booked then set to red
						$color = "red";
					elseif(in_array($i,$reserved)) // if reserved then set to purple
						$color = "purple";
				?>
				<?php $is_reserved = "0"; ?>
				<!-- if % = 0 then new tr will be start -->
				<?php if($i%$column == 0): ?>
					<td bgcolor="<?php echo $color; ?>" align="center" id="<?php echo "td_".$i; ?>">
						<?php if(!in_array($i,$booked)): ?>
							<?php if(in_array($i,$reserved)): ?>
								<?php $is_reserved = "1"; ?>
							<?php endif; ?>
							<input onChange="return btnClick(this,<?php echo $is_reserved; ?>);" type="radio" value="<?php echo $i; ?>" id="<?php echo $i; ?>" name="book" />
							<?php if(in_array($i,$reserved)): ?>
								<label for="<?php echo $i; ?>"><?php echo "<font color='white'><b>".$i."</b></font>"; ?></label>
							<?php else: ?>
								<label for="<?php echo $i; ?>"><?php echo $i; ?></label>
							<?php endif; ?>
						<?php else: ?>
							<?php echo "<font color='white'><b>".$i."</b></font>"; ?>
							<a href="parking_lot_registration.php?exit=true&entity_id=<?php echo $entity_id; ?>&block=<?php echo $i; ?>"><font color="white">Exit</font></a>
						<?php endif; ?>
					</td>
					</tr>
					<tr>
				<?php else: ?>
					<td bgcolor="<?php echo $color; ?>" align="center" id="<?php echo "td_".$i; ?>">
						<?php if(!in_array($i,$booked)): ?>
							<?php if(in_array($i,$reserved)): ?>
								<?php $is_reserved = "1"; ?>
							<?php endif; ?>
							<input onChange="return btnClick(this,<?php echo $is_reserved; ?>);" type="radio" value="<?php echo $i; ?>" id="<?php echo $i; ?>" name="book" />
							<?php if(in_array($i,$reserved)): ?>
								<label for="<?php echo $i; ?>"><?php echo "<font color='white'><b>".$i."</b></font>"; ?></label>
							<?php else: ?>
								<label for="<?php echo $i; ?>"><?php echo $i; ?></label>
							<?php endif; ?>
						<?php else: ?>
							<?php echo "<font color='white'><b>".$i."</b></font>"; ?>
							<a href="parking_lot_registration.php?exit=true&entity_id=<?php echo $entity_id; ?>&block=<?php echo $i; ?>"><font color="white">Exit</font></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>
			<?php endfor; ?>
		</table>
	</div>
</body>
</html>