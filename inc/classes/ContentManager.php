<?php

class ContentManager {

    public $currentPage = 'main';
    public $menu = array('main', 'forum', 'registration', 'contacts', 'reg_done', 'user', 'login');
    public $modifyDirectory;
    public $tplDirectory;

    public function __construct($page) {

        if (in_array($page, $this->menu)) {
            $this->currentPage = $page;
        }
        $this->getDir();
    }

    public static function renderCategories(array $data, $printedData) {
        $html = "";
        foreach ($data as $value) {
            if ($printedData === "dateAdd") {
                $value["$printedData"] = date("Y/m/d H:i", strtotime($value["$printedData"]));
            }
            $html .= "<li>";
            $html .= "<a href=''>" . $value['name'] . "&nbsp;(" . $value["$printedData"] . ")</a>";
            $html .= "</li>";
        }
        return $html;
    }

    public static function renderPost(array $data) {
        $html = "";
        foreach ($data as $value) {
            $html .="<li class='time-label'>";
            $html .="<span class='bg-light-blue'>Posted in : $value[category] : by $value[user]";
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
            $html .="<h3 class='timeline-header'>$value[title]</h3>";

            $html .="<div class='timeline-body'>";
            $html .="$value[text]";
            $html .="</div>";

            $html .="<div class='timeline-footer'>";
            $html .="<a class='btn btn-default btn-xs'>by: $value[user]</a>";
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
            $html .= "<a href=''>" . $value['user'] . "&nbsp;(" . $value["$printedData"] . ")</a>";
            $html .= "</li>";
        }
        return $html;
    }

    public static function renderRegErrors(array $errors) {
        $html = "";
        foreach ($errors as $value) {
            $html .= "<li>";
            $html .= "$value";
            $html .= "</li>";
        }
        $html .= "</br>";
        $html .= "<a href='index.php?page=registration'>Вернуться на поле регистрации</a>";
        return $html;
    }

    public static function renderSucsess() {

        $html = "<p>Вы успешно прогли регистрацию<br />";
        $html .= "<a href='index.php?page=user'>Доступ к личному кабинету</a>";

        return $html;
    }

    private function getDir() {
        $this->modifyDirectory = "controller/" . $this->currentPage . "Controller.php";
        $this->tplDirectory = "view/" . $this->currentPage . ".php";
    }

}
