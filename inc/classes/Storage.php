<?php

/**
 * Класс Storage выполняет работу с сохранением и выводом данных
 * Реализует интерфейса Data.
 * Принимает в себя int параметр: 1-работа с MySQL, 2 - работа с файлом
 * 
 */
class Storage implements Data {

    public $dsn = 'mysql:dbname=vm_forum;host=127.0.0.1';
    public $user = 'root';
    public $password = '';
    public $dataDir = "data/data.txt"; //Дериктория файла с данными
    public $error = array();
    private $type; //Тип хранения данных (1 - MySQL, 2 - FILE.txt)

    /**
     * 
     * @param int $type - тип хранения данных (1 - MySQL, 2 - FILE.txt)
     */

    public function __construct($type) {

        $this->type = $type;
    }

    public function connect() {

        if ($this->type == 1) {

            try {
                $this->dbh = new PDO($this->dsn, $this->user, $this->password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }

    /**
     * 
     * @return array $this->data Получение массива данных
     */
    public function getData() {

        if ($this->type == 1) {
            $query = 'SELECT user,email,message FROM m_messages';
            $sth = $this->dbh->prepare($query);
            $sth->execute();
            $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($this->type == 2) {
            $file = file($this->dataDir);
            foreach ($file as $value) {
                $this->data[] = json_decode($value, true);
            }
        }
        return $this->data;
    }

    /**
     * 
     * @param string $user Имя пользователя
     * @param string $email Почтовый адрес
     * @param string $message Текст сообщение
     * 
     * Заносит данные в базу 
     */
    public function putData($user, $email, $message) {

        if ($this->type == 1) {
            $sth = $this->dbh->prepare('INSERT INTO m_messages (`id` ,`user` ,`email` ,`message`) VALUES (NULL , :user, :email, :message');
            $sth->execute(array(':user' => $user, ':email' => $email, ':message' => $message));
        }
        if ($this->type == 2) {
            $info = json_encode(array("user" => $user, "email" => $email, "message" => $message)) . "\n";
            file_put_contents($this->dataDir, $info, FILE_APPEND);
        }
    }

    /**
     * Получени категорий из базы данных с сортировккой по $order
     * @param string $order Поле сортировки
     * @return array Массив данных
     */
    public function getCategories($order) {
        $query = "SELECT id,title,$order FROM f_categories ORDER BY $order DESC";
        $sth = $this->dbh->prepare($query);
        $sth->execute();
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Получение постов для 1-го пользователя
     * @param int $userID 
     * @return type Массив данных
     */
    public function getPosts($userID) {
        $query = "SELECT
					f_posts.title,
					f_posts.text,
					f_posts.dateAdd AS dateAdd,
					f_users.login,
					f_categories.title AS cat_title
					FROM
					f_users
					INNER JOIN f_posts ON f_posts.user_id = f_users.id
					INNER JOIN f_categories ON f_posts.category_id = f_categories.id
					WHERE
					f_users.id = f_posts.user_id AND
					f_posts.category_id = f_categories.id AND
					f_users.id = $userID
					ORDER BY dateAdd DESC";

        $sth = $this->dbh->prepare($query);
        $sth->execute();
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Получение сообщений из одной категории
     * @param type $categoryID
     * @return type Массив данных
     * 
     */
    public function getCategoryPosts($categoryID) {
        $query = "SELECT
					f_posts.title,
					f_posts.text,
					f_posts.dateAdd AS dateAdd,
					f_users.login,
					f_categories.title AS cat_title
					FROM
					f_users
					INNER JOIN f_posts ON f_posts.user_id = f_users.id
					INNER JOIN f_categories ON f_posts.category_id = f_categories.id
					WHERE
					f_users.id = f_posts.user_id AND
					f_posts.category_id = f_categories.id AND
					f_posts.category_id = $categoryID
					ORDER BY dateAdd DESC";

        $sth = $this->dbh->prepare($query);
        $sth->execute();
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Получает список всех зарегестрированных пользователей
     * @return type Массив данных
     */
    public function getUsers() {
        $query = 'SELECT login,dateAdd FROM f_users ORDER BY dateAdd DESC';
        $sth = $this->dbh->prepare($query);
        $sth->execute();
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Занесение нового пользователя в базу данных
     * @param array $info Массив данных о пользователе
     * @return type Ошибки при попытке занесения в БД
     */
    public function putUserInfo(array $info) {
        $sth = $this->dbh->prepare('SELECT login FROM f_users WHERE login = :login');
        $sth->execute(array(':login' => $info['login']));
        if ($sth->fetchAll(PDO::FETCH_ASSOC) != NULL) {
            $this->error['login'] = "Данный логин уже занят";
        }
        $sth = $this->dbh->prepare('SELECT email FROM f_users WHERE email = :email');
        $sth->execute(array(':email' => $info['email']));
        if ($sth->fetchAll(PDO::FETCH_ASSOC) != NULL) {
            $this->error['email'] = "Данный email уже существует";
        }
        if (!isset($this->error['email']) and !isset($this->error['login'])) {
            $sth = $this->dbh->prepare('INSERT INTO f_users (login, status_id, email,dateAdd, password, about)
		VALUES (:login, 2, :email, NOW(), :password, :about)');
            $sth->execute(array(':login' => $info['login'], ':email' => $info['email'], ':password' => md5($info['password']), ':about' => $info['about']));
        }
        return $this->error;
    }

    /**
     * Функция для Login'a пользователя
     * @param array $info Информация о пользователе
     * @return type
     */
    public function findUser(array $info) {
        $sth = $this->dbh->prepare('SELECT id,login,password FROM f_users WHERE login = :login and password = :password');
        $sth->execute(array(':login' => $info['login'], ':password' => md5($info['password'])));
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Получение информации о пользователе по его ID
     * @param type $userID
     * @return type
     */
    public function getUserAccountInfo($userID) {
        $sth = $this->dbh->prepare('SELECT id,login,email,about FROM f_users where id = :id');
        $sth->execute(array(':id' => $userID));
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * Обновление информации о пользователе
     * @param array $info Массив данных для изменения
     */
    public function updateUserInfo(array $info) {
        $sth = $this->dbh->prepare('UPDATE f_users SET login = :login, email = :email, about = :about  WHERE id = :id');
        $sth->execute(array(':id' => $info['userID'], ':login' => $info['login'], ':email' => $info['email'], ':about' => $info['about']));
    }

    /**
     * Создание категории 
     * @param array $info Массив данных с информацией о категории 
     * @param type $userID
     */
    public function putCategory(array $info, $userID) {
        $sth = $this->dbh->prepare('SELECT title FROM f_categories WHERE title = :title');
        $sth->execute(array(':title' => $info['categoryTitle']));
        if ($sth->fetchAll(PDO::FETCH_ASSOC) != NULL) {
            $this->error['title'] = "Категория уже сущетсвует";
        }

        if (!isset($this->error['title'])) {
            $sth = $this->dbh->prepare('INSERT INTO f_categories (title, messNum, user_id)
		VALUES (:title, 1, :user_id)');
            $sth->execute(array(':title' => $info['categoryTitle'], ':user_id' => $userID));
        }
    }

    /**
     * Создание 1-го сообщения
     * @param array $info Массив данных о сообщении
     * @param type $userID
     */
    public function putPost(array $info, $userID) {
        $sth = $this->dbh->prepare('SELECT id,title FROM f_categories WHERE title = :title');
        $sth->execute(array(':title' => $info['categoryTitle']));
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $this->dbh->prepare('INSERT INTO f_posts (category_id, user_id,title, dateAdd, text)
		VALUES (:cat_id, :user_id, :title, NOW(), :text)');
        $sth->execute(array(':cat_id' => $data['0']['id'], ':user_id' => $userID, ':title' => $info['postTitle'], ':text' => $info['postText']));
    }

    /**
     * Создание сообщения в уже существующей теме
     * @param array $info Массив данных о сообщении
     * @param type $userID
     * @param type $catID
     */
    public function putNewPost(array $info, $userID, $catID) {
        $sth = $this->dbh->prepare('SELECT messNum FROM f_categories WHERE id = :cat_id');
        $sth->execute(array(':cat_id' => $catID));
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $this->dbh->prepare('INSERT INTO f_posts (category_id, user_id,title, dateAdd, text)
		VALUES (:cat_id, :user_id, :title, NOW(), :text)');
        $sth->execute(array(':cat_id' => $catID, ':user_id' => $userID, ':title' => $info['postTitle'], ':text' => $info['postText']));

        $sth = $this->dbh->prepare('UPDATE f_categories SET  messNum =:newNum 
		WHERE id = :cat_id');
        $sth->execute(array(':cat_id' => $catID, ':newNum' => $data[0]['messNum'] + 1));
    }

}
