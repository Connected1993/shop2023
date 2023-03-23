<?php
// запуск сессии
// запуск функции всегда должен быть в самом начале скрипта
session_start();

// получили роль пользователя
$role = $_SESSION['USER']['role'];

if ($role != 9 ) {
    header('Location: /shop2023',true,301);
    exit;
}

// echo '<pre>';
// print_r(scandir(session_save_path()));

// $active_sessions = scandir(session_save_path());
// $filter_session = [];

// foreach($active_sessions as $key => $value)
// {
//     if ( substr($value,0,4) == 'sess' )
//     {
//         $filter_session[]= $value; 
//     }
// }

   
    // СOOKIE - до 4 кб, хранится на пк пользователя, время жизни настраиваем вручную, не безопасно
    //setcookie('login','Admin',time()+3600,'/');

    // SESSION - размер зависит от настроек которые установил админ на сервере, хранится на сервере, время жизни настраивается на стороне сервера

    // $options = [
    //     'name'=>'server',
    //     'cookie_lifetime'=>60,
    //     'gc_maxlifetime'=>30,
    //     //'gc_divisor'=>1
    // ];
    
    // $_SESSION['profile'] = [
    //     'user'=>'Admin',
    //     'balance'=>200000
    // ];
    

?>
<link rel="stylesheet" href="css/panel.css">
<script defer src="js/panel.js"></script>


<h3>Добро пожаловать,мой повелитель <?=$_SESSION['USER']['login']?>!</h3>
<a href="handler.php?logout=true">Выход</a>

<form id="product" action="handler.php" method="POST" urldecode="x-www-form-urlencoded">
    <input type="text" name="name" placeholder="имя товара">
    <input type="text" name="article" placeholder="артикул">
    <input type="text" name="description" placeholder="описание">
    <input type="number" name="price" placeholder="цена">
    <input type="number" name="count" placeholder="количество">
    <input type="file" name="files[]" multiple="multiple">
    <input class="d-none" type="text" name="action" value="add-product">
    <input type="submit" value="Добавить товар">
    <div class="drag_zone">
        
    </div>
    <div class="drag_preview">
        
    </div>
</form>


<!-- 

    // dragenter - когда объект находится в дроп зоне (1 раз)
    // dragleave - когда вышел за пределы дроп зоны (1 раз)
    // dragover -  когда находимся в зоне (срабатывает постоянно)
    // drop - когда отпустили файлы в дроп зоне

 -->
