<?php
require_once "modules/db-settings.php";
require_once "modules/main-scripts.php";
require_once "modules/nav-bar.php";

insert_new_product_to_db($connection);

update_product_cost($connection);

print_r(all_product_codes($connection));

delete_product($connection);

update_product_amount($connection);
?>
