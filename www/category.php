<?php
	$page_title = "TSSB | CATEGORY";

	session_start();
	$_SESSION['active'] = true;
	
	include "includes/db.php";

	include "includes/functions.php";
	
	include "includes/header.php";

	if(array_key_exists("add", $_POST)){
		$clean = array_map("trim", $_POST);
		addCategory($pdo, $add);
	}

	if(array_key_exists("edit", $_POST)){
		$clean = array_map("trim", $_POST);
		editCategory($pdo, $add);
					}

	if(isset($_GET["success"])){
		echo $_GET["success"];
	}

?>
	

<!-- edit category -->
		<div class="wrapper">
		<div id="stream"></br></br>

		<p>

		<?php	
		if(isset($_GET['action'])){

		if($_GET['action'] = "edit"){
		
		
		?>
		<h3>Edit Category</h3>
		<form id="register" method="post" action="category.php">
		<input type="text" name="cat_name" placeholder="Category Name" value="<?php echo $_GET['cat_name']; ?>" />
		<input type="hidden" name="cat_id" placeholder="category id"  value="<?php echo $_GET['cat_id']; ?>"/>

		<input type="submit" name="edit" value="edit">
		</form>
		<?php
}
}

if(isset($_GET['act'])){

	if($_GET['act'] = "delete"){
			deleteCat($conn, $_GET['cat_id']);
	}
	}
	?>

		<h3>ADD Category</h3>
	<form id="register" method="post" action="category.php">
		<input type="text" name="cat_name" placeholder="Category Name" />
		<input type="submit" name="add" value="Add">
		</form>
		</p><br/>
	<hr>



<!--  show category -->
	<h3>Available category </h3>
		<table id="tab">
			<thead>
				<tr>
					<th>Category Id</th>
					<th>category Name</th>
					<th>edit</th>
					<th>delete</th>
				</tr>
			</thead>
			<tbody>
				<?php $view = showCategory($pdo); echo $view; ?>
			</tbody>
			</table>
		</div>
		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
		</div>

<?php include 'includes/footer.php'?>



</table>
