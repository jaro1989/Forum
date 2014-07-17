<?php
//Создаем объект для работы с базой данных
$userAccountInfo = new Storage(1);
$userAccountInfo->connect();
//Обновляем данные дл пользователя
if (isset($_POST) and $_POST != NULL) {
    $userAccountInfo->updateUserInfo($_POST);
}
//Получение информации о пользователе
$userInfo = $userAccountInfo->getUserAccountInfo($_SESSION['userID']);




