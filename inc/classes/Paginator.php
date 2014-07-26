<?php

/**
 * Class Paginator
 * в конструктор передаем массив с постами
 * количество постов на страницу 5
 */
class Paginator {

    private $numPosts;
    public $posts=array();
    public $dataSlices = array();
            
    public function __construct($posts=array()){
        $this->numPosts=5;
        foreach($posts as $key=>$value){
            $this->posts[$key]=$value;
        }
    }

    /**
     * Выполняет срез массива с постами и генерирует строку с HTML пагинатора
     * @param array $data ссылка на массив для среза постов
     * @return string строка с HTML пагинатора
     */
    public function getHtmlPagin(array $data){
       
        $numPage = (int) count($this->posts) / $this->numPosts + 1;
        
        $curPageNum = isset($_GET['pagePosts']) ? (int)$_GET['pagePosts']: 1;
        $html = "<div clas='divPaginator'>";
        $html .="<ul class='pagination'>";
        for($i = 1; $i < $numPage; $i++){
            if(count($this->posts) > $this->numPosts){
                if($i == $curPageNum){
                    $html .= "<li ><a href='#' class='disabled'>$i</a></li>";
                } else {
                    if(isset($_GET['cat_id'])){
                        $html .= "<li><a href='?page=forum_in&cat_id=$_GET[cat_id]&pagePosts=$i'>$i</a></li>";
                    }
                    else{
                        $html .= "<li><a href='?page=main&pagePosts=$i'>$i</a></li>";
                    }
                }
            }
        }
        $html .= "</ul></div>";
        $startIndex = ($curPageNum-1)*$this->numPosts;
        $this->dataSlices=array_slice($data, $startIndex, $this->numPosts);
        return $html;
    }
}