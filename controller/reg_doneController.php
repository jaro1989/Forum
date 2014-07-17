<?php
$postInfo = new Storage(1);
$postInfo->connect();
$formComplete = new Form();
$formComplete->getUserInfo($_POST);
$postInfo->putUserInfo($formComplete->data);

if($formComplete->validateAll() and !isset($postInfo->error['login']) and !isset($postInfo->error['email'])){
		
	$sucsess = TRUE;
}
else{
	if(isset($formComplete->errors) and isset($postInfo->error)){
	 array_unshift($formComplete->errors, "Логин или пароль уже существуют");
	 
	 $errorsInfo = $formComplete->errors;
	}
	else{
	 $errorsInfo = $postInfo->error;
	}
	
}


