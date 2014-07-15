<?php
$userAuth = new Storage(1);
$userAuth->connect();

if (isset($_POST) and $_POST != NULL) {
    $result = $userAuth->findUser($_POST);
    print_r($result);
    if ($result != NULL) {
        $_SESSION['userName'] = $result[0]['user'];
        $authMessage = "Вы Зарегистрированы!";
    } else {
        $authMessage = "Неправильный логин или пароль";
    }
}