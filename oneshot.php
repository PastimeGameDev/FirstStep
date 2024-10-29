<?php
if(isset($_REQUEST['submit']))
{
	$data = '';
	$filename = "oneshot.json";
	if(is_file($filename))
	{
		$data = file_get_contents($filename);
	}
	$json_arr = json_decode($data, true);
	$checkUpdate = false;
	//Remove file status
	foreach($json_arr as $key => $value) 
	{
		if($value['hp'] == '0') 
		{
			file_put_contents($filename, json_encode([]));
			$data = file_get_contents($filename);
			$json_arr = json_decode($data, true);
			//header("Location: StoreJson.php");
			//return;
		}
	}
	//Update file status
	foreach ($json_arr as $key => $entry) 
	{
		if ($json_arr[$key]['name'] == $_REQUEST['name']) 
		{
			$json_arr[$key]['name'] = $_REQUEST['name'];
			$json_arr[$key]['hp'] = $_REQUEST['hp'];
			$json_arr[$key]['posX'] = $_REQUEST['posX'];
			$json_arr[$key]['posY'] = $_REQUEST['posY'];
			$json_arr[$key]['posZ'] = $_REQUEST['posZ'];
			$json_arr[$key]['rotX'] = $_REQUEST['rotX'];
			$json_arr[$key]['rotY'] = $_REQUEST['rotY'];
			$json_arr[$key]['rotZ'] = $_REQUEST['rotZ'];
			$checkUpdate = true;
			$newJsonString = json_encode($json_arr);
			file_put_contents($filename, $newJsonString);
			//header("Location: StoreJson.php");
			return;
		}
	}
	//Input new file
	if($checkUpdate == false)
	{
		$json_arr[] = array('name' => $_REQUEST['name'], 'hp' => $_REQUEST['hp'], 'posX' => $_REQUEST['posX'], 
		'posY' => $_REQUEST['posY'], 'posZ' => $_REQUEST['posZ'],'rotX' => $_REQUEST['rotX'], 
		'rotY' => $_REQUEST['rotY'], 'rotZ' => $_REQUEST['rotZ']);
		file_put_contents($filename, json_encode($json_arr));
	}
	else
	{
		$checkUpdate = false;
	}
	//header("Location: StoreJson.php", 1f);
	//header("Location: Test.json", 0.1f);
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>myOrder</title>
<Content-Type: application/json src="oneshot.json">

<form name="Test" action="oneshot.php" method="PUT">

Name:<br><input type="Text" name="name" placeholder="Name.."><br>
HP:  <br><input type="Text" name="hp" placeholder="hp.."><br>
PosX :<br><input type="Text" name="posX" placeholder="Pos.."><br>
PosY :<br><input type="Text" name="posY" placeholder="Pos.."><br>
PosZ :<br><input type="Text" name="posZ" placeholder="Pos.."><br>
RotX :<br><input type="Text" name="rotX" placeholder="Rot.."><br>
rotY :<br><input type="Text" name="rotY" placeholder="Rot.."><br>
rotZ :<br><input type="Text" name="rotZ" placeholder="Rot.."><br>
<input type="Submit" name="submit" value="Sign In"><br>

</form>
<form name="Test" action="oneshot.php" method="PUT">

</form>
<form name="Test" action="oneshot.php" method="GET">

</form>

</body>
</html>

//$json_arr[] = array('name0' => $_REQUEST['name0'], 'age0' => $_REQUEST['age0'], 'car0' => $_REQUEST['car0']);
//meta charset="utf-8" http-equiv="refresh" content="1;url=StoreJson.php"

//RewriteRule ^oneshot/([0-9]+)/?$ oneshot.php?name=ABS&hp=&posX=&posY=&posZ=&rotX=&rotY=&rotZ=&submit=Sign+In [NC,L]