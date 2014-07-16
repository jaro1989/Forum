<?php
$postInfo = new Storage(1);
$postInfo->connect();
$formComplete = new Form();
$formComplete->getUserInfo($_POST);
$postInfo->putUserInfo($_POST);
print_r($postInfo->error);
if($formComplete->validateAll() and !isset($postInfo->error['login']) and !isset($postInfo->error['email'])){
		
	$sucsess = TRUE;
}
else{
	(isset($formComplete->errors) and isset($postInfo->error)) ?
	 $errorsInfo = array_unshift($formComplete->errors,$postInfo->error):
	 $errorsInfo = $postInfo->error;
	
}


