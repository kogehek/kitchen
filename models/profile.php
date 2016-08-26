<?php

	class Profile  
	{
		private $id;
		private $name; 

		function __construct($name, $id = 0)
		{
			$this->id = $id;
			$this->name = $name;
		}

		function getName() {
			return $this->name;
		}

		function getId() {
			return $this->id;
		}
	}