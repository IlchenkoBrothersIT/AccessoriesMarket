<?php

require_once "modules/nav-bar.php";

require_once 'modules/products.php'; 
$item = $products_array[$_GET['index']];

 echo $item['product-descript'];
?>

<form action="succsesfull-order.php" method="post">
    <div><input type="text" name="consumer-name-for-block-db" placeholder="Your name"></div>
    <div><input type="text" name="consumer-telephone-for-block-db" placeholder="Your phone-number"></div>
    <input type="number" name="product-amount-for-block-product" placeholder="Amount of product">
    <input type="hidden" name="product-code-for-block-product" value="<?php echo $item['product-code']?>">
    <input type="hidden" name="product-name-for-block-product" value="<?php echo $item['product-name']?>">
    <input type="submit" value="Make order">

<form>