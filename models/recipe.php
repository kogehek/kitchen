<?
	class Recipe
	{

		private $id;
		private $user_id; 
		private $recipe;
		private $name;
		private $time;
		private $created_at;

		function __construct($user_id, $recipe, $name, $time, $id = 0, $created_at = 0) {
			$this->user_id 		= $user_id;
			$this->recipe 		= $recipe;
			$this->name 		= $name;
			$this->time 		= $time;
			$this->id 			= $id;
			$this->created_at 	= $created_at;
		}

		function save() {
			if ($this->id) {
				$GLOBALS['mysqli']->query('UPDATE recipes SET 
					`user_id`="'.$this->user_id.'",
					`recipe`="'.$mysqli->real_escape_string($this->recipe).'",
					`name`="'.$mysqli->real_escape_string($this->name).'",
					`time`="'.$mysqli->real_escape_string($this->time).'" 
					WHERE id = '.$this->id.'
				');
			} else {
				$GLOBALS['mysqli']->query('INSERT INTO recipes SET 
					`user_id`="'.$this->user_id.'",
					`recipe`="'.$mysqli->real_escape_string($this->recipe).'",
					`name`="'.$mysqli->real_escape_string($this->name).'",
					`time`="'.$mysqli->real_escape_string($this->time).'"
				');
				$this->id = $GLOBALS['mysqli']->insert_id;
			}
		}

		function getId() {
			return $this->id;
		}

		function getUserId() {
			return $this->user_id;
		}

		function setUserId($userId) {
			$this->user_id = $userId; 
		}

		function getRecipe() {
			return $this->recipe;
		}

		function setRecipe($recipe) {
			$this->recipe = $recipe; 
		}

		function getName() {
			return $this->name;
		}

		function setName($name) {
			$this->name = $name; 
		}

		function getTime() {
			return $this->time;
		}

		function setTime($time) {
			$this->time = $time; 
		}

		function getCreatedAt() {
			return $this->created_at;
		}

		function isLiked($userId) {
			$data = getDataOne('SELECT COUNT(1) AS count FROM favorits WHERE user_id = '.$userId.' AND recipes_id = '.$this->id);
			if ($data->count) {
				return true;
			} else {
				return false;
			}
		}
		function getCountFavorits() {
			$data = getDataOne('SELECT COUNT(1) AS count FROM favorits WHERE recipes_id = '.$this->id);
			return $data->count;
		}

	}
