<?php
	session_start();
	session_destroy();
	setcookie(PHPSESSID, session_id(), time() - 1);
	header("Location: index.html");
?>