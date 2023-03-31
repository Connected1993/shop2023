<?php

if (isset($_GET['page']))
{
    $page = $_GET['page'];
    
    switch($page)
    {
        case 'basket':
        case 'product':
            includeFile(PAGES,$page);
        break;

        case 'admin':
            includeFile(ROOT,$page);
        break;

        case 'logout':
            $_GET['logout'] = 1;
            includeFile(ROOT,'handler');
        break;

        default:
            //всегда грузим по умолчанию
            //includeFile(COMPONENTS,'main');
        redirectUrl();
        break;
    }
}
else
{
    // по умолчанию грузим главную страничку
    includeFile(COMPONENTS,'main');
}

function redirectUrl($url = '/')
{
    header("Location: $url ",false,302);
    exit;
}

function includeFile($path,$fName)
{
    // передаем переменную для коннекта к базе
    global $dbh;
    // проверяем существует ли файл ?
    if (file_exists($path.'/'.$fName.'.php'))
    {
        // подключаем файл
        require_once($path.'/'.$fName.'.php');
    }
}