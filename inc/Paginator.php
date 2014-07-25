<?php

/**
 * Class Paginator
 * в конструктор передаем массив с постами
 * количество постов на страницу 5
 */
class Paginator {

    private $numPosts;
    private $posts=array();

    public function __construct($posts=array()){
        $this->numPosts=5;
        foreach($posts as $key=>$value){
            $this->posts[$key]=$value;
        }
    }

    /**
     * Выполняет срез массива с постами и генерирует строку с HTML пагинатора
     * @param array $dataSlice ссылка на массив для среза постов
     * @return string строка с HTML пагинатора
     */
    public function getHtmlPagin(&$dataSlice=array()){
        $size=count($this->posts);
        $numPage=$size/$this->numPosts;
        $numPage=((int)$numPage==$numPage)?$numPage:(int)$numPage+1;
        $curPageNum = isset($_GET['pagePosts']) ? (int)$_GET['pagePosts']: 1;
        $html = "<div clas='divPaginator'>page:";
        $html .="<ul class='paginator'>";
        for($i = 1; $i <= $numPage; $i++){
            if($i == $curPageNum){
                $html .= "<li >$i</li>";
            } else {
                $html .= "<li><a href='?pagePosts=$i'>$i</a></li>";
            }
        }
        $html .= "</ul></div>";
        $startIndex = ($numPage-1)*$this->numPosts;
        $dataSlice=array_slice($this->posts, $startIndex, $startIndex+$this->numPosts);
        return $html;
    }
}