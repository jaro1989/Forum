<?php

class ContentManager {

    public $currentPage = 'main';
    public $menu = array('main', 'forum', 'registration', 'contacts', 'reg_done', 'user', 'login','createPost', 'forum_in');
    public $modifyDirectory;
    public $tplDirectory;

    public function __construct($page) {

        if (in_array($page, $this->menu)) {
            $this->currentPage = $page;
        }
        $this->getDir();
    }

    public static function renderCategories(array $data, $printedData) {
        $html = "<ul class='list-group'>";
        
        foreach ($data as $value) {
            if ($printedData === "dateAdd") {
                $value["$printedData"] = date("Y/m/d H:i", strtotime($value["$printedData"]));
            }
			$html .= "<li class='list-group-item'>";
			
            $html .= "<span class='badge'>" . $value["$printedData"] . "</span><a href='index.php?page=forum_in&&cat_id=".$value['id'] ." '>" . $value['title'] . "</a>";
            
			$html .= "</li>";
        }
		$html .= "</ul>";
        return $html;
		

 

    }

    public static function renderPost(array $data) {
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
            $html .="<a class='btn btn-default btn-xs'>by:" . $value['login'] . "</a>";
            $html .="</div>";
            $html .="</div>";
            $html .="</li>";
        }
        return $html;
    }

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

    public static function renderSucsess($type) {
		if($type === 'category'){
		$html = "<p>Категория создана<br />";
        $html .= "<a href='index.php?page=forum'>Перейти на форум</a>";
		}
		if($type === 'registration'){
        $html = "<p>Вы успешно прошли регистрацию<br />";
        $html .= "<a href='index.php?page=login'>Войти как пользователь</a>";
		}

        return $html;
    }

    public static function renderUserAccountInfo(array $data) {
        $html = "";
        foreach ($data as $value) {

            $html .= "<h3>" . $value['login'] . "</h3>";
            $html .= "<h6>Email:" . $value['email'] . "</h6>";
            $html .= "<h6>About:" . $value['about'] . "</h6>";
        }
        return $html;
    }

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

    public static function renderPostForm(array $data) {
        $html = "<h3>Данные пользователя</h3><br>";
        foreach ($data as $value) {

            $html .= "<form class='form col-md-10 center-block' action='index.php?page=forum&&action=create_done' method='post'>";
            $html .= "<div>Login</div>";
            $html .= "<div class='form-group'>";
            $html .= "<select name='category'>";
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

    private function getDir() {
        $this->modifyDirectory = "controller/" . $this->currentPage . "Controller.php";
        $this->tplDirectory = "view/" . $this->currentPage . ".php";
    }

}
