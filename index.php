<?php
session_start();
// подключаем файл конфигурации
require_once('config.php');
// подключаем файл с бд
require_once('core/db/db.php');

require_once(COMPONENTS.'/header.php');
require_once(COMPONENTS.'/main.php');
require_once(COMPONENTS.'/footer.php');



