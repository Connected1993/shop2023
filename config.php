<?php
// Создаем константу
define('PROJECT','shop2023');
// путь к нашему проекту
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
// полный путь к нашему проекту
define('ROOT_PATH',ROOT.'\\'.PROJECT);
// путь к папке со страничками
define('PAGES',ROOT_PATH.'\pages');
// компоненты
define('COMPONENTS',ROOT_PATH.'\components');
// папка с скриптами
define('JS',ROOT_PATH.'\js');
