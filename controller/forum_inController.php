<?php
//Подключение к базе данных
$data = new Storage(1);
$data->connect();
if (isset($_GET['action']) and $_GET['action'] == 'done') {
    $formComplete = new Form;
    $formComplete->getNewPost($_POST);
    $data->putNewPost($formComplete->data, $_SESSION['userID'], $_GET['cat_id']);
}
$categories = $data->getCategories('messNum');
if (isset($_GET['cat_id'])) {
    $posts = $data->getCategoryPosts($_GET['cat_id']);
}







