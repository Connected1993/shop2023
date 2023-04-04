<?php
// echo '<pre>';
// var_dump($_SERVER);
// exit;


if ($_SERVER['HTTP_HOST'] == 'localhost')
{
    // Создаем константу название поекта
    define('PROJECT','shop2023');
    // включаем вывод ошибок для разработки
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    
    // конфигурация для локального запуска
    define('PRODUCTION',FALSE);
    define('PAGES_URL','http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT.'/pages');
    define('JS_URL','http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT.'/js');
    define('CSS_URL','http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT.'/css');
}
else
{
    // Создаем константу название поекта
    define('PROJECT',$_SERVER['HTTP_HOST']);
    // выключаем вывод ошибок для разработки
    ini_set('display_errors',0);
    ini_set('display_startup_errors',0);
    error_reporting(0);
    // конфигурация для боевого запуска
    define('PRODUCTION',TRUE);
}

// полный путь к нашему проекту
define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/shop2023');
// путь к папке со страничками
define('PAGES',ROOT.'\pages');
// компоненты
define('COMPONENTS',ROOT.'\components');
// папка с скриптами
define('JS',ROOT.'\js');

define('DB',ROOT.'\core\db');
