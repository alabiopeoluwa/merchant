<?php
	//session_start();
		#title
	$page_title = "Admin Login";

		#include header
include "includes/header.php";

include "includes/db.php";

include "includes/functions.php";

	if(array_key_exists("login", $_POST)){
		#error caching
		$errors = [];

		if(empty($_POST["email"])){
			$errors["email"] = "please enter your email";
		}

		if(empty($_POST["password"])){
			$errors["password"] = "please enter your password";
		}

		if(empty($errors)){
			#select from database

			#clean unwanted values in the $_POST array
			$clean = array_map('trim', $_POST);

		$check = adminLogin($pdo, $clean);
		if($check){

					redirect('category.php');
				}else{

					redirect('login.php?msg=invalid username or password');
				}

			}else{
				foreach ($errors as $error) {
					echo "<p> $error </p>";
				}
			}
		}

?>

<!DOCTYPE html>
<html>


<div class="wrapper">

		<h1 id="register-label">Admin Login</h1>
		<hr>
		<?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?>
		<form id="register"  action ="login.php" method ="POST">
			<div>
			<?php 
				if(isset($errors['email'])) {echo '<span class="err">'.$errors['email']. '</span>';}
			?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
			<?php 
				if(isset($errors['password'])) {echo '<span class="err">'.$errors['password']. '</span>';}
			?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>
</html>
	<?php
		#include footer
include "includes/footer.php";


?>