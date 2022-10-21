<?php
require_once 'modules/db-settings.php';
require_once 'modules/nav-bar.php';
require_once 'modules/main-scripts.php';

$count_products = take_rows_of_products($connection);

    for ($i = 1; $i <= $count_products; $i++) {
       
        product_card($connection, $i);
    }

?>

<form action="admin.php" method="post">
    <div><input type="text" name="product-code"</div>
    <div><input type="text" name="product-name"</div>
    <div><input type="text" name="product-descript"</div>
    <div><input type="text" name="product-cost"</div>
    <div><input type="text" name="product-photo"</div>
    <div><input type="text" name="product-amount"</div>
    <div><input type="submit" value="Send data about new product"</div>
</form>

<form action="admin.php" method="post">
    <div><input type="text" name="new-product-cost"</div>
    <div><input type="text" name="product-code-verify-for-cost"</div>
    <div><input type="submit" value="update cost"</div>
</form>

<form action="admin.php" method="post">
    <div><input type="text" name="product-code-for-delete"</div>
    <div><input type="submit" value="delete info about product"</div>
</form>

<form action="admin.php" method="post">
    <div><input type="text" name="product-code-verify-for-amount"</div>
    <div><input type="text" name="new-product-amount"</div>
    <div><input type="submit" value="update amount"</div>
</form>


