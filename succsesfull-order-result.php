<?php

session_start();


require_once "modules/db-settings.php";
require_once "modules/nav-bar.php";
require_once "modules/main-scripts.php";

echo "<div>All is good. Wait your phone to call. We will phone you on number <b>" .$_SESSION["phone-number"]. "</b>. If this number is incorrect, lets go to change it</div>";


echo "<div>Now amount of product is <b>".$_COOKIE['amount-of-products']. "</b>. If you want to change amount of product tap this button</div>";

echo "<div>Cost of all sale is <b>".$_COOKIE['cost-of-all']. "</b>. rubles</div>";


if (isset($_POST['new-phone-number'])) {
    change_consumer_number($connection);
    $_SESSION["phone-number"] = $_POST['new-phone-number'];
}

?>

<form action="succsesfull-order-result.php" method="post">
<input type="number" name="new-phone-number">
<input type="submit" value="send new phone-number">
</form>