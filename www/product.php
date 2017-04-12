<?php
	$page_title = "TSSB | PRODUCT";

	session_start();
	$_SESSION['active'] = true;
	
	include 'includes/db.php';

	include 'includes/functions.php';
	
	include 'includes/header.php';

$errors = [];
	if(array_key_exists('add', $_POST)){
		#cache errore
		

		#validate first name
		if(empty($_POST['title'])){
			$errors['title'] = "enter title";
		}
		
		if(empty($_POST['author'])){
			$errors['author'] = " please enter author";
		}
		
		if(empty($_POST['cat'])){
			$errors['cat'] = "please select category";
		}

		
		if(empty($_POST['price'])){
			$errors['price'] ="please enter price";
		}

		if(empty($_POST['year_of_publication'])){
			$errors['year_of_publication'] ="please enter year_of_publication";
		}

		if(empty($_POST['ISBN'])){
			$errors['ISBN'] ="please enter ISBN";
		}

			define("MAX_FILE_SIZE", "2097152");

#allowed extention...
	$ext = ["image/jpg", "image/jpeg", "image/png"];


	#be sure a file was selected..
	if(empty($_FILES['pic']['name'])){
		$errors[] = "please choose a file";
	}

	#check file size...
	if($_FILES['pic']['size'] > MAX_FILE_SIZE){
		$errors[] = "file size exceeds maximum. maximum:".MAX_FILE_SIZE;
	}

	#check extension
	if(!in_array($_FILES['pic']['type'],$ext)) {
		$errors[] = "invalid file type";
	}

	# generate random number to append
	$rnd =rand(00000, 99999);

	#strip filename for spaces
	$strip_name = str_replace(" ", "_", $_FILES['pic']['name']);

	$filename = $rnd.$strip_name;
	$destination ='upload/'.$filename;

	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)){
		$errors[]= "file upload failed";
	}
		
		if(empty($errors)){
			//do database stuff

		#eliminate unwanted spaces from values in the $_POST array
			$clean = array_map('trim', $_POST);
		
	#register admin
		addBooks($dbo, $clean, $destination);

		if(isset($_GET['success'])){
		echo $_GET['success'];
	}
		}
	}

	?>
<div class="wrapper">
		<h1 id="register-label">ADD BOOKS</h1>
		<hr>
		<form id="register"  action ="product.php" method ="POST" enctype="multipart/form-data">
			<div>

			<?php 
				$reveal = displayErrors($errors,'title');echo $reveal;
				?>
			
				<label>Title:</label>
				<input type="text" name="title" placeholder="title">
			</div>
			
			<div>
			
				<?php 
					$view = displayErrors($errors,'author');echo $view;
				?>

				<label>Author:</label>	
				<input type="text" name="author" placeholder="author">
			</div>

			<div>
				<?php 
					$show = displayErrors($errors, 'cat');echo $show;
				?>

				<label>Category:</label>
				<select name = "cat">
				<option value="">Select</option>
				<?php getCategory($conn) ?>
					


				</select>
			</div>

			<div>
				<?php 
					$show = displayErrors($errors, 'price');echo $show;
				?>

				<label>Price:</label>
				<input type="text" name="price" placeholder="price">
			</div>
 
			<div>
				<?php 
					$show = displayErrors($errors, 'year_of_publication');echo $show;
				?>

				<label>Year:</label>
				<input type="text" name="year_of_publication" placeholder="year_of_publication">
			</div>

			<div>
				<?php 
					$show = displayErrors($errors, 'ISBN');echo $show;
				?>

				<label>ISBN:</label>
				<input type="text" name="ISBN" placeholder="ISBN">
			</div>

			<div>
			
				<label>please upload a file</label>
				<input type="file" name="pic">
				
				</div>

		<input type="submit" name="add" value="Add">
		</form>
		

		










<?php include 'includes/footer.php' ?>
