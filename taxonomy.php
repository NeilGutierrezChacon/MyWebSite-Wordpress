<?php

/* Template for display tax */

get_header();

$queried_object = get_queried_object();

$posts_per_page = '4';
$post_type 		= 'post';
$post_status 	= 'publish';
$order  		= 'DESC';
$orderby  		= 'date';

$tax_query 		= array();
$meta_query 	= array();

$tax_query[] 	= array(
	'taxonomy' => 'project_type',
	'field'    => 'term_id',
	'terms'    => array($queried_object->term_id),
	'operator' => 'IN',
);

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query_args = array(
	'post_type' 		=> $post_type,
	'post_status' 		=> $post_status,
	'order' 			=> $order,
	'orderby' 			=> $orderby,
	'posts_per_page' 	=> $posts_per_page,
	'tax_query'			=> $tax_query,
	'meta_query'		=> $meta_query,
	'paged' 			=> $paged,
	'nopaging'          => false
);

  // The Query
$query = new WP_Query( $query_args );

?>

	<section class="dms-template-taxonomy">
		<div class="dms-container">
			<div class="dms-block-posts">
				<?php
					if($query->have_posts()){
						$m = 0;
						// Start the loop.
						while ( $query->have_posts() ) : $query->the_post();
							include(locate_template('template-parts/template-part-loop-post.php'));
            				$m++;
						endwhile;
						// End the loop.
					}else{
						// No have posts
						_e( "No have posts.", THEME_NAME );
					}
				?>
			</div>
		</div>
		<div class="dms-block-content-button-ajax">
			<?php dms_print_load_more_button( $query, "custom-load-more-button" ); ?>
		</div>
	</section>

<?php

get_footer(); 

?>