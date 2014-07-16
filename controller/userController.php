<?php
$userAccountInfo = new Storage(1);
$userAccountInfo->connect();
if (isset($_POST) and $_POST != NULL) {
    $userAccountInfo->updateUserInfo($_POST);
}

$userInfo = $userAccountInfo->getUserAccountInfo($_SESSION['userID']);




