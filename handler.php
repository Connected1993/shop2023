<?php
require_once('config.php');
session_start();
//echo '<pre>';
// $_POST - массив - содержит в себе информацию о POST запросе

if (isset($_GET['logout']))
{
    // перезаписываем сессию
    $_SESSION = [];
    // очищаем куку для сесси
    setcookie(session_name(),'',time()-999999);
    // уничтожаем сессию
    session_destroy();
    // перенаправляем пользователя на главную странчку
    header('Location: /shop2023/sign.php',true,301);
    exit;
}


if (isset($_POST['action']))
{
    require('db.php');
    // $action = search
    $action = $_POST['action'] ?? '';
    $text = $_POST['text'] ?? ''; 

    switch($action)
    {
        case 'add-product':
                // посмотреть список входящих файлов!
            
                // получаем данные о товаре
                $name = $_POST['name'] ?? NULL;
                $article = $_POST['article'] ?? NULL;
                $description = $_POST['description'] ?? NULL;
                // (int) - преобразуем в число 
                $price = (int)$_POST['price'] ?? NULL;
                $count = (int)$_POST['count'] ?? NULL;

                // создаем подготовленный запрос
                $sth = $dbh->prepare(" INSERT INTO products (name,description,article,price,quantity) VALUES (:n,:d,:a,:p,:c) ");
                // выполнить sql запрос
                $sth->execute( ['n'=>$name,'d'=>$description,'a'=>$article,'p'=>$price,'c'=>$count] );

                // получаем id вставленной записи
                $insert_id = $dbh->lastInsertId();

                if ($insert_id)
                {
                    // если были файлы на загрузку
                    if (count($_FILES) > 0 )
                    {
                            // новый массив с файлами
                            $files = [];
                            foreach($_FILES['files']['name'] as $key => $value )
                            {
                                foreach($_FILES['files'] as $name => $arr)
                                {
                                    $files[$key][$name]= $arr[$key];  
                                }
                            }

                            // вызываем нашу функцию и передаем наш массив $files
                            // return array
                            $result = uploadFiles($files);
                            $sql = " INSERT INTO photos (id_products,url) VALUES ";
                            $sql_values = '';

                            foreach($result['files'] as $name)
                            {
                                $name = validationStr($name);
                                $name = ROOT_PATH.'/src/'.$name;
                                $sql_values .= "($insert_id,'$name'),";    
                            }
                        
                            // substr() - вырезает из строки символы в диапазоне
                            // убрали символ "," в конце строки
                            $sql_values = substr($sql_values,0,strlen($sql_values)-1);
                            $sql = $sql.$sql_values;
       
                            // подготавливаем выражение
                            $dbh->query($sql);

                            if ($dbh->lastInsertId())
                            {
                                echo 'Успешно добавили ссылку '.$dbh->lastInsertId();
                            }

                    }
                    // echo 'Успешно добавили товар '.$insert_id;
                }
                else
                {
                    echo '<pre>';
                    var_dump( $dbh->errorInfo() );
                }
        break;

        case 'search':
            // запускаем функция поиска
            search($text);
        break;

        case 'registration':
            reg();
        break;

        case 'authorization':
            auth();
        break;

        default:
            die('Неизвестный параметр');
        break;
    }
}

function uploadFiles($files)
{
        $count = 0;
        $response = [
            'count'=>0,
            'files'=>[]
        ];
        // перебираем наш массив с файлами
        foreach ($files as $array)
        {
            // получаем имя текущего файла
            // implode() - join()
            // explode() - split()
            // taro.zip - > ['taro','zip'] - индексный массив
            $fName = explode('.',$array['name']);
            // записываем название файла без расширения
            $fName2 = $fName[0].'_'.time().'.'.$fName[1];
            // перемещаем файл из временной директории сервера в нашу постоянную
            // в src
            // забираем файл из tmp_name 
            $result = move_uploaded_file($array['tmp_name'],ROOT_PATH.'/src/'.$fName2);
            if ($result)
            {
                // если файл был успешно мерещен в постоянную директорию
                $count++;
                // записываем имя файла
                $response['files'][] = $fName2;
            }
        }
        // записываем количество перемещенных файлов 
        $response['count'] = $count;
        // возвращаем $response
        return $response;
}


function search($text)
{
    // переменная содержит подключение к бд
    $dbh = $GLOBALS['dbh'];
    // формируем запрос
    $sql = "SELECT id,name FROM `city` WHERE Name like '$text%' ORDER BY Name ASC LIMIT 0,5 ";
    // отправляем запрос в базу
    $result = $dbh->query($sql)->fetchAll();

    // конвертируем массив в json
    // и выводим содержимое в виде строки
    //echo json_encode($result);

    foreach($result as $key=>$arr)
    {
        // echo "<li><a href='product.php?id=".$arr['id']."'>".$arr['name']."</a></li>";
        printf("<li><a href='product.php?id=%s'>%s</a></li>",$arr['id'],$arr['name']);
    }
}

function reg()
{
    extract($_POST);

    if ($p1 !== $p2) die('пароли не совпадают!');

    // переменная содержит подключение к бд
    $dbh = $GLOBALS['dbh'];
    // формируем select запрос
    $sql = "INSERT INTO users (login,password,email,age) VALUES ('$login','$p1','$email',$age) "; 
    // отправляем запрос в базу и получаем ответ
    $result = $dbh->query($sql);

    $response = ( $dbh->lastInsertId() ) ? 'Успешно зарегистрировались!' : 'Ошибка!' ;
    echo $response;
}

function auth()
{
    extract($_POST);
    //echo validationStr($login);
  
    // переменная содержит подключение к бд
    $dbh = $GLOBALS['dbh'];
    $sql = "SELECT * FROM users WHERE (login='$login' or email='$email') AND password = '$p1' ";
    // query() - отправляем запрос
    // fetchAll() - получаем ответ 
    $result = $dbh->query($sql)->fetchAll();
    // если пользователь был найден
    if ($result)
    {
        // положили данные по ключу USER в сессию
        $_SESSION['USER'] = current($result);
        // перенаправляет пользователя на страницу
        header('Location: /shop2023',true,301);
        exit;
    } 
    else
    {
        die('Неверный логин или пароль!');
    }

}



function validationStr($str)
{
    // эканирование символов \
    return str_replace(['#','\'','"','-','*'],'',$str); 
}