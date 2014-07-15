<?php

ini_set('pcre.backtrack_limit', 1024 * 1024);

include ("inc/tpl_modify/form_modify/validated_form.php");

// подключаем файл с шаблонизатором
require_once 'tpl/template_master.php'; 

// путь к шаблону
$tpl = 'tpl/tpl.php'; 

// запуск шаблонизатора
$html = websun_parse_template_path($DATA, $tpl); 

echo $html;





