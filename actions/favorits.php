<? 

	require_once '../core/mysql.php';
	require_once '../models/User.php';

	$user = new User();

	echo 1;

	if ($_POST['click'] == 'add') {

		$mysqli->query('INSERT INTO favorits SET 
				`user_id`="'.mysqli_real_escape_string($user->getId()).'",
				`user_id_recipe`="'.mysqli_real_escape_string($_POST['user_id_recipe']).'",
				`recipes_id`="'.mysqli_real_escape_string($_POST['id']).'"');
		
	}

	if ($_POST['click'] == 'delete') {
		$mysqli->query('DELETE FROM favorits WHERE 
				`user_id`="'.mysqli_real_escape_string($user->getId()).'" AND
				`recipes_id`="'.mysqli_real_escape_string($_POST['id']).'"');
	}



	
