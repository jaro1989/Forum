<?php

session_start();
error_reporting(E_ALL);
//Выход пользователя
if (isset($_GET['page']) and $_GET['page'] == 'logout') {
    unset($_SESSION['userName']);
    unset($_SESSION['userID']);
}
//Подключение интерфейса
include ("inc/classes/Data.php");
//Подключение классов
include ("inc/classes/Form.php");
include ("inc/classes/Storage.php");
include ("inc/classes/ContentManager.php");
include ("inc/classes/Paginator.php");

//Загрузка и обрработка шаблона
(isset($_GET['page'])) ? $fileManager = new ContentManager($_GET['page']) : $fileManager = new ContentManager('main');
include ($fileManager->modifyDirectory);

include ("view/layout/header.php");

include ($fileManager->tplDirectory);

include ("view/layout/footer.php");

