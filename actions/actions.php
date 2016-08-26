<?php 


	if ($_POST['action'] == 'logout'){
		setcookie ("token", null, -1, '/');
		header("Location: /");
	}
	else {
		header("Location: /registration");
	}
	
