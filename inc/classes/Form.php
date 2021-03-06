<?php

/**
 * Класс Form отвечает за валидацию и обработку пользовательского ввода
 */
Class Form {

    private $info = "";
    private $user = "";
    private $email = "";
    protected $dataDir = "data/data.txt";
    protected $captcha = "";
    protected $password = "";
    public $data;
    public $picture;
    public $errors;
    protected $answer;

    /**
     * 
     * @param array $dataArray Массив данных регистрации
     */
    public function getUserInfo(array $dataArray) {
        $this->data['login'] = htmlspecialchars(trim($dataArray['login']));
        $this->data['email'] = htmlspecialchars(trim($dataArray['email']));
        $this->data['password'] = htmlspecialchars(trim($dataArray['password']));
        $this->data['about'] = htmlspecialchars(trim($dataArray['about']));
        $this->captcha = htmlspecialchars(trim($dataArray['captcha']));
    }

    /**
     * 
     * @param array $dataArray Массив данныъ создания формы
     * @return type
     */
    public function getCategoryInfo(array $dataArray) {
        $this->data['categoryTitle'] = htmlspecialchars(trim($dataArray['category_title']));
        $this->data['postTitle'] = htmlspecialchars(trim($dataArray['post_title']));
        $this->data['postText'] = htmlspecialchars(trim($dataArray['post_text']));
        $this->data['tags'] = htmlspecialchars(trim($dataArray['tags']));
        $this->generateTags($this->data['tags']);

        $this->captcha = htmlspecialchars(trim($dataArray['captcha']));
        if (!$this->validateCaptcha()) {
            return $this->errors['captcha'] = "Неверная капча";
        };
    }

    /**
     * 
     * @param array $dataArray Массив данных создания нового сообщения
     */
    public function getNewPost(array $dataArray) {

        $this->data['postTitle'] = htmlspecialchars(trim($dataArray['post_title']));
        $this->data['postText'] = htmlspecialchars(trim($dataArray['post_text']));
		$this->data['tags'] = htmlspecialchars(trim($dataArray['tags']));
		$this->generateTags($this->data['tags']);
    }

    /**
     * Валидация формы регистрации
     * @return boolean Результат
     */
    public function validateAll() {
        if (self::validateLogin() and
                self::validateEmail() and
                self::validatePassword() and
                self::validateCaptcha()) {
            return TRUE;
        } else {
            if (!self::validateLogin()) {
                $errors['login'] = "Введите правильное имя";
            }
            if (!self::validateEmail()) {
                $errors['email'] = "Введите корректный email";
            } if (!self::validatePassword()) {
                $errors['password'] = "пароль должен быть более 5 симоволов";
            } if (!self::validateCaptcha()) {
                self::generateCaptcha();
                $errors['captcha'] = "Неверная капча";
            }
            $this->errors = $errors;
            return FALSE;
        }
    }

    private function getNewInfo() {
        if ($this->info != "") {
            $ajaxContent = file("../../" . $this->dataDir);
            $i = count($ajaxContent);
            $this->ajaxInfo = '{"status":1, "message":' . $ajaxContent[$i - 1] . '}';
        }
    }

    public function getData() {
        $data = file($this->dataDir);
        foreach ($data as $value) {
            $this->data[] = json_decode($value, true);
        }
    }

    protected function validateLogin() {
        if (!preg_match("~^(\w{3,})+$~i", $this->data['login'])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function validateEmail() {
        if (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $this->data['email'])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Генерация капчи
     * @return string Капча
     */
    public function generateCaptcha() {
        $a = rand(1, 9);
        $b = rand(1, 9);

        $this->picture = "$a + $b =";
        $this->answer = $a + $b;
        $_SESSION['answer'] = $this->answer;
        return $this->picture;
    }

    public function validateCaptcha() {
        if ($this->captcha != $_SESSION['answer']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function validatePassword() {
        if (strlen($this->data['password']) < 6 or strlen($this->data['password']) > 50) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function generateTags($tags) {
        $validatedTag = array();
        $tags = explode(",", $tags);
        foreach ($tags as $tag) {
            if (strlen($tag) < 15) {
                $validatedTag[] = htmlspecialchars(trim($tag));
            }
            $this->data['tags'] = $validatedTag;
        }
    }

}
