<?php
//Создаем объект для работы с базой данных
$userAccountInfo = new Storage(1);
$userAccountInfo->connect();
//Обновляем данные дл пользователя
if (isset($_POST) and $_POST != NULL) {
    if(isset($_GET['user_id'])){
    $userAccountInfo->sendMail($_POST);    
    }else{
    $userAccountInfo->updateUserInfo($_POST);
    }
}
//Получение информации о пользователе
if(isset($_GET['user_id'])){
$userInfo = $userAccountInfo->getUserAccountInfo($_GET['user_id']);
}
else{
  $userInfo = $userAccountInfo->getUserAccountInfo($_SESSION['userID']);
}




