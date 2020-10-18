<?php

/*
Template Name: DMS - About Us
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


?>

	<section class="dms-template-about-us">

		<div class="cabecera">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
		
		<div class="js-test">
			Lorem ipsum dolor sit amet consectetur, adipisicing elit.
		</div>
		
	</section>

<?php

get_footer(); 

?>