<?php

	$recipes = RecipeRepository::getProfile($profile);

	$body = "views/view_profile.php";
	require "views/view_global.php";
