<?php 
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['text']))
		echo 'Yarr';
	if(array_key_exists('nev', $_GET) && !empty($_GET['nev'])){
		echo 'nev: '.$_GET['nev'], '<br>', 'jelszo: '.$_GET['jelszo'];
	}
 ?>
 <h3>GET</h3>
<form method="get">
	<input type="text" name="nev">
	<input type="password" name="jelszo">
	<input type="submit" name="test">
</form>
<br>
<?php
	function testInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(array_key_exists('p', $_GET) && !empty($_GET['p'])){ 
		switch ($_GET['p']) {
			case 'home':
					echo "home";
				break;
			case 'login':
					echo 'login';
				break;
			default:
					echo '404';
				break;
		}
	}else{
		echo 'HOME';
	}
 ?>
 <br>
 <a href="?p=home">Home</a><br>
 <a href="?p=login">Login</a><br>

 <h3>POST</h3>
	<form method="post">
		<input type="text" name="nev">
		<input type="password" name="jelszo">
		<input type="submit">
	</form>
	<?php 

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$error = "";
			if(!array_key_exists('nev', $_POST) || empty($_POST['nev']))
				$error .= "A név mező kötelező! <br>";
			if(!array_key_exists('jelszo', $_POST) || empty($_POST['jelszo']))
				$error .= "A jelszó mező kötelező! <br>";
			if($error = ""){
				$nev = $jelszo = "";
				$nev = testInput($_POST['nev']);
				$jelszo = testInput($_POST['jelszo']);
				echo $nev,'-',$jelszo;
			}else{
				echo $error;
			}
		}
	 ?>
<br>
<h3>ADATKEZELÉS</h3>
<table border='1'>
	<tr>
		<th>1</th>
		<th>2</th>
		<th>3</th>
	</tr>
	<tr>
		<th>Elso</th>
		<th>Masodik</th>
		<th>Harmadik</th>
	</tr>
</table>

<form method="POST">
	<input type="text" name="data1">
	<input type="email" name="data2">
	<input type="password" name="data3">
	<input type="submit" name="insert">
</form>
<?php 
	$error= "";
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['insert'])){
			if(!array_key_exists('data1', $_POST) || empty($_POST['data1'])){
				$error .= "A data1 mező kötelező! <br>";
			}
			if(!array_key_exists('data2', $_POST) || empty($_POST['data2'])){
				$error .= "A data2 mező kötelező! <br>";
			}else if(!filter_var($_POST['data2'], FILTER_VALIDATE_EMAIL)){
				$error = "A Data 2 nem megfelelő formátumú <br>";
			}
			if(!array_key_exists('data3', $_POST) || empty($_POST['data3'])){
				$error .= "A data3 mező kötelező! <br>";
			}
			if($error == ""){
				$query = "INSERT INTO testdata(data1,data2,data3) VALUES (:data1,:data2,:data3)";
				$params = [
					':data1' => $_POST['data1'],
					':data2' => $_POST['data2'],
					':data3' => $_POST['data3']
				];
			}else echo $error;

			require_once DATABASE_CONTROLLER;
			if(executeDML($query, $params)){
				echo 'Siker!';
			}else echo "Hibás bevitel!";
		}
 ?>