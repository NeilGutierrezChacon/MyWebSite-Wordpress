<?php

/*
Template Name: DMS - Legal
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


?>

	<section class="dms-template-legal">
		<div class="dms-container">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
		<?php 

			// USE PARALLAX - YOU NEED RELATION ACF FIELD FOR CHOOSE ONE PARALLAX SCENE TO SHOW HERE - ONLY ID
			// $parallax_scene_id = get_field('escenario_parallax_a_mostrar');
			// if(!!$parallax_scene_id && is_array($parallax_scene_id) ) $parallax_scene_id = $parallax_scene_id[0];
			// dms_print_parallax_scene($parallax_scene_id);

		?>
	</section>

<?php

get_footer(); 

?>