<?php

//Подключение к базе данных
$data = new Storage(1);
$data->connect();
$categories = $data->getCategories('messNum');
(isset($_SESSION['userName'])) ? $posts = $data->getPosts($_SESSION['userID']) : $posts = $data->getPosts('7');








