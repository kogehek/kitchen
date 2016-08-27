<?php
	
	if (!$user->isLogged()) {
		header("Location: /registration");
		exit;
	}

	$recipes = RecipeRepository::getFavorits($user->getId());

	$body = "views/view_favorits.php";
	require "views/view_global.php";