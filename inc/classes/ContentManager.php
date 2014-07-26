<?php

/**
 * Класс ContanManager отвечает за директории и вывод информации
 */
class ContentManager {

    public $currentPage = 'main';
    public $menu = array('main', 'forum', 'registration', 'contacts', 'reg_done', 'user', 'login', 'create_category', 'forum_in');
    public $modifyDirectory;
    public $tplDirectory;

    /**
     * Получает строку и задает подключаемые файлы
     * с помощью функции getDir
     * 
     * @param string $page
     * 
     */
    public function __construct($page) {

        if (in_array($page, $this->menu)) {
            $this->currentPage = $page;
        }
        $this->getDir();
    }

    /**
     * 
     * @param array $data Массив значений из запроса к БД
     * @param string $printedData Сначение индекса из массива, которое необходимо вывести
     * @return string - HTML
     */
    public static function renderCategories(array $data, $printedData) {
        $html = "<ul class='list-group'>";

        foreach ($data as $value) {
            if ($printedData === "dateAdd") {
                $value["$printedData"] = date("Y/m/d H:i", strtotime($value["$printedData"]));
            }
            $html .= "<li class='list-group-item'>";

            $html .= "<span class='badge'>" . $value["$printedData"] . "</span><a href='index.php?page-forum_in-cat_id-" . $value['id'] . ".html '>" . $value['title'] . "</a>";

            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    /**
     * 
     * @param array $data Массив Сообщений
     * @return string - HTML
     */
    public static function renderPost(array $data) {
        $html = "";
        $posts=new Paginator($data);
        $paginHtml=$posts->getHtmlPagin($data);

        foreach ($posts->dataSlices as $value) {
            $html .="<li class='time-label'>";
            $html .="<span class='bg-light-blue'>Posted in : " . $value['cat_title'] . " : by " . $value['login'];
            $html .="</span>";
            $html .="<br />";
            $html .="<br />";
            $html .="</li>";

            $html .="<li class='time-label'>";
            $html .="<span class='bg-blue'>";
            $html .= date("Y/M/d", strtotime($value['dateAdd']));
            $html .="</span>";
            $html .="</li>";

            $html .="<li>";
            $html .="";
            $html .="<div class='timeline-item'>";
            $html .="<span class='time'>" . date("M d", strtotime($value['dateAdd'])) . "</span>";
            $html .="<h3 class='timeline-header'>" . $value['title'] . "</h3>";

            $html .="<div class='timeline-body'>";
            $html .=$value['text'];
            $html .="</div>";

            $html .="<div class='timeline-footer'>";
            $html .="<a href='index.php?page=user&user_id=".$value['userID']."' class='btn btn-default btn-xs'>by:" . $value['login'] . "</a>";

            foreach ($value[0] as $tag) {

                $html .="<a class='btn btn-warning btn-xs'>" . $tag['TagName'] . "</a>";
            }
            $html .="</div>";
            $html .="</div>";
            $html .="</li>";

        }
        $html .= $paginHtml;
        return $html;
    }
	
	 /**
     * 
     * @param array $data Массив Сообщений по тэгам
     * @return string - HTML
     */
    public static function renderTagedPost(array $data) {
        $html = "";
        foreach ($data as $value) {
            $html .="<li class='time-label'>";
            $html .="<span class='bg-light-blue'>Posted in : " . $value['cat_title'] . " : by " . $value['login'];
            $html .="</span>";
            $html .="<br />";
            $html .="<br />";
            $html .="</li>";

            $html .="<li class='time-label'>";
            $html .="<span class='bg-blue'>";
            $html .= date("Y/M/d", strtotime($value['dateAdd']));
            $html .="</span>";
            $html .="</li>";

            $html .="<li>";
            $html .="";
            $html .="<div class='timeline-item'>";
            $html .="<span class='time'>" . date("M d", strtotime($value['dateAdd'])) . "</span>";
            $html .="<h3 class='timeline-header'>" . $value['title'] . "</h3>";

            $html .="<div class='timeline-body'>";
            $html .=$value['text'];
            $html .="</div>";

            $html .="<div class='timeline-footer'>";
            $html .="<a href='index.php?page=user&user_id=".$value['userID']." 'class='btn btn-default btn-xs'>by:" . $value['login'] . "</a>";

            foreach ($value[0] as $tag) {

                $html .="<a class='btn btn-warning btn-xs'>" . $tag['TagName'] . "</a>";
            }
            $html .="</div>";
            $html .="</div>";
            $html .="</li>";
        }
        return $html;
    }

    /**
     * 
     * @param array $data Массив пользователей
     * @param type $printedData Выводимая информация
     * @return string HTML
     */
    public static function renderUsers(array $data, $printedData) {
        $html = "";
        foreach ($data as $value) {
            if ($printedData === "dateAdd") {
                $value["$printedData"] = date("Y/m/d H:i", strtotime($value["$printedData"]));
            }
            $html .= "<li>";
            $html .= $value['login'] . "&nbsp;(" . $value["$printedData"] . ")";
            $html .= "</li>";
        }
        return $html;
    }

    /**
     * 
     * @param array $errors Массив ошибок регистрации
     * @return string HTML
     */
    public static function renderRegErrors(array $errors) {
        $html = "<div class='alert alert-error'>";
        foreach ($errors as $value) {
            $html .= "<li>";
            $html .= "$value";
            $html .= "</li>";
        }
        $html .= "</br>";
        $html .= "</div>";

        return $html;
    }

    /**
     * 
     * @param string $type Вид формы
     * @return string HTML
     */
    public static function renderSucsess($type) {
        if ($type === 'category') {
            $html = "<p>Категория создана<br />";
            $html .= "<a href='index.php?page=forum'>Перейти на форум</a>";
        }
        if ($type === 'registration') {
            $html = "<p>Вы успешно прошли регистрацию<br />";
            $html .= "<a href='index.php?page=login'>Войти как пользователь</a>";
        }

        return $html;
    }

    /**
     * 
     * @param array $data Массив информации о пользователе
     * @return string HTML
     */
    public static function renderUserAccountInfo(array $data) {
        $html = "";
        foreach ($data as $value) {

            $html .= "<h3>" . $value['login'] . "</h3>";
            $html .= "<h6>Email:" . $value['email'] . "</h6>";
            $html .= "<h6>About:" . $value['about'] . "</h6>";
        }
        return $html;
    }

    /**
     * 
     * @param array $data Массив информации о пользователе
     * @return string HTML
     */
    public static function renderUserUpdateTable(array $data) {
        $html = "<h3>Данные пользователя</h3><br>";
        foreach ($data as $value) {

            $html .= "<form class='form col-md-10 center-block' action='index.php?page=user' method='post'>";
            $html .= "<div>Login</div>";
            $html .= "<div class='form-group'>";
            $html .= "<input class='form-control' value=" . $value['id'] . " name='userID' type='hidden'>";
            $html .= "<input class='form-control' value=" . $value['login'] . " name='login' type='text'>";
            $html .= "</div>";
            $html .= "<div>Email</div>";
            $html .= "<div class='form-group'>";
            $html .= "<input class='form-control' value=" . $value['email'] . "  name='email' type='email'>";
            $html .= "</div>";
            $html .= "<div>About</div>";
            $html .= "<div class='form-group'>";
            $html .= "<textarea class='form-control' name='about'>" . $value['about'] . "</textarea>";
            $html .= "</div>";
            $html .= "<div class='form-group'>";
            $html .= "<button type='submit' class='btn btn-primary btn-lg btn-block'>Применить изменения</button>";
            $html .= "</div>";
            $html .= "</form>";
        }
        return $html;
    }
    
        public static function renderUserMailTable(array $data) {
        $html = "<h3>Напишите сообщение</h3><br>";
        
        foreach ($data as $value) {
            $html .= "<form class='form col-md-10 center-block' action='index.php?page=user&user_id=$_GET[user_id]&action=mail_sent' method='post'>";
            $html .= "<div>Заголовок</div>";
            $html .= "<div class='form-group'>";
            $html .= "<input class='form-control' name='login' type='text'>";
            $html .= "<input class='form-control' value=" . $value['email'] . " name='email' type='hidden'>";
            $html .= "</div>";
            $html .= "<div>Текст сообщения</div>";
            $html .= "<div class='form-group'>";
            $html .= "<textarea class='form-control' name='message'></textarea>";
            $html .= "</div>";
            $html .= "<div class='form-group'>";
            $html .= "<button type='submit' class='btn btn-primary btn-lg btn-block'>Отослать сообщение</button>";
            $html .= "</div>";
            $html .= "</form>";
        }
        return $html;
    }
	
     /**
     * 
     * @param array $data Массив тэгов
     * @return string HTML
     */
    public static function renderTags(array $data) {
        $html = "<ul class='list-group'>";

        foreach ($data as $value) {
           
            $html .= "<li class='list-group-item'>";

            $html .= "<span class='badge'>" . $value['num_posts'] . "</span><a href='index.php?page=forum_in&tag_id=" . $value['tag_id'] . " '>" . $value['name'] . "</a>";

            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    /**
     * Функция для получения необходимых файлов исходя из значений $_GET['page']
     */
    private function getDir() {
        $this->modifyDirectory = "controller/" . $this->currentPage . "Controller.php";
        $this->tplDirectory = "view/" . $this->currentPage . ".php";
    }

}
