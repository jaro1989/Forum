<?php	

$lastUsers = new Storage(1);
$lastUsers->connect();
$listUsers = $lastUsers->getUsers();

$form = new Form();







