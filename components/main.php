<?php
    // формируем запрос для получения всех товаров
    $sql = 'SELECT p.*, ( select GROUP_CONCAT(s.url) from `source` s WHERE s.id_products = p.id_products ) as urls FROM `products` p';
    // получаем данные
    $result = $dbh->query($sql);
    
    // наши товары в видет ассоциативного массива
    $result = $result->fetchAll();
    
    // $products = [];

    // foreach($result as $product)
    // {
    //     // если такого товара еще не было тогда добавляем
    //     if (!isset($products[$product['id_products']])){
    //         // $products[8]
    //         $products[$product['id_products']] = $product; 
    //         // перезаписываем url
    //         $products[$product['id_products']]['url'] = [ $product['url'] ]; 
    //     }
    //     else
    //     {
    //         // если товар уже был, тогда мы добавляем еще один url
    //         // sfgfgfgf
    //         $products[$product['id_products']]['url'][] = $product['url'];
    //     }
    // }

?>

<main>
    <div class="products">
        <?php 
            // $product - данные о товаре
            foreach($result as $product)
            {
            $product['urls'] = explode(',',$product['urls']);
            
            $url = (isset($product['urls'][3]))?  $product['urls'][3] : $product['urls'][0] ; 
        ?>
            <!-- карточка товара -->
            <div class="products__item" >
                <div class="products__name"><?=$product['name']?></div>
                <img src="<?=$url?>" class="products__image">
                <a href="/components/product.php?id=<?=$product['id_products']?>">
                    <div class="products__price" data-id="<?=$product['id_products']?>"><?=$product['price']?></div>
                </a>
            </div>
            <!-- конец родителя -->
        <?php } ?>
    </div>
</main>