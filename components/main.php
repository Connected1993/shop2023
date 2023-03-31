<?php
    // формируем запрос для получения всех товаров
    $sql = 'SELECT p.*,(SELECT GROUP_CONCAT(url) FROM `source` s WHERE s.id_products = p.id_products ) as url FROM `products` p ';
    // получаем данные
    $result = $dbh->query($sql);
    
    // наши товары в видет ассоциативного массива
    $result = $result->fetchAll();

?>

<main>
    <div class="products">
        <?php 
            // $product - данные о товаре
            foreach($result as $product)
            {
             //  получаем из строки массив
             $product['url'] = explode(',',$product['url']);
        ?>
            <!-- карточка товара -->
            <div class="products__item" >
                <div class="products__name"><?=$product['name']?></div>
                <img src="<?=$product['url'][0]?>" class="products__image">
                <a href="?page=product&id=<?=$product['id_products']?>">
                    <div class="products__price" data-id="<?=$product['id_products']?>"><?=$product['price']?></div>
                </a>
            </div>
            <!-- конец родителя -->
        <?php } ?>
    </div>
</main>