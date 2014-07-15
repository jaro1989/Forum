<?php

/**
 * Интерфейс работы с данными
 */
interface Data {

    public function putData($user, $email, $message);

    public function getData();
}
