<?php


/* функция, выводящая карту продукта на главной странице сайта */
function product_card($connection, $i) {
  ?>
  <a href="product.php?index=<?php echo $i - 1 ?>" class="card-link">
  <?php
  echo "<img src=images/" .take_photo_of_product($connection, $i).">";
  echo take_name_of_product($connection, $i) .'<br>';
  echo take_descript_of_product($connection, $i) .'<br>';
  echo take_cost_of_product_with_id($connection, $i) .'<br>';
  echo take_amount_of_product($connection, $i) .'<br>';
  ?>
  </a>
  <?php
}



/* массив, в котором хранятся все данные о продуктах */
$products_array = array();





/* генерация случайных чисел */
function random_code() {
  $hash_code = str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNMjerhuiewh94t9348t239ufjeifjewioqef839u389fwejfiwufq3489fuefjwoifdvuhergughervdsuwyr487ry4765349028317858349764390864398634934tyrotr87ty458gh7g457gerfeu9fohjeuighweruig45gur475g45g7euqwu4f98qfuergw7g8ghreguwehg8w345ger7g88eru3hwg745geiugwge7rt745guerfhq38934hg74w5gyh457hgwr7y0h0g7w4507gerw7gefuewy7tghewrgjregrughjuergeruhgeiw3uehrvnfjkhvfdnkds$@$#$#@#$sifvheihgriuvnuivnuvnunveuiuvnriuenvruwovrevuowiuernvwneurvwebrverubnruibriububewrhbuerbrururejndkfjnfjkkowkdvsdlslajvdfsjhdfbjhd');
  return $hash_code;
}



/* функция, которая запихивает в массив всю информацию о продуктах */
function all_products($connection) {
  $query = "SELECT * FROM `products`";
  $result = $connection->query($query);

  $products_array = array();

  $rows = $result->num_rows;

  for ($i = 0; $i < $rows; $i++) {
  $result->data_seek($i);
  $item = $result->fetch_assoc();

  $products_array[$i] = $item;
}

  return $products_array;
}



/* Функция, достающая из базы данных наименование продукта */ 
  function take_name_of_product($connection, $i) {
    $name_query = 'SELECT `product-name` FROM products WHERE id = '.$i.'';
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-name'];
  }


/* Функция, достающая из базы данных описание продукта */
  function take_descript_of_product($connection, $i) {
    $name_query = 'SELECT `product-descript` FROM products WHERE id = '.$i.'';
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-descript'];
  }


/* Функция, достающая из базы данных цену продукта через его id */
  function take_cost_of_product_with_id($connection, $i) {
    $name_query = 'SELECT `product-cost` FROM products WHERE id = '.$i.'';
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-cost'];
  }



  /* Функция, достающая из базы данных цену продукта через его product-code */
  function take_cost_of_product_with_code($connection, $product_code) {
    $name_query = "SELECT `product-cost` FROM products WHERE `product-code` = '{$product_code}'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-cost'];
  }


/* Функция, достающая из базы данных оставшееся количество продукта */
  function take_amount_of_product($connection, $i) {
    $name_query = 'SELECT `product-amount` FROM products WHERE id = '.$i.'';
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-amount'];
  }



  /* Функция, достающая из базы данных оставшееся количество продукта */
  function take_amount_of_product_with_code($connection, $product_code) {
    $name_query = "SELECT `product-amount` FROM products WHERE `product-code` = '{$product_code}'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-amount'];
  }



/* Функция, достающая из базы данных фото продукта */
  function take_photo_of_product($connection, $i) {
    $name_query = 'SELECT `product-photo` FROM products WHERE id = '.$i.'';
    $result = mysqli_fetch_assoc(mysqli_query($connection, $name_query));
    return $result['product-photo'];
  }



/* Функция, достающая из базы данных количество продуктов */
  function take_rows_of_products($connection) {
    $query = 'SELECT id FROM products';
    $result = $connection->query($query);
    $result = $result->num_rows;
    return $result;
  }


  /* Функция, заполняющая все колонки таблицы "products" */
  function insert_new_product_to_db($connection) {
    $product_code = $_POST['product-code'];
    $product_name = $_POST['product-name'];
    $product_descript = $_POST['product-descript'];
    $product_cost = $_POST['product-cost'];
    $product_amount = $_POST['product-amount'];
    $product_photo = $_POST['product-photo'];

    $all_products_array = all_product_codes($connection);

    $query = "INSERT INTO `products`(`product-code`, `product-name`, `product-descript`, `product-photo`, `product-cost`, `product-amount`) VALUES ('{$product_code}','{$product_name}','{$product_descript}','{$product_photo}','{$product_cost}', '{$product_amount}')";

    if ($product_code == true && $product_name == true && $product_descript == true && $product_cost == true && $product_amount == true && $product_photo == true) {
      if (in_array($product_code, $all_products_array) === false) {
        $result = $connection->query($query);

        if ($result) {
          ?>
          <div class="result-of-query">Data was sent to database</div>
          <?php
        }
      } else {
        echo "product with this product-code is in db, please enter new code for this product";
      }
    } else {
      ?>
      <div class="result-of-query">Data was not sent to database</div>
      <?php
    }
  }



/* Функция для выборки всех кодов товаров, для будущего изменения товара */
  function all_product_codes($connection) {
    $query = "SELECT * FROM `products`";
    $result = $connection->query($query);

    $product_codes_array = array();

    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; $i++) {
    $result->data_seek($i);
    $item = $result->fetch_assoc()['product-code'];

    $product_codes_array[$i] = $item;
  }

    return $product_codes_array;
  }



  /* Функция для замены информации о цене продукта */
  function update_product_cost($connection) {
    $new_product_cost = $_POST['new-product-cost'];
    $product_code = $_POST['product-code-verify-for-cost'];

    $product_codes = all_product_codes($connection);

    if ($product_code && $new_product_cost) {
      $query = "UPDATE `products` SET `product-cost` = '{$new_product_cost}' WHERE `product-code` = '{$product_code}'";
    if (in_array($product_code, $product_codes)) {
      $result = $connection->query($query);
      
      if ($result) {
        echo "true";
      }
      } else {
        echo 'try again to use write product code';
      }
    } else {
      echo 'enter code and new cost of product';
    }
  }



  /* Функция для замены информации о количестве продукта */
  function update_product_amount($connection) {
    $new_product_amount = $_POST['new-product-amount'];
    $product_code = $_POST['product-code-verify-for-amount'];

    $product_codes = all_product_codes($connection);

    if ($product_code && $new_product_amount) {
      $query = "UPDATE `products` SET `product-amount` = '{$new_product_amount}' WHERE `product-code` = '{$product_code}'";
    if (in_array($product_code, $product_codes)) {
      $result = $connection->query($query);
      
      if ($result) {
        echo "true";
      }
      } else {
        echo 'try again to use right product code';
      }
    } else {
      echo 'enter code and new amount of product';
    }
  }



/* Функция, удаляющая продукт из базы данных */
  function delete_product($connection) {
    $product_code = $_POST['product-code-for-delete'];

    $product_codes = all_product_codes($connection);

    if ($product_code) {
      $query = "DELETE FROM `products` WHERE `product-code` = '{$product_code}'";
      if (in_array($product_code, $product_codes)) {
        $result = $connection->query($query);

        if ($result) {
          echo "true";
        }
      } else {
        echo "there isn't product with this product code";
      }
    } else {
      echo "Please, enter code of product into input";
    }
  }



  /* Функция бронрования товара и сообщения об этой брони на отдельной странице */
function block_product($connection) {

    $product_code = $_POST['product-code-for-block-product'];
    $product_name = $_POST['product-name-for-block-product'];
    $product_amount = $_POST['product-amount-for-block-product'];
    $consumer_name = $_POST['consumer-name-for-block-db'];
    $consumer_telephon_number = $_POST['consumer-telephone-for-block-db'];
    $block_date = (date('Y-m-d H:i:s'));

    $all_codes = all_product_codes($connection);


    $cost_of_one_product = take_cost_of_product_with_code($connection, $product_code);
    $cost_of_all = $cost_of_one_product * $product_amount;


    $first_amount = take_amount_of_product_with_code($connection, $product_code);
    $second_amount = $first_amount - $product_amount;

    $query_delete_block_amount_from_db = "UPDATE `products` SET `product-amount` = '{$second_amount}' WHERE `product-code` = '{$product_code}'";

    $query_insert_amount_to_block_db = "INSERT INTO `block_products`(`consumer-name`, `consumer-telephone-number`, `product-code`, `product-name`, `product-amount`, `cost-of-all`, `date-of-sale`) VALUES ('{$consumer_name}','{$consumer_telephon_number}','{$product_code}','{$product_name}','{$product_amount}','{$cost_of_all}', '{$block_date}')";

  if (in_array($product_code, $all_codes)) {
    if ($_POST['consumer-name-for-block-db']) {
        if ($_POST['consumer-telephone-for-block-db']) {
            if ($_POST['product-amount-for-block-product']) {
                if ($product_amount < $first_amount) {
                    $result_of_query_delete = $connection->query($query_delete_block_amount_from_db);
                    $result_of_query_insert = $connection->query($query_insert_amount_to_block_db);
                    if ($result_of_query_delete && $result_of_query_insert) {
                        setcookie("cost-of-all", $cost_of_all);
                        setcookie("amount-of-products", $product_amount);
                        echo "All is good, wait your phone to call";
                        echo "<div>All order will cost you {$cost_of_all}</div>";
                        header('Location: succsesfull-order-result.php');
                    }
                } else {
                    echo 'There are not' .$product_name .'in amount what you want';
                    if ($first_amount > 0) {
                    echo 'You can buy less amount of this product';
                    } else {
                    echo 'There are any of this product, you can buy another product';
                    }
                }
            } else {
                echo "You don't enter amount of product";
            }
        } else {
            echo "You don't enter your phone-number";
        }  
    } else {
        echo "You don't enter your name";
    }
  }

}





/* функция для смены номера телефона в базе данных */
function change_consumer_number($connection) {
  $new_number = $_POST['new-phone-number'];

  $query = "UPDATE `block_products` SET `consumer-telephone-number` =  '{$new_number}' WHERE `consumer-telephone-number` = '{$_SESSION['phone-number']}'";

  $result = $connection->query($query);

  if ($result) {
    echo "true";
  }

  header('Location: succsesfull-order-result.php');
}



/*  */
function change_product_amount($connection) {
  $new_number = $_POST['new-product-amount'];

  $query = "UPDATE `block_products` SET `product-amount` =  '{$new_number}' WHERE `consumer-telephone-number` = '{$_SESSION['phone-number']}'";

  $result = $connection->query($query);

  if ($result) {
    echo "true";
  }

  header('Location: succsesfull-order-result.php');
}



function order_list($connection) {
  $query = "SELECT * FROM `block_products`";

  $result = $connection->query($query);
  
  $products_array = array();
  
  $rows = $result->num_rows;
  
  for ($i = 0; $i < $rows; $i++) {
    $result->data_seek($i);
    $item = $result->fetch_assoc();
  
    $products_array[$i] = $item;
  }
  
    return $products_array;
}




?>