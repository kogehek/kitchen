<?php
	require_once '../core/mysql.php';
	require_once '../models/User.php';
	
	$user = new User();

	$mysqli->query('DELETE FROM `recipes` WHERE 
		`id` = '.$mysqli->real_escape_string($_POST['work_id']).' AND 
		`user_id` ='.$user->getId()
	);

	$mysqli->query('DELETE FROM `favorits` WHERE 
		`recipes_id` = '.$mysqli->real_escape_string($_POST['work_id'])
	);

	header("Location: /profile".$user->getId());