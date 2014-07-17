<?php
//Подключение к базе данных
$data = new Storage(1);
$data->connect();
//Обработка сообщения, введенного пользователем
if (isset($_GET['action']) and $_GET['action'] == 'done') {
    $formComplete = new Form;
    $formComplete->getNewPost($_POST);
    $data->putNewPost($formComplete->data, $_SESSION['userID'], $_GET['cat_id']);
}
//Вывод категорий
$categories = $data->getCategories('messNum');
//Вывод сообщений данной категории
if (isset($_GET['cat_id'])) {
    $posts = $data->getCategoryPosts($_GET['cat_id']);
}







