<?
	if ($_POST['action'] == 'delete_work') {
		$mysqli->query('DELETE FROM `recipes` WHERE 
			`id` = '.$mysqli->real_escape_string($_POST['work_id']).' AND 
			`user_id` ='.$user->getId()
		);

		$mysqli->query('DELETE FROM `favorits` WHERE 
			`recipes_id` = '.$mysqli->real_escape_string($_POST['work_id'])
		);

		header("Location: /profile".$user->getId());
		exit;
	}

	if ($_POST['action'] == 'favorit') {

		echo 1;
		if ($_POST['click'] == 'add') {
			$mysqli->query('INSERT INTO favorits SET 
					`user_id`="'.$mysqli->real_escape_string($user->getId()).'",
					`user_id_recipe`="'.$mysqli->real_escape_string($_POST['user_id_recipe']).'",
					`recipes_id`="'.$mysqli->real_escape_string($_POST['id']).'"');
			
		}

		if ($_POST['click'] == 'delete') {
			$mysqli->query('DELETE FROM favorits WHERE 
					`user_id`="'.$mysqli->real_escape_string($user->getId()).'" AND
					`recipes_id`="'.$mysqli->real_escape_string($_POST['id']).'"');
		}
		exit;
	}

	if ($_POST['action'] == 'logout') {
		setcookie ("token", null, -1, '/');
		header("Location: /");
		exit;
	}

	if ($_POST['action'] == 'edit_work') {
		$recipe = RecipeRepository::getById($_POST['id']);
		$recipe->setRecipe($_POST['content']);
		$recipe->save();

		//$mysqli->query('UPDATE `recipes` SET `recipe`="'.$mysqli->real_escape_string($recipe).'" WHERE `id` ='.$id);
		echo json_encode(['url' => '/profile'.$recipe->getUserId()]);
		exit;
	}

	if ($_POST['action'] == 'upload_work') {
		$allowed =  array('gif','png' ,'jpg');
			$filename = $_FILES['filename']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if(in_array($ext,$allowed) ) {

				if($_FILES["filename"]["size"] > 1024*3*1024)
				{
					echo ("Размер файла превышает три мегабайта");
					exit;
				}
					// Проверяем загружен ли файл
					if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
				{
					// Если файл загружен успешно, перемещаем его
					// из временной директории в конечную
					//move_uploaded_file($_FILES["filename"]["tmp_name"], "../img/".$_FILES["filename"]["name"]);

					$mysqli->query('INSERT INTO recipes SET 
						`user_id`="'.$user->getId().'",
						`recipe`="'.$mysqli->real_escape_string($_POST['content']).'",
						`name`="'.$mysqli->real_escape_string($_POST['Name']).'",
						`Time`="'.$mysqli->real_escape_string($_POST['Time']).'"
					');

					$inFile = $_FILES["filename"]["tmp_name"];
					$outFile = $_SERVER['DOCUMENT_ROOT']."/img/cardwork/".$mysqli->insert_id.".jpg";
					$image = new Imagick($inFile);
					$image->cropThumbnailImage(400, 400);
					$image->writeImage($outFile);




					header("Location: /profile".$user->getId());

				} else {
					echo("Ошибка загрузки файла");
				}
			}

			else {
				echo "format";
		}
	}

	if ($_POST['action'] == 'img') {
		$dir = 'img/work_img/';
		 
		$_FILES['file']['type'] = strtolower($_FILES['file']['type']);
		 
		if ($_FILES['file']['type'] == 'image/png'
		|| $_FILES['file']['type'] == 'image/jpg'
		|| $_FILES['file']['type'] == 'image/gif'
		|| $_FILES['file']['type'] == 'image/jpeg'
		|| $_FILES['file']['type'] == 'image/pjpeg')
		{
		    // setting file's mysterious name
		    $filename = md5(date('YmdHis')).'.jpg';
		    $file = $dir.$filename;
		 
		    // copying
		    move_uploaded_file($_FILES['file']['tmp_name'], $file);
		 
		    // displaying file
		    $array = array(
		        'filelink' => 'img/work_img/'.$filename
		    );
		    echo stripslashes(json_encode($array));
		}
	}

	if ($_POST['action'] == 'registration') {
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

			$report1 = ["name"  => "Имя занято"];
			$report = $report + $report1;
			$registOk = false;
		}		

		if (strlen($password) < 5) {

			$report1 = ["password"  => "Пароль минимум 6 символов"];
			$report = $report + $report1;
			$registOk = false;

		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$report1 = ["email"  => "Email не корректен"];
			$report = $report + $report1;
			$registOk = false;

		}
		
		$chekEmail = getDataOne('SELECT `email` FROM `users` WHERE `email` = "'.$_POST['email'].'"');

		if ($chekEmail !== NULL) {

			$report1 = ["email"  => "Email занят"];
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
				`name`="'.$mysqli->real_escape_string($name).'", 
				`email`="'.$mysqli->real_escape_string($email).'", 
				`password`="'.$mysqli->real_escape_string($password).'",
				`remember_token`="'.$mysqli->real_escape_string($token).'"');
			}	
		}
		echo json_encode($report);
	}

	if ($_POST['action'] == 'enter') {
			$name = $_POST['name'];
			$password = $_POST['password'];
			$registOk = true;

			$nameChek = getDataOne('SELECT `remember_token` FROM `users` WHERE `name` = "'.$_POST['name'].'" 
				AND `password` = "'.$_POST['password'].'"');

			if (!isset($nameChek)) {
				$report = ["password"  => "Имя или пароль неправильные"];
				$registOk = false;
				echo json_encode($report);
				exit();
			}
			else {
				setcookie ("token", $nameChek->remember_token, 60 * 60 * 24 * 60 + time(), '/', NULL, 0 );
				$report = ["enter"  => "ok"];
				echo json_encode($report);
			}

	}
