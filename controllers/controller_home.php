<?php

	$recipes = RecipeRepository::getAll();

	$body = "/views/view_home.php";
	require "/views/view_global.php";