<?php

	require_once '../core/mysql.php';
	require_once '../models/User.php';
	require_once '../models/recipe.php';
	require_once '../repository/recipe_repository.php';

	$user = new User();

	$recipe = RecipeRepository::getById($_POST['id']);
	$recipe->setRecipe($_POST['content']);
	$recipe->save();

	//$mysqli->query('UPDATE `recipes` SET `recipe`="'.mysqli_real_escape_string($recipe).'" WHERE `id` ='.$id);
	echo json_encode(['url' => '/profile'.$recipe->getUserId()]);

