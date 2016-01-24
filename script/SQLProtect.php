<?PHP
//AntiSQL-Inject V1.0
//Based on Alexandro G. Correa Anti SQL Injection System
//Modified by ZenJB
function SecurityCheck($UserInput){
	if (preg_match("/[^A-Za-z0-9@.]/", $UserInput)){
		return "fd87yr6t3rwhuifsdho8yu3r";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
function LinkCheck($UserInput){
	if (preg_match("/[^A-Za-z0-9@./:]/", $UserInput)){
		return "http://example.com";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
function NumberCheck($UserInput){
	if (preg_match("/[^0-9]/", $UserInput)){
		return "0";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
function LetterCheck($UserInput){
	if (preg_match("/[^A-Za-z]/", $UserInput)){
		return "aaa";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
function PasswordCheck($UserInput){
	if (preg_match("/[^A-Za-z0-9.]/", $UserInput)){
		return "password";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
function BitcoinAddressCheck($UserInput){
	if (preg_match("/[^A-Za-z0-9]/", $UserInput)){
		return "password";
	} else {
	$UserInput = $UserInput;
 $UserInput = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$UserInput);
 $UserInput = trim($UserInput);
 $UserInput = strip_tags($UserInput);
 $UserInput = (get_magic_quotes_gpc()) ? $UserInput : addslashes($UserInput);
 return $UserInput;
	}
}
?>