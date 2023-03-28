<?php
try {

	$option = [
		// по умолчанию данные возвращать в виде ассоциативного массива
		PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
		// кодировка для работы с БД
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	];

	$dbh = new PDO('mysql:dbname=u1877602_shop_20230;host=31.31.196.209', 'u1877602_nordic2', '',$option);

} catch (PDOException $e) {
	die($e->getMessage());
}

