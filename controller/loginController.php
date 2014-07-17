<?php
$userAuth = new Storage(1);
$userAuth->connect();

if (isset($_POST) and $_POST != NULL) {
    $result = $userAuth->findUser($_POST);
    if ($result != NULL) {
        $_SESSION['userName'] = $result[0]['login'];
        $_SESSION['userID'] = $result[0]['id'];
		echo $_SESSION['userID'];
        $authMessage = "Вы Зарегистрированы!";
    } else {
        $authMessage = "Неправильный логин или пароль";
    }
}