<?php
session_start();
require '../script/db.php';
require '../script/SQLProtect.php';
if(!isset($_SESSION["sess_user"])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<div id="login">
		<h1>Admin Panel</h1>
		<form action="" method="POST">
			<center>
				<input type="text" name="user" placeholder="Username">
				<p></p>
				<input type="password" name="pass" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;&#149;">
				<p></p>
				<input type="submit" value="Login" name="submit" id="Button" />
			</center>
		</form>
	<div>
</body>
</html>
<?php
if(isset($_POST["submit"])){
	
	$user=SecurityCheck($_POST['user']);
	$password=SecurityCheck($_POST['pass']);
	$query=mysql_query("SELECT * FROM members WHERE user='".$user."'");
	$numrows=mysql_num_rows($query);
	
	if($user == "fd87yr6t3rwhuifsdho8yu3r" || $password == "fd87yr6t3rwhuifsdho8yu3r"){
		
		$SQLinjectDetection = 1;
		
	} else {
		
		$SQLinjectDetection = 0;
		
	}
	
	if($SQLinjectDetection == 0){
		
			$adminconnect = mysql_query("SELECT * FROM administrators WHERE admin='".$user."'");
			$admincheck = mysql_num_rows($adminconnect);
			
		if($admincheck!=0){
			
			$admin = 1;
			$process = 1;
			
		} else {
			
				$admin = 0;
				$process = 0;
			
		}
		
	if($numrows!=0 && $process==1){
	
		$name = $row = mysql_fetch_array($query);
		$ramdom = $name['nitid'];
		$md5pass = md5(md5(md5($password . $PasswordEncryptText1 . $ramdom) . $PasswordEncryptText2) . $PasswordEncryptText3);
		$removeme = $password + $ramdom;
	
		if(!empty($user) && !empty($password)){
		
			$query = mysql_query("SELECT * FROM members WHERE user='".$user."' AND pass='".$md5pass."' AND nitid='".$ramdom."'");
			$numrows = mysql_num_rows($query);
			
		
			if($numrows!=0 && $admin!=0){
			
			
				while($row = mysql_fetch_assoc($query)){
				
					$dbusername=$row['user'];
					$dbpassword=$row['pass'];
					$active=$row['activated'];
					
				
				}
			
				if($user == $dbusername && $md5pass == $dbpassword && $active==1){
					
					if($admin == 1){
			
					echo '<script language="javascript">';
					echo 'alert("Welcome admin '. $dbusername .'")';
					echo '</script>';
					
					session_start();
					$_SESSION['sess_user'] = $user;
			
					} else {
						
							echo '<script language="javascript">';
							echo 'alert("Username or password wrong")';
							echo '</script>';
				
					}

?>
				<META http-equiv="refresh" content="1;URL=/admin">
<?php

				} else {
				
					echo '<script language="javascript">';
					echo 'alert("ERROR: Account not active")';
					echo '</script>';
			
				}
			
			} else {
			
				echo '<script language="javascript">';
				echo 'alert("Username or password wrong")';
				echo '</script>';
			
			}
	
		} else {
		
			echo '<script language="javascript">';
			echo 'alert("There are blank spaces")';
			echo '</script>';
			
		}
	
	} else {
	
		echo '<script language="javascript">';
		echo 'alert("Username or password wrong")';
		echo '</script>';
	
	}

	} else {
	
		echo '<script language="javascript">';
		echo 'alert("Username or password wrong")';
		echo '</script>';
	
	}

}
?>
<?php
} else {
?>
<?PHP
	$adminconnect = mysql_query("SELECT * FROM administrators WHERE admin='".$_SESSION["sess_user"]."'");
	$admincheck = mysql_num_rows($adminconnect);
if($admincheck!=0){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<div id="sidebar">

		<ul>
			<center><h1><?php echo $websitename;?></h1>
			<h2>Admin Panel</h2>
			</center>
			<li><center><a>Users</a></center></li>
			<li><a href="#">Withdraw history</a></li>
			<li><a href="#">Completed Tasks</a></li>
			<li><a href="#">Ban</a></li>
			<li><a href="#">Android App</a></li>
			<li><a href="#">Statistics</a></li>
			<li><center><a>Server</a></center></li>
			<li><a href="/admin">Status</a></li>
			<li><a href="#">Withdraw</a></li>
			<li><a href="#">Deposit</a></li>
			<li><a href="#">Finance Log</a></li>
			<li><a href="#">Administrators</a></li>
			<li><center><a>Settings</a></center></li>
			<li><a href="#">Api Acess</a></li>
			<li><a href="#">My Account</a></li>
			<li><a href="#">About</a></li>
			<li><a href="/logout">Logout</a></li>
		</ul>
		
	</div>
	
	<div id="content">
	 
	<center><h2>Logged in as <?php echo $_SESSION["sess_user"];?></h2></center>
	<h1>Withdraw Status:</h1>
	<form action="" method="POST">
	<h2>
	<?PHP
			$withdraw = mysql_query("SELECT * FROM webcontrol WHERE name='payment'");
			$withdrawstat = mysql_fetch_assoc($withdraw);
			if($withdrawstat['value'] == 1){
				
				echo "Enabled ";
				echo '<input type="submit" value="Disable" name="withdraw0" id="Button" />';
				
			} else {
				
				echo "Disabled ";
				echo '<input type="submit" value="Enable" name="withdraw1" id="Button" />';
				
			}
	?>
	</h2>
	<h1>Deposit Status:</h1>
	<h2>
	<?PHP
				$deposit = mysql_query("SELECT * FROM webcontrol WHERE name='deposit'");
			$depositstat = mysql_fetch_assoc($deposit);
			if($depositstat['value'] == 1){
				
				echo "Enabled ";
				echo '<input type="submit" value="Disable" name="deposit0" id="Button" />';
				
			} else {
				
				echo "Disabled ";
				echo '<input type="submit" value="Enable" name="deposit1" id="Button" />';
				
			}
	?>
	</h2>
	<h1>Withdraw Account Balance:</h1>
	<h2>
	<?PHP
		$withdrawbalance = mysql_query("SELECT * FROM webcontrol WHERE name='withdrawabalance'");
		$withdrawbal = mysql_fetch_assoc($withdrawbalance);
		echo $withdrawbal['value']." satoshi";
		echo '<input type="submit" value="Sync with BlockChain" name="withdrawupdate" id="Button" />';
	?>
	</h2>
	<h1>Deposit Account Balance:</h1>
	<h2>
	<?PHP
		$withdrawbalance = mysql_query("SELECT * FROM webcontrol WHERE name='depositbalance'");
		$withdrawbal = mysql_fetch_assoc($withdrawbalance);
		echo $withdrawbal['value']." satoshi";
		echo '<input type="submit" value="Sync with BlockChain" name="depositupdate" id="Button" />';
	?>
	</h2>
	<h1>Api Status:</h1>
	<h2>
	<?PHP
				$deposit = mysql_query("SELECT * FROM webcontrol WHERE name='api'");
			$depositstat = mysql_fetch_assoc($deposit);
			if($depositstat['value'] == 1){
				
				echo '<input type="submit" value="Disable" name="api0" id="Button" />';
				
			} else {
				
				echo '<input type="submit" value="Enable" name="api1" id="Button" />';
				
			}
	?>
	</h2>
	</form>
	</div>
	</div>
</body>
</html>
<?php
if(isset($_POST["api1"])){
					echo '<script language="javascript">';
					echo 'alert("Api Comming Soon")';
					echo '</script>';
}
if(isset($_POST["api0"])){
					echo '<script language="javascript">';
					echo 'alert("Api Comming Soon")';
					echo '</script>';
}
if(isset($_POST["withdrawupdate"])){
		$withdrawbal = json_decode(file_get_contents("https://blockchain.info/merchant/".$ID2."/balance?password=".$PW2), true);
		$result=mysql_query("UPDATE webcontrol set value='".$withdrawbal["balance"]."' WHERE name='withdrawabalance'");
		if($result){
				
					echo '<script language="javascript">';
					echo 'alert("Withdraw Balance Syncronized")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
if(isset($_POST["depositupdate"])){
		$depositbal = json_decode(file_get_contents("https://blockchain.info/merchant/".$ID1."/balance?password=".$PW1), true);
		$result2=mysql_query("UPDATE webcontrol set value='".$depositbal["balance"]."' WHERE name='depositbalance'");
		if($result2){
				
					echo '<script language="javascript">';
					echo 'alert("Dposit Balance Syncronized")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
if(isset($_POST["deposit0"])){
	$result=mysql_query("UPDATE webcontrol set value='0' WHERE name='deposit'");
		if($result){
		
					echo '<script language="javascript">';
					echo 'alert("Deposit Disabled")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
if(isset($_POST["deposit1"])){
	$result=mysql_query("UPDATE webcontrol set value='1' WHERE name='deposit'");
		if($result){
		
					echo '<script language="javascript">';
					echo 'alert("Deposit Enabled")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
if(isset($_POST["withdraw0"])){
	$result=mysql_query("UPDATE webcontrol set value='0' WHERE name='payment'");
		if($result){
		
					echo '<script language="javascript">';
					echo 'alert("Withdraws Disabled")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
if(isset($_POST["withdraw1"])){
	$result=mysql_query("UPDATE webcontrol set value='1' WHERE name='payment'");
		if($result){
		
					echo '<script language="javascript">';
					echo 'alert("Withdraws Enabled")';
					echo '</script>';
					
		?>
		<META http-equiv="refresh" content="1;URL=/admin">
		<?php
		
		}
}
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>ZenPanel</title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<link rel="stylesheet" type="text/css" href="design.css">
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
}
?>