<?php
include "Product.php";
include "Book.php";



$bk = new Book(4000, "things fall apart", 1500);

$type = $bk->getpageCount();

$me = $bk->getType();

$you = $bk->getTitle();

$us = $bk->getPrice();


echo $type;
echo "<br/>";

echo $me;
echo "<br/>";

echo $you;
echo "<br/>";

echo $us;
?>