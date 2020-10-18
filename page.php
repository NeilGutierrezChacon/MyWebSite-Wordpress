<?php

/*
Template default page
*/

get_header();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


?>

	<section class="dms-template-default">
		<?php echo get_the_title(); ?>
	</section>

<?php

get_footer(); 

?>