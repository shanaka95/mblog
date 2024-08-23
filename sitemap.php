<?php

    $website = 'https://yourwebsite.com';

	// Load the sqlite3 database connection - db.db
	$db = new SQLite3('db.db');

	// Load data from links table
	$results = $db->query('SELECT slug, published_at FROM posts WHERE status = 1');

	// load all data
	$posts = [];
	while ($row = $results->fetchArray()) {
		$posts[] = $row;
	}

    // Set the content type to XML
    header('Content-Type: application/xml');

    // Start the XML structure
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Loop through posts and add them to the sitemap
    foreach ($posts as $post) {
        // Generate URL for the post
        $url = $website . '/' . htmlspecialchars($post['slug']);
        
        // Format the date in the required format for the sitemap
        $lastmod = date(DATE_W3C, strtotime($post['published_at']));
        
        echo '<url>';
        echo '<loc>' . $url . '</loc>';
        echo '<lastmod>' . $lastmod . '</lastmod>';
        echo '<changefreq>weekly</changefreq>';
        echo '<priority>0.8</priority>';
        echo '</url>';
    }

    // Close the XML structure
    echo '</urlset>';
?>