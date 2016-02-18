<?PHP
session_start();
require '../../script/db.php';
require '../../script/SQLProtect.php';
if(isset($_SESSION["sess_user"])){
	$adminconnect = mysql_query("SELECT * FROM administrators WHERE admin='".$_SESSION["sess_user"]."'");
	$admincheck = mysql_num_rows($adminconnect);
	if($admincheck!=0){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="/admin/design.css">
</head>
<body>
	<div id="sidebar">

		<ul>
			<center><h1><?php echo $websitename;?></h1>
			<h2>Admin Panel</h2>
			</center>
			<li><center><a>Users</a></center></li>
			<li><a href="#" id="title">Withdraw history</a></li>
			<li><a href="#" id="title">Completed Tasks</a></li>
			<li><a href="#" id="title">Ban</a></li>
			<li><a href="#" id="title">Mobile App</a></li>
			<li><a href="#" id="title">Statistics</a></li>
			<li><center><a>Server</a></center></li>
			<li><a href="/admin" id="title">Status</a></li>
			<li><a href="#" id="title">Withdraw</a></li>
			<li><a href="#" id="title">Deposit</a></li>
			<li><a href="#" id="title">Finance Log</a></li>
			<li><a href="/admin/server/adminlist.php" id="title">Administrators</a></li>
			<li><center><a>Settings</a></center></li>
			<li><a href="#" id="title">Api Acess</a></li>
			<li><a href="#" id="title">My Account</a></li>
			<li><a href="#" id="title">About</a></li>
			<li><a href="/logout" id="title">Logout</a></li>
		</ul>
		
	</div>
	
	<div id="content">
	 <center>
	 <form action="" method="POST">
	 <h1>Admin List</h1>
	 <h3>
	<?php
	$result = mysql_query("SELECT admin FROM administrators");
	$storeArray = Array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo $row['admin'];
		echo '</br>';
	}
	?>
	</br>
	</h3>
	<h2>Add/Delete Administrator</h2>
	<input type="text" name="user" placeholder="Username">
	<p></p>
	<center><input type="submit" value="Add Admin" name="Add" id="Button" /><input type="submit" value="Remove Admin" name="Remove" id="Button" /></center>
	</form>
	</div>
</body>
</html>
<?php
if(isset($_POST["Add"])){
	$user = SecurityCheck($_POST['user']);
	$comunicate=mysql_query("SELECT * FROM administrators WHERE admin='".$user."'");
	$check=mysql_num_rows($comunicate);
	if($check == 0) {
		$AdminCheck = 0;
	} else {
		$AdminCheck = 1;
	}
	$query=mysql_query("SELECT * FROM members WHERE user='".$user."'");
	$numrows=mysql_num_rows($query);
	if($numrows != 0 && $AdminCheck == 0){
		$day = date('Y-m-d');
		$sql="INSERT INTO administrators(admin,joindate) VALUES('$user','$day')";
		$result=mysql_query($sql);
		if($result){
			
			echo '<script language="javascript">';
			echo 'alert("'.$user.' was added has Administrator successfully")';
			echo '</script>';
?>
				<META http-equiv="refresh" content="1;URL=/admin/server/adminlist.php">
<?php
		}
	} else {
		echo '<script language="javascript">';
		echo 'alert("Error: User was not found or maybe is already an admin")';
		echo '</script>';
	}
	
} else {
	if(isset($_POST["Remove"])){
		$user = SecurityCheck($_POST['user']);
		$comunicate=mysql_query("SELECT * FROM administrators WHERE admin='".$user."'");
		$check=mysql_num_rows($comunicate);
		if($check == 0) {
			$AdminCheck = 0;
		} else {
			$AdminCheck = 1;
		}
		$query=mysql_query("SELECT * FROM members WHERE user='".$user."'");
		$numrows=mysql_num_rows($query);
		if($numrows != 0 && $AdminCheck == 1){
			$sql="DELETE FROM administrators WHERE admin='".$user."'";
			$result=mysql_query($sql);
			if($result){
			
				echo '<script language="javascript">';
				echo 'alert("'.$user.' was removed and he/she is not more an Administrator")';
				echo '</script>';
?>
				<META http-equiv="refresh" content="1;URL=/admin/server/adminlist.php">
<?php
			}
		} else {
			echo '<script language="javascript">';
			echo 'alert("Error: User was not found or maybe the user is not an admin")';
			echo '</script>';
		}
	}

}
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>ZenPanel</title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="/admin/design.css">
</head>
<body>
	<div id="login">
		<h1>Acess Not Allowed</h1>

	<div>
</body>
</html>
<?php
}
?>
<?php
} else {
?>
<META http-equiv="refresh" content="1;URL=/admin">
<?php
}
?>