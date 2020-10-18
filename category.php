<?php

/* Template for display tax category */

get_header();

?>

	<section class="dms-template-taxonomy">

		<?php

			// Start the loop.
			while ( have_posts() ) : the_post();

				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
				$image = $image[0];

				?>

					<article class="dms-post">
						<?php echo get_the_title(); ?>
					</article>

				<?php 

				// End the loop.

			endwhile;

		?>

	</section>

<?php

get_footer(); 

?>