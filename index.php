<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'core/mysql.php';
require_once 'core/global.php';
require_once 'models/User.php';
require_once 'models/recipe.php';
require_once 'models/profile.php';
require_once 'repository/recipe_repository.php';
require_once 'repository/profile_repository.php';


$user = new User();

	$pattern = "/work(.*)/iu";
	preg_match($pattern, $url, $workId);
	if ($workId) {
		$workId = $workId[1];
		$recipe = RecipeRepository::getById($workId);
		if ($recipe) {
			require_once 'controllers/controller_work.php';
			exit;
		}
	}

	$pattern = "/recipeedit(.*)/iu";
	preg_match($pattern, $url, $recipeedit);
	if ($recipeedit) {
		$recipeedit = $recipeedit[1];
		$recipe = RecipeRepository::getByIdEdit($recipeedit,$user->getId());
		if ($recipe) {
			require_once 'controllers/controller_recipe_edit.php';
			exit;
		}
	}

	$pattern = "/profile(.*)/iu";
	preg_match($pattern, $url, $profile);
	if ($profile) {
		$profile = $profile[1];
		$recipes = ProfileRepository::getById($profile);
		if ($recipes) {
			require_once 'controllers/controller_profile.php';
			exit;
		}
	}

switch ($url) {
	case '/':
		require_once 'controllers/controller_home.php';
		exit;
	case '/registration':
		require_once 'controllers/controller_registration.php';
		exit;
	case '/action':
		require_once 'controllers/controller_actions.php';
		exit;
	case '/about':
		require_once 'controllers/controller_about.php';
		exit;
	case '/favorits':
		require_once 'controllers/controller_favorits.php';
		exit;
	case '/recipes':
		require_once 'controllers/controller_recipes.php';
		exit;
	default:
		require_once 'controllers/controller_404.php';
		exit;
}
 



