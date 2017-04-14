<?php

include "Product.php";


#instantiate an object of class product

$prod = new Product();
//$prod is a pointer referencing the object [new product]
//method are the interphase through which you access a class

$type = $prod->getType();

echo $type;

echo "<br/>";

//echo $prod->type;


$prod2 = new Product();

$prod2->setPrice(500);

$price = $prod2->getPrice();

echo $price;

//$prod2 = new Product();
echo $prod2->getPrice();





?>