<?php
	$page_title = "TSSB | VIEW PRODUCT";

	session_start();
	$_SESSION['active'] = true;
	
	include 'includes/db.php';

	include 'includes/functions.php';
	
	include 'includes/header.php';

if(array_key_exists('edit', $_POST)){
		$clean = array_map('trim', $_POST);
		deleteproduct($dbo, $clean);
	}
	if(array_key_exists('edit', $_POST)){
		$clean = array_map('trim', $_POST);
		editproduct($dbo, $clean);
					}

	if(isset($_GET['success'])){
		echo $_GET['success'];
	}

	?>

	<div class="wrapper">
		<div id="stream"></br></br>
		<h3>BOOK SHELF </h3>
		<table id="tab">
			<thead>
				<tr>
					<th>Title</th>
					<th>author</th>
					<th>category_id</th>
					<th>price</th>
					<th>year_of_publication</th>
					<th>ISBN</th>
					<th>images</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
		<tbody>
			<?php $view = showproduct($dbo); echo $view; ?>
		</tbody>
			</table>


		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
		</div>
		<?php

		


if(isset($_GET['del'])){

	if($_GET['del'] == "delete"){
			deleteproduct($dbo, $_GET['books_id']);
	}
	}

	?>


<?php include 'includes/footer.php'?>
