<?php

    // получили время изменения файла в timestamp формате
    $version = filemtime(JS.'\search.js');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="js/search.js?v=<?=$version?>"></script>

    <!-- <script defer src="js/products.js"></script> -->
    <script defer src="js/basket.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/product.css">

</head>
<body>
    <header>
        <a href="?page=admin">Админ панель</a>
        <a href="?page=logout">Выход</a>

        <img src="source/logo.svg" alt="logotip">
        <div class="menu">

            <input id="search" type="text" placeholder="поиск">
            <div class="search__result"></div>

            <a href="#" target="_blank">Мужчинам</a>
            <a href="#" target="_blank">Женщинам</a>
            <a href="#" target="_blank">Детям</a>
            <a href="#" target="_blank">Контакты</a>

            <div class="menu__basket">
                <a href="?page=basket">
                    <i class="fa fa-2x fa-shopping-cart"></i>
                </a>
                <div class="menu__circle">0</div>
            </div>
        </div>
    </header>