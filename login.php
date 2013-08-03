<html>
<head>
<link rel='stylesheet' href='userlogincms.css'>
</head>
<?php
session_start();
$_SESSION['flag'] = 0;
$flag = 0;
if(isset($_POST['submit']))
{$var1 =mysql_real_escape_string($_POST['sign_in_name']);  //basic protection activated
$var2 =mysql_real_escape_string($_POST['sign_in_password']);
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,'auction');
$sql = "SELECT * FROM users WHERE Name = '$var1' ;";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
if($var2 == $row['Password'])
 { if($_POST['captcha'] == $_SESSION['code'])
	{$_SESSION['flag'] = 1;
	  $_SESSION['user'] = $var1;
	  header("Location:mainpage.php");
	}
	else
	{
		$errorcaptcha = 'Incorrect captcha';
	}
 
 }
else
$errorpassword ='Incorrect Password';
}
?>
<script>
window.onload =function(){
document.getElementById('errorcaptcha').innerHTML = JSON.parse('<?php echo json_encode($errorcaptcha,JSON_HEX_TAG|JSON_HEX_APOS); ?>');
document.getElementById('errorpassword').innerHTML = JSON.parse('<?php echo json_encode($errorpassword,JSON_HEX_TAG|JSON_HEX_APOS); ?>');}
</script>
<body>
<div name="form" class="myform">
<h1>Sign in- user </h1>
<form action = "login.php" method ="post">
<fieldset>
<label>Name :</label><input type = "text" name = "sign_in_name" id = "sign_in_name"></br>
<label>Password:</label> <input type = "password" name = "sign_in_password" id = "sign_in_password"></br>
<span id ='errorpassword'></span>
<label><img src='captcha.php'></label></br>
<label> Captcha-text:</label><input type='text' name='captcha'/>
<input id="spacer" type="submit" class="button" value ="Sign in" name ='submit'>
<span id='errorcaptcha'></span>
</fieldset>
</form>
</body>
</html>