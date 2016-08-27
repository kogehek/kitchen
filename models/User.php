<?php
	class User  
	{
		private $id;
		private $name; 
		private $token;
		private $isLogged;


		function __construct()
		{
			if (isset($_COOKIE['token'])) {
				$data = getDataOne('SELECT * FROM `users` WHERE `remember_token` = "'.$_COOKIE['token'].'"');
			} else {
				$data = null;
			}

			if ($data) {
				$this->id = $data->id;
				$this->name = $data->name;
				$this->isLogged = true;
			} else {
				$this->id = 0;
				$this->name = "Guest";
				$this->isLogged = false;
			}
		}

		function getName() {
			return $this->name;
		}

		function getId() {
			return $this->id;
		}

		function isLogged() {
			return $this->isLogged;
		}
	}