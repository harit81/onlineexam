<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="POST">
  <input type="checkbox"  name="vehicle1" value="1">
  <label for="vehicle1">Accept</label><br>
  <input type="submit" value="Submit" name="submit_button">
</form>
</body>
</html>
<?php
if(isset($_POST['submit_button'])){
	if(isset($_POST['vehicle1']))
		{
			$check="1";
		} 
		else
		{
			$check="0";
		}
		echo $check;
}
?>