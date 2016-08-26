<?
	class RecipeRepository
	{
		static public function getById($id) {
			$data = getDataOne('SELECT * FROM `recipes` WHERE `id` = '.$id);
			if ($data) {
				return new Recipe($data->user_id, $data->recipe, $data->name, $data->time, $data->id, $data->created_at);
			}
			return null;
		}

		static public function getByIdEdit($id,$user_id) {
			$data = getDataOne('SELECT * FROM `recipes` WHERE `id` = "'.$id.'" AND `user_id` = '.$user_id);
			if ($data) {
				return new Recipe($data->user_id, $data->recipe, $data->name, $data->time, $data->id, $data->created_at);
			}
			return null;
		}

		static public function getAll() {
			$allData = getData('SELECT * FROM `recipes`');
			if ($allData) {
				$recipes = [];
				foreach ($allData as $data) {
					$recipes[] = new Recipe($data->user_id, $data->recipe, $data->name, $data->time, $data->id, $data->created_at);
				}
				return $recipes;
			}
			return [];
		}

		static public function getFavorits($id) {
			$allData = getData('SELECT recipes.* FROM recipes
				LEFT JOIN favorits ON recipes.id = favorits.recipes_id
				WHERE favorits.user_id = '.$id);
			if ($allData) {
				$recipes = [];
				foreach ($allData as $data) {
					$recipes[] = new Recipe($data->user_id, $data->recipe, $data->name, $data->time, $data->id, $data->created_at);
				}
				return $recipes;
			}
			return [];
		}

		static public function getProfile($id) {
			$allData = getData('SELECT * FROM `recipes` WHERE `user_id` = '.$id);
			if ($allData) {
				$recipes = [];
				foreach ($allData as $data) {
					$recipes[] = new Recipe($data->user_id, $data->recipe, $data->name, $data->time, $data->id, $data->created_at);
				}
				return $recipes;
			}
			return [];
		}
	}
