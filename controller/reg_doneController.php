<?php
//Создаем объект для работы с базой данныъ
$postInfo = new Storage(1);
$postInfo->connect();
//Создаем объект для обработки данныъ регистрации
$formComplete = new Form();
//Обрабатываем данные, введенные пользователем
$formComplete->getUserInfo($_POST);
//Занесение данных в БД
$postInfo->putUserInfo($formComplete->data);
//Обработка ошибок 
if ($formComplete->validateAll() and !isset($postInfo->error['login']) and !isset($postInfo->error['email'])) {

    $sucsess = TRUE;
} else {
    if (isset($formComplete->errors) and isset($postInfo->error)) {
        array_unshift($formComplete->errors, "Логин или пароль уже существуют");

        $errorsInfo = $formComplete->errors;
    } else {
        $errorsInfo = $postInfo->error;
    }
}


