<?php
require '../script/db.php';
require '../script/SQLProtect.php';
$msg='';
$activated = "1";
if(!empty(NumberCheck($_GET['code'])) && NumberCheck($_GET['code'])!=0){
	$code=NumberCheck($_GET['code']);
	$query=mysql_query("SELECT * FROM activation WHERE code='".$code."'");
		$numrows=mysql_num_rows($query);
		if($numrows!=0){
			
			$result2 = mysql_query("SELECT *from activation WHERE code='" . $code . "'");
	$name = $row=mysql_fetch_array($result2);
			$user = $name['user'];
			$sql="UPDATE members set activated='" . $activated . "' WHERE user='" . $user . "'";
				$result=mysql_query($sql);
			if($result){
				$sql2="DELETE FROM activation WHERE user='" . $user . "'";
					$result2=mysql_query($sql2);
			if($result2){
				$msg ="Account Activated.";
				?>
<META http-equiv="refresh" content="1;URL=/login">
<?php
		}
			}
		}
else
{
$msg ="Something Failed. Please contact the Administrator.";
}

}
?>
<?php echo $msg; ?>