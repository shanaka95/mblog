<!DOCTYPE HTML>

<html>

	<?php

	// Set the page title, description and include the header file
	$page_title = "MBlog";
	$page_desc = "MBlog is a minimal, portable blog engine built with PHP and SQLite3. It's SEO-optimized, easy to deploy, and perfect for those who need a lightweight, no-fuss blogging platform.";
	include 'include/header.php'; 
	
	?>
	<body class="is-preload right-sidebar">
		<div id="page-wrapper">

			<!-- Include Header Nav-->
			<?php include 'include/header-nav.php'; ?>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container not-found-container center-grid">
						<img src="/assets/images/404.png" alt="404"  class='not-found-img'>
					</div>
				</div>

				<!-- Include Footer -->
				<?php include 'include/footer.php'; ?>

			</div>

		<!-- Scripts -->
		<?php include 'include/js.php'; ?>

	</body>
</html>