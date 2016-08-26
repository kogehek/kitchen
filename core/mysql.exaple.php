<?php 

	if ($_SERVER['SERVER_ADDR'] == '') {
		$host = '';
		$user = '';
		$pass = '';
		$database = '';
	} else {
		$host = '';
		$user = '';
		$pass = '';
		$database = '';
	}

	$mysqli = new mysqli($host, $user, $pass, $database);
  	$GLOBALS['mysqli'] = $mysqli;

	if ($mysqli->connect_error) {
		die('Ошибка подключения (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	function getData($sql) {
		$mysqli = $GLOBALS['mysqli'];
		$res = $mysqli->query($sql);
		$data = [];
		while($obj = $res->fetch_object()){ 
    		$data[] = $obj;
  		}
  		return $data;
	}

	function getDataOne($sql) {
		$mysqli = $GLOBALS['mysqli'];
		$res = $mysqli->query($sql);
		if ($res) {
			return $res->fetch_object();
		}
		return null;
	}

