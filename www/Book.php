<?php
include "Product.php";
Class Book extends Product {
	private $author;
	private $pageCount;
//@overide (weve overriden the constructor of the product)
	public function __Construct($pg, $title, $price) {
		#call the overriden constructor
		parent::__Construct($title, $price);
		$this->pageCount = $pg;
		$this->type="book";
	}
	public function getpageCount() {
		return $this->pageCount;
		}
}
#public function preview() {
#	echo "<p>type: ".$this->getType()."</p>";
#			}



?>