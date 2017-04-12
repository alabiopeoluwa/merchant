<?php
		#title
	$page_title = "Register";

	#load db connection
	include "includes/db.php";

		#load functions
	include "includes/functions.php";

		#include header
	include "includes/header.php";



	#cache errors
	$errors = [];
if(array_key_exists("register", $_POST)){

	#validate firstname
	if(empty($_POST["fname"])){
		$errors["fname"] = "please enter your firstname";
	}

	if(empty($_POST["lname"])){
		$errors["lname"] = "please enter your lastname";
	}

	if(empty($_POST["email"])){
		$errors["email"] = "please enter your email";
	}

	if(doesEmailExist($pdo, $_POST["email"])){
		$errors["email"] = "email already exists";
	}

	if(empty($_POST["password"])){
		$errors["password"] = "Please enter your password";
	}

	if($_POST["password"] != $_POST["pword"]){
		$errors["pword"] = "Empty or incorrect password";
	}


	if(empty($errors)){
		//do database stuff
	
	#eliminate unwanted spaces from values in the $_POST array
		$clean = array_map("trim", $_POST);

	#register admin
	doAdminRegister($pdo, $clean);


		} //else{
		//foreach ($errors as $err) {
		//	echo $err."<br/>";
		//}
	//}
}


?>

<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php
					$one =displayErrors($errors, "fname");
					echo $one;
				?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php
					$two =displayErrors($errors, "lname");
					echo $two;
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php
					$three =displayErrors($errors, "email");
					echo $three;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					$four =displayErrors($errors, "password");
					echo $four;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php
					$five =displayErrors($errors, "pword");
					echo $five;
				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>
	
	<?php
		#include footer
include "includes/footer.php";


?>