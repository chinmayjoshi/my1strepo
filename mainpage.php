<html>
<head>
</head>
<body>
<?php
session_start();
echo $_SESSION['user'];//THIS IS FOR TESTING
echo '<br>';
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,'auction');
$sql = "SELECT * FROM objects";
$result = mysqli_query($con,$sql);
 while($row = mysqli_fetch_array($result))
  { $names[] =$row['Name'];
	$images[] =$row['Image'];
    $times[]=$row['Expiry'];
  }
for($i=0; $i<count($names);$i++)
{ $timestamp =  $times[$i];
	$time = date('F j, Y, g:i a',$timestamp);
echo "Name of object: $names[$i] <br>
	  Expires on : $time;<br>
	  <img src='images/$images[$i].jpg' height=150 width=150><br>
	  <a>Place your bid:</a></br>
	  The bid:(in Indian rupees)
	  <form action='getbid.php' method='post'>
	  <input name='bid' type='number'>
	  </form>
	  
";

}
?>
</body>
</html>