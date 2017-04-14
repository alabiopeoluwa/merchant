<?php

abstract class Product

{
	protected $title;		//(protected only work for child(inherit))
	protected $price;
	protected $type;

	
	#defining a constructor
	public function __Construct($title, $price) {
		$this->title = $title;
		$this->price = $price;
	}


	//public function setType($type){
		//$this->type = $type;
	//}
	public function getType() {

		return $this->type;
	}





	//public function setPrice($price){
		//$this->price = $price;
	//}

	public function getPrice(){
		return $this->price;
	}





	//public function setTitle($title){
		//$this->title = $title;
	//}

	public function getTitle(){
		return $this->title;
	}

abstract public function preview();
}





?>