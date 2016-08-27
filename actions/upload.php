<?

	
	require_once '../core/mysql.php';
	require_once '../models/User.php';

	$user = new User();
	
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
				`recipe`="'.mysqli_real_escape_string($_POST['content']).'",
				`name`="'.mysqli_real_escape_string($_POST['Name']).'",
				`Time`="'.mysqli_real_escape_string($_POST['Time']).'"
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


