<!DOCTYPE HTML>
<html lang="en">

	<?php 

	// Set the page title, description and include the header file
	$page_title = "MBlog";
	$page_desc = "MBlog is a minimal, portable blog engine built with PHP and SQLite3. It's SEO-optimized, easy to deploy, and perfect for those who need a lightweight, no-fuss blogging platform.";
	include 'include/header.php'; 

	// get search from GET
	$search = $_GET['search'] ?? null;
	$search_query = null;

	if (!empty($search)) {
		// remove all non-alphanumeric characters
		$search = preg_replace("/[^a-zA-Z0-9]+/", "", $search);

		// real escape string
		$search = SQLite3::escapeString($search);

		$search_query = ' AND (title LIKE "%'.$search.'%" OR content LIKE "%'.$search.'%" OR tags LIKE "%'.$search.'%")';
	}
	
	//  get cartegory from GET
	$c = $_GET['category'] ?? null;
	$category = null;
	if (!empty($c)) {
		// remove all non-alphanumeric characters
		$category = preg_replace("/[^a-zA-Z0-9]+/", "", $c);

		// real escape string
		$category = SQLite3::escapeString($category);

		$category = ' AND tags LIKE "%'.$category.'%"';
	}

	// Load the sqlite3 database connection - db.db
	$db = new SQLite3('db.db');

	$q = "SELECT * FROM posts WHERE status = 1 $category $search_query ORDER BY id LIMIT 15";

	// Load data from links table
	$results = $db->query($q);

	// load all data
	$posts = [];
	while ($row = $results->fetchArray()) {
		$posts[] = $row;
	}

	// Close the database connection
	$db->close();
	
	?>
	<body class="is-preload homepage">
		<div id="page-wrapper">

			<!-- Include Header Nav-->
			<?php include 'include/header-nav.php'; ?>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">

						<?php foreach($posts as $post) { 
							$id = $post['id'];

							$title = $post['title'];

							$description = $post['content'];

							$slug = urlencode($post['slug']);
			
							// Reduce the description to 200 characters
							$description = substr($description, 0, 150);

							// Get featured image
							$image = $post['featured_img'];
							
							?>
							<div class="col-4 col-12-medium">
								<!-- Box -->
								<section class="box feature" style=' cursor: pointer' onclick='document.location.href="/<?php echo $slug ?>"'>
									<a href="#" class="image featured"><img src="<?php echo $image ?>" alt="" /></a>
									<div class="inner">
										<header>
											<h2><?php echo $title ?></h2>
										</header>
										<p><?php echo $description ?></p>

										<a href="/<?php echo $slug ?>" class="button icon solid fa-file-alt read-more-btn" >Read More</a>
									</div>
								</section>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>


				<!-- Include Footer -->
				<?php include 'include/footer.php'; ?>

			</div>

		<!-- Scripts -->
		<?php include 'include/js.php'; ?>

	</body>
</html>