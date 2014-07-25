<?php

//Подключение к базе данных
$data = new Storage(1);
$data->connect();
//Получение списка категорий
$categories = $data->getCategories('messNum');
//Список тэгов
$tags = $data->getTags();
//Получение списка последних сообщений
(isset($_SESSION['userName'])) ? $posts = $data->getPosts($_SESSION['userID']) : $posts = $data->getPosts('7');








