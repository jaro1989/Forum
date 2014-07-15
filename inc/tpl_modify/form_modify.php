<?php	
use PFBC\Form;
use PFBC\Element;
use PFBC\Validation;
if(isset($_POST["form"])) {
	Form::isValid($_POST["form"]);
	$newMessage = new Storage(1);
	$newMessage->dsn = 'mysql:dbname=forum;host=127.0.0.1';
	$newMessage->connect();
    $newMessage->putData($_POST['User'], $_POST['Email'], $_POST['Message']);
	header("Location: " . $_SERVER["PHP_SELF"]);
	exit();	
}
	
$form = new Form("validation", array("action"=>"index1.php"));
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element\Hidden("form", "validation"));
$form->addElement(new Element\Textbox("Login:", "Login", array(
	"required" => 1,
	"longDesc" => "Введите ваш логин(Обязательное поле)"
)));
$form->addElement(new Element\Email("Email:", "Email", array(
	"required" => 1,
	"longDesc" => "Ваш адрес E-mail(Обязательное поле)"
)));
$form->addElement(new Element\Password("Пароль:", "Password", array(
	"validation" => new Validation\AlphaNumeric,
	"longDesc" => "Введите ваш пароль"
)));
$form->addElement(new Element\Password("Повторить пароль:", "Password", array(
	"validation" => new Validation\AlphaNumeric,
	"longDesc" => "Поврторите пароль"
)));

$form->addElement(new Element\jQueryUIDate("Дата рождения", "BirthDay", array(
	"longDesc" => "Дата рождения"
)));
$form->addElement(new Element\Textarea("О себе:", "AboutUser", array(
	"cols" => "60",
	"validation" => new Validation\AlphaNumeric,
	"longDesc" => "Здесь вы можете рассказать о себе"
)));
$form->addElement(new Element\Captcha("Введите число с картинки:"));

$form->addElement(new Element\Button);




