<?	

	require_once '../core/mysql.php';

	$email = $_POST['email'];
	$name = $_POST['name'];
	$password = $_POST['password'];



	$registOk = true;
	$report = [];

	if (strlen($name) < 5) {
		
		//echo "Имя минимум 6 символов";
		$report1 = ["name"  => "Имя минимум 6 символов"];
		$report = $report1;
		$registOk = false;

	}

	$nameChek = getDataOne('SELECT `name` FROM `users` WHERE `name` = '.$_POST['name']);
	if ($nameChek !== NULL) {
		//echo "Имя зането";
		$report1 = ["name"  => "Имя зането"];
		$report = $report + $report1;
		$registOk = false;
	}		

	if (strlen($password) < 5) {
		//echo "Пароль минимум 6 символов";
		$report1 = ["password"  => "Пароль минимум 6 символов"];
		$report = $report + $report1;
		$registOk = false;

	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		//echo "Email не корректен";
		$report1 = ["email"  => "Email не корректен"];
		$report = $report + $report1;
		$registOk = false;

	}
	
	$chekEmail = getDataOne('SELECT `email` FROM `users` WHERE `email` = "'.$_POST['email'].'"');

	if ($chekEmail !== NULL) {
		//echo "Имя зането";
		$report1 = ["email"  => "Email занет"];
		$report = $report + $report1;
		$registOk = false;
	}	


	

	if ($registOk == true) {

		$token = hash('sha256', $name);
		

		setcookie ("token", $token, 60 * 60 * 24 * 60 + time(), '/', NULL, 0 );  

		
		if (isset($token)) {
			$report1 = ["newUser"  => "ok"];
			$report = $report + $report1;
			$mysqli->query('INSERT INTO users SET 
			`name`="'.mysql_escape_string($name).'", 
			`email`="'.mysql_escape_string($email).'", 
			`password`="'.mysql_escape_string($password).'",
			`remember_token`="'.mysql_escape_string($token).'"');
		}


	
		
	}

	echo json_encode($report);
	
	// if ($report) {
	// 	header("Location: /");
	// }

	



