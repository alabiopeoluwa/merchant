<?php

include "Product.php";

$prod = new Product("book", "things fall apart", 500);

$show = $prod->getTitle();
echo $show;







?>