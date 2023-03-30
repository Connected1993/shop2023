<?php

session_start();
// подключаем файл конфигурации
require_once('../config.php');
// подключаем файл с бд
require_once('../core/db/db.php');

$id = (int)$_GET['id'];
$result = $dbh->query("SELECT *, (select GROUP_CONCAT(url) from `source` where id_products=$id) FROM `products` WHERE id_products=$id");
$result = $result->fetchAll();
echo '<pre>';
var_dump($result);
// var_dump($_GET['id']);

// echo 'СТРАНИЦА ТОВАРА';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product.css">
</head>
<body>
    <div class="wrapper">
<div class="left-column">
    <img src="" alt=""> 
    <img src="" alt=""> 
    <img src="" alt="">   
</div>
  <div class="right-column">
  <div class="product-description">Фен
    <h1>ФЕН</h1>
    <div>Наличие товара:
        <div class="color"> Товар в наличии</div>
    </div>
    <div>Артикул</div>
   <p> Описание </p> 
   </div>
<div class="product-configuration">
<div class="product-color">Цвет
<div class="color-choose">
<div>
    <input id="red" checked="checked" name="color" type="radio" value="red" data-image="red"> 
    <label for="red"></label>
</div>
<div>
    <input id="blue" name="color" type="radio" value="blue" data-image="blue"> 
    <label for="blue"></label>
</div>
<div>
    <input id="pink" name="color" type="radio" value="pink" data-image="pink">
     <label for="pink"></label>
    </div>
</div>
</div>
    <div class="product-price"> 299 руб 
        <a class="cart-btn" href="#">Добавить в корзину</a>
    </div>
</div>
</div>
</body>