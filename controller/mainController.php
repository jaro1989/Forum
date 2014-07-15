<?php
//Подключение к базе данных
$data = new Storage(1);
$data->dsn = 'mysql:dbname=forum;host=127.0.0.1';
$data->connect();
$categories = $data->getCategories('messNum');
$lastCategories = $data->getCategories('dateAdd');
(isset($_SESSION['User'])) ? $posts = $data->getPosts($_SESSION['User']) : $posts = $data->getPosts('admin');








