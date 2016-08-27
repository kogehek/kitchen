<?php
	require_once '../core/mysql.php';
	require_once '../models/User.php';
	
	$user = new User();

	$mysqli->query('DELETE FROM `recipes` WHERE 
		`id` = '.mysql_real_escape_string($_POST['work_id']).' AND 
		`user_id` ='.$user->getId()
	);

	$mysqli->query('DELETE FROM `favorits` WHERE 
		`recipes_id` = '.mysql_real_escape_string($_POST['work_id'])
	);

	header("Location: /profile".$user->getId());