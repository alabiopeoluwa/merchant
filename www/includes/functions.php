<?php
	function doAdminRegister($pdo, $input) {
		#hast the password
		$hash = password_hash($input["password"], PASSWORD_BCRYPT);

		#insert data
		$stmt = $pdo->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");

		#bind params
		$data = [
			":fn" => $input["fname"],
			":ln" => $input["lname"],
			":e" => $input["email"],
			":h" => $hash
		];

		$stmt->execute($data);
	}

	function displayErrors($open, $name){
		$result = "";

		if(isset($open[$name])){
			$result = "<span class='err'>".$open[$name]."</span>";
		}
		return $result;
	}

	function doesEmailExist($pdo, $email){
		$result = false;
		$stmt = $pdo->prepare("SELECT email FROM admin WHERE email=:e");

		#bind params
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		#get number of rows returned
		$count = $stmt->rowCount();

		if($count > 0){
			$result = true;
		}
	return $result;
	}

function adminLogin($pdo, $enter){

	$result = true;
	$stmt = $pdo->prepare("SELECT * FROM admin WHERE email=:e");

	#bind params
	$stmt->bindParam(":e", $enter['email']);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$count = $stmt->rowCount();

	if($count !== 1 OR !password_verify($enter['password'], $result['hash'])) {
			$result = false;
		}

	return $result;
	}


	function redirect($loc) {
		header("Location: ".$loc);
	}

function addCategory($pdo,$input){
	$stmt = $pdo->prepare("INSERT INTO category(cat_name) VALUES (:c)");

	$stmt->bindParam(":c", $input['cat_name']);
	if($stmt-> execute()){

		$success = "category successfuly added";
		header("Location:category.php?success=$success");
	}
}


function showCategory($pdo){
		$stmt = $pdo->prepare("SELECT * FROM category ");
		$stmt-> execute();
		$result = "";

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$cat_id =$row['cat_id'];
				$cat_name = $row['cat_name'];

				$result .="<tr>";
				$result .="<td>" .$cat_id. "</td>";
				$result .="<td>" .$cat_name. "</td>";

				$result .="<td><a href='category.php?action=edit&cat_id=$cat_id&cat_name=$cat_name'>edit</a></td>";
				$result .="<td><a href='category.php?act=delete&cat_id=$cat_id'>delete</a></td>";
				$result .="</tr>";
			}

				return $result;
		}

function editCategory($pdo, $input){
	$stmt = $pdo->prepare("UPDATE category SET cat_name =:cn WHERE cat_id = :i");

	$stmt ->bindParam(":cn", $input['cat_name']);
	$stmt->bindParam(":i", $input['cat_id']);
	$stmt->execute();

	$success = "category edited successfuly";
	header("Location:category.php?success=$success");

}

function deleteCat($pdo, $input){

	$stmt = $pdo->prepare("DELETE FROM category WHERE cat_id = :i");

	$stmt->bindParam(":i", $input);
	$stmt->execute();
	$success = "category deleted";
header("Location:category.php?success=$success");
}






function addBooks($pdo,$input,$destination){
	$stmt = $pdo->prepare("INSERT INTO books(title, author, cat_id, price, year_of_publication, ISBN,image_path) VALUES (:t, :a, :ci, :p, :y, :is,:mp)");

	$data =[
					':t'  => $input['title'],
				    ':a'  => $input['author'],
				    ':ci' => $input['cat'],
				    ':p'  => $input['price'],
				    ':y'  => $input['year_of_publication'],
				    ':is' => $input['ISBN'],
				    ':mp' => $destination,
			];
								
			$stmt-> execute($data);

				$success = "Book successfuly added";
				header("Location:product.php?success=$success");
			
		}




		
		function showproduct($pdo){
			$result = "";
			$stmt = $pdo->prepare("SELECT * FROM books ");
			$stmt-> execute();
			$result = "";

			while($details = $stmt->fetch(PDO::FETCH_ASSOC)){
				$bk_id = $details['books_id'];
				$title = $details['title'];
				$author = $details['author'];
				$price = $details['price'];
				$year = $details['year_of_publication'];
				$isbn = $details['ISBN'];
				$path = $details['image_path'];


				$result .="<tr>";
				$result .='<td>' .$title. "</td>";
				$result .='<td>' .$details['author']. "</td>";
				$result .='<td>' .$details['cat_id']. "</td>";
				$result .='<td>' .$details['price']. "</td>";
				$result .='<td>' .$details['year_of_publication']. "</td>";
				$result .='<td>' .$details['ISBN']. "</td>";
				$result .="<td> <img src='$path' height= '50px' width = '50px'/></td>";


				$result .="<td><a href='editproduct.php?id=$bk_id'>edit</a></td>";
				$result .="<td><a href='viewproduct.php?del=delete&books_id=$bk_id'>delete</a></td>";

				$result .="</tr>";
			}

				return $result;
		}



		function deleteproduct($pdo, $input){
			$stmt = $pdo->prepare("DELETE FROM books WHERE books_id = :id ");

			$stmt-> bindParam(":id", $input);								
			$stmt-> execute();

				$success = "Book successfuly deleted";
				header("Location:viewproduct.php?success=$success");
			
		}



		function editProduct($pdo, $input,$destination){
				$stmt = $pdo->prepare("UPDATE books SET title = :t, 
															  author= :a,
															  cat_id = :ci,														
															  price = :p,
															   year_of_publication= :y,
															    ISBN = :is
															    image_path =:mp 
															    WHERE books_id = :bi");

				$data =[
					':t'  => $input['title'],
				    ':a'  => $input['author'],
				    ':p'  => $input['price'],
				    ':y'  => $input['year_of_publication'],
				    ':is' => $input['ISBN'],
				    ':bi' => $input['books_id'],
				    ':ci' => $input['cat'],
				    ':mp' => $destination
			];
								
			if($stmt-> execute($data)){

					$success = "books edited successfuly";
					header("Location:viewproduct.php?success=$success");

				}

			}


			function getProduct($pdo,$id){


	$stmt = $pdo->prepare("SELECT * FROM books where books_id = :id");
	$stmt-> bindParam(":id", $id);
			$stmt-> execute();


			if($details = $stmt->fetch(PDO::FETCH_ASSOC)){
				$books_id = $details['books_id'];
				$title = $details['title'];
				$author = $details['author'];
				$price = $details['price'];
				$year = $details['year_of_publication'];
				$isbn = $details['ISBN'];

			}

			return true;



			}



		function	getCategory($pdo){

				$stmt = $pdo->prepare("SELECT * FROM category");
					$stmt-> execute();

					while($details = $stmt->fetch(PDO::FETCH_ASSOC)){
						$cat_name = $details['cat_name'];
						$cat_id = $details['cat_id'];
						echo "<option value='$cat_id'>$cat_name</option>";
					}

					return true;



			}

			function newBook($pdo,$id){
						
			$stmt = $pdo->prepare("SELECT * FROM books where books_id = :id");
			$stmt-> bindParam(":id", $id);
			$stmt-> execute();


			$details = $stmt->fetch(PDO::FETCH_ASSOC);

			return $details;

}

			function newCat($pdo,$id){
						
			$stmt = $pdo->prepare("SELECT * FROM category where cat_id = :id");
			$stmt-> bindParam(":id", $id);
			$stmt-> execute();


			$details = $stmt->fetch(PDO::FETCH_ASSOC);

			return $details;

}



?>