<?php

/*
Template display 404 template
*/

get_header();

?>

	<section class="dms-404">
		<h1><?php esc_html_e('No Results Found',THEME_NAME); ?></h1>
		<p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.',THEME_NAME); ?></p>
	</section>

<?php

get_footer(); 

?>