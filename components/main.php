<?php
    // формируем запрос для получения всех товаров
    $sql = 'SELECT name,description,price,article,s.url,p.id_products FROM `products` p
    INNER JOIN `source` s ON  p.id_products = s.id_products';
    // получаем данные
    $result = $dbh->query($sql);
    
    // наши товары в видет ассоциативного массива
    $result = $result->fetchAll();
    
    $products = [];

    foreach($result as $product)
    {
        // если такого товара еще не было тогда добавляем
        if (!isset($products[$product['id_products']])){
            // $products[8]
            $products[$product['id_products']] = $product; 
            // перезаписываем url
            $products[$product['id_products']]['url'] = [ $product['url'] ]; 
        }
        else
        {
            // если товар уже был, тогда мы добавляем еще один url
            $products[$product['id_products']]['url'][] = $product['url'];
        }
    }
  
?>

<main>
    <div class="products">
        <?php 
            // $product - данные о товаре
            foreach($products as $product)
            {
        ?>
            <!-- карточка товара -->
            <div class="products__item" >
                <div class="products__name"><?=$product['name']?></div>
                <img src="<?=$product['url'][0]?>" class="products__image">
                <div class="products__price" data-id="<?=$product['id_products']?>"><?=$product['price']?></div>
            </div>
            <!-- конец родителя -->
        <?php } ?>
    </div>
</main>