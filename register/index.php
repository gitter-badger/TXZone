<?php
require '../script/db.php';
require '../script/SQLProtect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename;?></title>
	<link rel="icon" type="image/gif" href="/favicon.gif" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/script/style.css">

</head>
<body>
<div id="topbar">
		<ul>
		<center>
			<li><a href="/">Back</a></li>
		</center>
		</ul>
	</div>
<div id="slideshow">
   <div id="container" style="color:#ccc;background-image: url(/image/1.jpg);background-size:100%;">
	 <center><h1>Register</h1>
	 <form action="" method="POST">
<input type="text" name="user" placeholder="Username">
<input type="text" name="email" placeholder="example@example.com">
<input type="text" name="btcadd" placeholder="BTC Address">
<input type="password" name="pass" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;&#149;";
<p></p>
<input type="submit" value="Register" name="submit" id="Button"/>
</form></center>
   </div>
</div>
</body>
</html>
<?php
if(isset($_POST["submit"])){
	
	$activated="0";
	$BTC="0";
	$user=SecurityCheck($_POST['user']);
	$email=SecurityCheck($_POST['email']);
	$pass=PasswordCheck($_POST['pass']);
	$btcadd = BitcoinAddressCheck($_POST['btcadd']);
		
	if (preg_match("/[^A-Za-z0-9@.]/", $pass)){
	
		echo '<script language="javascript">';
		echo 'alert("Only Letters or Numbers are allowed")';
		echo '</script>';
	
	} else {
		
	if(!empty(SecurityCheck($_POST['user']) && SecurityCheck($_POST['pass']) && SecurityCheck($_POST['email']) && SecurityCheck($_POST['btcadd'])) && filter_var(SecurityCheck($_POST['email']), FILTER_VALIDATE_EMAIL)){
		
		
		
		if($user == "fd87yr6t3rwhuifsdho8yu3r" || $email == "fd87yr6t3rwhuifsdho8yu3r" || $pass == "fd87yr6t3rwhuifsdho8yu3r" || $btcadd == "fd87yr6t3rwhuifsdho8yu3r"){
		
			$SQLinjectDetection = 1;
		
		} else {
		
			$SQLinjectDetection = 0;
		
		}
		
		if($SQLinjectDetection == 0){
		
			$nitid = rand();
			$md5pass=md5(md5(md5($pass . $PasswordEncryptText1 . $nitid) . $PasswordEncryptText2) . $PasswordEncryptText3);
			$activationid = rand();
			$query=mysql_query("SELECT * FROM members WHERE user='".$user."'");
			$numrows=mysql_num_rows($query);
			$query2=mysql_query("SELECT * FROM members WHERE email='".$email."'");
			$numrows2=mysql_num_rows($query2);
			$query3=mysql_query("SELECT * FROM members WHERE nitid='".$nitid."'");
			$numrows3=mysql_num_rows($query3);
		
			if($numrows==0&&$numrows2==0){
			
					if($numrows3==0){
					
						$sql2="INSERT INTO activation(user,code) VALUES('$user','$activationid')";
						$sql="INSERT INTO members(user,email,pass,activated,BTC,nitid,btcadd) VALUES('$user','$email','$md5pass','$activated','$BTC','$nitid','$btcadd')";
						$result=mysql_query($sql);
						$result2=mysql_query($sql2);
					
						if($result && $result2){
						
							$from = $websitename;
							$headers .= 'From: ' . $from . "\r\n";
						
							if(mail($email,$websitename." - Registration","Welcome to ".$websitename." user: ".$user.".\n The activation link is:\n ".$websiteURL."/activation/?code=".$activationid,$headers)){
			
								echo '<script language="javascript">';
								echo 'alert("Account Created. Please verify your email")';
								echo '</script>';
		
							} else {
							
								echo '<script language="javascript">';
								echo 'alert("Something Failed")';
								echo '</script>';
							
							}
						
						}
					
					}else{
					
						echo '<script language="javascript">';
						echo 'alert("ERROR")';
						echo '</script>';	
					
					}
				
			} else {
			
				echo '<script language="javascript">';
				echo 'alert("Username or Email already exists")';
				echo '</script>';
			
			}
			
		} else {
			
			echo '<script language="javascript">';
			echo 'alert("No Special characters are allowed")';
			echo '</script>';
			
		}
		
	}else{
		
		echo '<script language="javascript">';
		echo 'alert("There are Blank Spaces or maybe the email is not a valid one")';
		echo '</script>';
		
	}
		
	}
}
?>