<?php

session_start();

		#include header
include "includes/header.php";

include "includes/db.php";

include "includes/functions.php";


?>


<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="category.php">ADD CATEGORIES</a></li>
					<li><a href="view_category.php">VIEW CATEGORIES</a></li>
					<li><a href="product.php">ADD PRODUCTS</a></li>
					<li><a href="view_product.php">VIEW PRODUCTS</a></li>
					<li><a href="logout.php">LOGOUT</a></li>
				</ul>
			</nav>
		</div>
	</section>
	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>post title</th>
						<th>post author</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
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

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
