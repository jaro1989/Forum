<?php
// СОздаем объект для генерации капчи
$captcha = new Form;
// Если информация принята
if($_POST != NULL){
        //Создаем объект для обработки данных
	$formComplete = new Form;
	$formComplete->getCategoryInfo($_POST);
	if($formComplete->errors['captcha'] == NULL){
	$post = new Storage(1);
	$post->connect();
	//Заносим данные в БД либо выводим ошибки
	$post->putCategory($formComplete->data, $_SESSION['userID']);
		if(!isset($post->error['title'])){	
			$sucsess = TRUE;
			$post->putPost($formComplete->data,$_SESSION['userID']);
			print_r($post->data);
		}
		else{
			$errorsInfo = $post->error;
		}
	}
	else{
	
	 $errorsInfo = $formComplete->errors;
	
	}
}








