<?php
$db=mysql_connect('localhost','root','') or die("Impossible to connect to db"); 
	mysql_select_db('txzone') or die("Database not Found"); //Conect to Database
	$websitename = "MyWebsite"; //Website Name
	$websiteURL = "http://mywebsite.whatever"; //Website URL
	$PasswordEncryptText1 = "MyPass1"; //Warning: You can only change this if there are no users in database. If there are they will be unable to acess their account!
	$PasswordEncryptText2 = "MyPass2"; //Warning: You can only change this if there are no users in database. If there are they will be unable to acess their account!
	$PasswordEncryptText3 = "MyPass3"; //Warning: You can only change this if there are no users in database. If there are they will be unable to acess their account!
	$adsprice = "490000"; //Price of each add in Satoshi
	$dailyviewsforeachuser = "14"; //Number of allowed ads to be seen by user before you reset tasks in the database
	$withdradenymessage = "Whithdraws are disabled"; //This is a custom message that displays when withdraws are disabled
	$depositdenymessage = "Deposits are disabled";  //This is a custom message that displays when deposits are disabled
	$ownerdebugemail = "example@example.com"; //With this you will receive an email for each buy that users do
		$ID1 = "";   //YOUR BLOCKCHAIN.INFO USER ID to Receive Payments ("Deposit Wallet")
		$PW1 = ""; //User ID password
		
		$ID2 = "";   //YOUR BLOCKCHAIN.INFO USER ID to Send Payments ("Withdraw Wallet")
		$PW2 = ""; //User ID password
?>