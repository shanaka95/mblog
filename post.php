<!DOCTYPE HTML>

<html>

	<?php

	// Set the page title, description and include the header file
	$page_title = "MBlog";
	$page_desc = "MBlog is a minimal, portable blog engine built with PHP and SQLite3. It's SEO-optimized, easy to deploy, and perfect for those who need a lightweight, no-fuss blogging platform.";
	include 'include/header.php'; 
	
	//  get id from GET
	$id = $_GET['id'];

	//  url encode the id
	$id = urlencode($id);

	// real escape string
	$id = SQLite3::escapeString($id);

	// Load the sqlite3 database connection - db.db
	$db = new SQLite3('db.db');

	// Load data from links table
	$result = $db->query('SELECT * FROM posts WHERE status = 1 AND slug= "'.$id.'"');

	$post = $result->fetchArray();

	// if post not found redirect to 404
	if (!$post) {
		header("Location: /404");
	}
	
	$id = $post['id'];

	$title = $post['title'];

	$description = $post['content'];

	$slug = urlencode($post['slug']);

	$tags = $post['tags'];

	// split by comma - remove leading and trailing whitespace
	$tags = array_map('trim', explode(',', $tags));

	$image = $post['featured_img'];

	// Get posts that has the same tags
	$tagged_posts = [];
	foreach($tags as $tag) {
		$results = $db->query('SELECT * FROM posts WHERE status = 1 AND tags LIKE "%'.$tag.'%" AND id != "'.$id.'" ORDER BY RANDOM() LIMIT 3');
		while ($row = $results->fetchArray()) {
			$tagged_posts[] = $row;
		}
	}

	?>
	<body class="is-preload right-sidebar">
		<div id="page-wrapper">

			<!-- Include Header Nav-->
			<?php include 'include/header-nav.php'; ?>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
						<div class="row gtr-200">
							<div class="col-8 col-12-medium">
								<div id="content">

									<!-- Content -->
									<article>
										<h2><?php echo $title ?></h2>
										<div class='post-featured-img-container'>
											<img class='post-featured-img' src="<?php echo $image ?>">
										</div>
										<p><?php echo $description ?></p>
									</article>

								</div>
							</div>
							<div class="col-4 col-12-medium">
								<div id="sidebar">

									<!-- Sidebar -->
										<section>
											<h3>Advertisement</h3>
											<p>You can download the latest version of Mblog from the link provided below.</p>
											<footer> 
												<a href="https://github.com/shanaka95/mblog" class="button featured-btn" style=''>View on Github</a>											
											</footer>
										</section>

										<section>
											<h3>Related Posts</h3>
											<ul class="style2; display: grid">
												<?php foreach($tagged_posts as $tagged_post) { ?>
													<li style='display: grid;grid-template-columns: 1fr 3fr; /* Two auto-sized columns */gap: 10px; /* Optional: space between columns */padding: 10px;border-bottom: 1px solid #ccc; /' >
														<div style='max-width:100px; max-height:100px; overflow: hidden'>
															<img style='max-width:100px' src="/<?php echo $tagged_post['featured_img'] ?>">
														</div>
														<a href="/<?php echo $tagged_post['slug'] ?>"><?php echo $tagged_post['title'] ?></a>
													</li>
												<?php } ?>
		
											</ul>
										</section>

								</div>
							</div>
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