<?php
session_start();
// подключаем файл конфигурации
require_once('config.php');
// подключаем файл с бд
require_once('core/db/db.php');
// comment
require_once(COMPONENTS.'/header.php');
//require_once('search.php');
// comment
require_once(COMPONENTS.'/footer.php');

// формируем запрос
$sql = 'SELECT name,code FROM country';
// query() - отправляет запрос в бд
//$result = $dbh->query($sql);

// var_dump() - распечатать содерджимое обьекта,массива,строки и.т.д
// fetchAll() - Выбирает оставшиеся строки из набора результатов
// https://www.php.net/manual/ru/pdostatement.fetchall.php

//echo '<pre>';
//var_dump( $result->fetchAll(PDO::FETCH_ASSOC) );

