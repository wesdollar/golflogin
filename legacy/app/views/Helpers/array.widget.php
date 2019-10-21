<?php
function arrayToJSON($arr) {
	$result = array();

	foreach ($arr as $key => $val) {
		$result[] = $key . ": '".$val."'";
	}

	return '{' . join(', ', $result) . '}';
}

function arrayToJSONSimple($arr) {
	$result = array();

	foreach ($arr as $key => $val) {
		$result[] = $key . ": '".$val."'";
	}

	return join(', ', $result);
}