<?php
function readFromDb($val) {
	return htmlspecialchars(stripslashes($val));
}