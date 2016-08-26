<?
	class ProfileRepository
	{
		static public function getById($id) {
			$data = getDataOne('SELECT * FROM `users` WHERE `id` = '.$id);
			if ($data) {
				return new Profile($data->id, $data->name);
			}
			return null;
		}
	}