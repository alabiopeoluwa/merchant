<?php
<<<<<<< HEAD
include "Product.php";
Class Book extends Product {
	private $author;
	private $pageCount;
//@overide (weve overriden the constructor of the product)
	public function __Construct($pg, $title, $price) {
		#call the overriden constructor
=======


include "Product.php";

Class Book extends Product {

	private $author;
	private $pageCount;


//@overide (weve overriden the constructor of the product)
	public function __Construct($pg, $title, $price) {
		#call the overriden constructor

>>>>>>> model
		parent::__Construct($title, $price);
		$this->pageCount = $pg;
		$this->type="book";
	}
<<<<<<< HEAD
	public function getpageCount() {
		return $this->pageCount;
		}
}
=======

	public function getpageCount() {

		return $this->pageCount;
		}


}

>>>>>>> model
#public function preview() {
#	echo "<p>type: ".$this->getType()."</p>";
#			}



<<<<<<< HEAD
=======


>>>>>>> model
?>