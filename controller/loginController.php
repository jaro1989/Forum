<?php
//Создаем объект для работы с базой данных
$userAuth = new Storage(1);
$userAuth->connect();
//Обработка пользовательских данныъ
if (isset($_POST) and $_POST != NULL) {
    //Поиск пользователя с таким же логином или паролем
    $result = $userAuth->findUser($_POST);
    if ($result != NULL) {
        //Занесение значений в сессию при удачном исходе
        $_SESSION['userName'] = $result[0]['login'];
        $_SESSION['userID'] = $result[0]['id'];
        echo $_SESSION['userID'];
        $authMessage = "Вы Зарегистрированы!";
    } else {
        $authMessage = "Неправильный логи или пароль";
    }
}