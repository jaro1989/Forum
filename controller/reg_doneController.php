<?php
$postInfo = new Storage(1);
$postInfo->connect();
$formComplete = new Form();
$formComplete->getUserInfo($_POST);
if($formComplete->validateAll()){
	$postInfo->putUserInfo($_POST);
	$sucsess = TRUE;
}
else{
	$errorsInfo = $formComplete->errors;
}


