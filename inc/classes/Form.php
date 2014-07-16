<?php

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

    public function getUserInfo(array $dataArray) {
        $this->user = htmlspecialchars(trim($dataArray['login']));
        $this->email = htmlspecialchars(trim($dataArray['email']));
        $this->password = htmlspecialchars(trim($dataArray['password']));
        $this->captcha = htmlspecialchars(trim($dataArray['captcha']));
    }

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
        if (!preg_match("~^(\w{3,})+$~i", $this->user)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function validateEmail() {
        if (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $this->email)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

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
        if (strlen($this->password) < 6 or strlen($this->password) > 50) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
