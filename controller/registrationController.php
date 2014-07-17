<?php
//Создаем объект для работы с базой данных
$lastUsers = new Storage(1);
$lastUsers->connect();
//Получаем список пользователей
$listUsers = $lastUsers->getUsers();
//Создаем объект для генерации капчи
$captcha = new Form;








