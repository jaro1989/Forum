<?php
/**
 * Функция генерирующая GET для url
 * @param array $url ассоциативный массив с гет параметром и его значением
 * @return string строка с гет параметрами
 */
function getUrl($url=array()){
    $urlMask="";
    foreach($url as $key=>$value ){
        $urlMask.=$key."=".$value."&";
    }
    $urlMask=substr($urlMask,0,strlen($urlMask)-1);
    return $urlMask="?".$urlMask;
}