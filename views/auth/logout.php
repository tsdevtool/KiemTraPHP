<?php
require_once "models/Auth.php";

$auth = new Auth(null);
$auth->logout();
?>
