<?php

/*
Template Name: Template - Blog
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; 
$args = array(
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page' => 6,
);
$query = new WP_Query( $args );
$posts = $query->posts;



$imagen_cabecera = get_field('imagen_cabecera');

$categories = get_categories();

?>

	<section class="page-blog">
		<!-- Title -->
		<div class="row">
			<div class="col-sm-12 col-xl-12">
				<div class="block-title">
					<img src=<?= $imagen_cabecera["url"]  ?> alt="Helmet icon of a Spartan">
					<h1 class="text-center"><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	  <!-- Nav Search -->
		<div class="row">
			<div class="col-sm-12">
				<div class="nav-search">
					<form action="/blog/1" method="GET">
						<div class="input-group my-4">
							<input name="title" type="text" class="form-control" placeholder="Write a project" aria-label="Write a project" aria-describedby="button-search">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="submit" id="button-search"><i class="fas fa-search fa-lg"></i> Search</button>
							</div>
						</div>
					</form> 
				</div> 
			</div>
		</div>
		<!-- Recommended Post -->
		<div class="row">
			<div class="col-sm-12 px-0">
				<!-- Swiper -->
				<?php include(locate_template('template-parts/posts-swiper.php')); ?>
			</div>
		</div>

		<!-- List of post -->
		<div class="row mt-4">
			<section class="col-md-9 col-sm-12 main-section">
				<?php
					foreach ($posts as $key => $post) {
						include(locate_template('template-parts/post.php'));
					}
				?>
				<!-- Pagination -->
				<nav class="mt-3" aria-label="Page navigation example">
					<?php 
				
						$total_pages = $query->max_num_pages;

						if ($total_pages > 1){
					
							$pages = paginate_links(array(
								'base' => get_pagenum_link(1) . '%_%',
								'format' => 'page/%#%',
								'current' => $paged,
								'total' => $total_pages,
								'prev_text'    => __('« prev'),
								'next_text'    => __('next »'),
								'type'  => 'array',
							));

							if( is_array( $pages ) ) {
								
								echo '<ul class="pagination">';
								foreach ( $pages as $page ) {
										echo "<li class='page-item pagination-item'>$page</li>";
								}
							   echo '</ul>';
								
							}
						
						}
						
					?>
				</nav>
				
			</section>
			<section class="col-md-3 sub-section">
			<div class="most-seen">
				<h6>The most seen</h6>
				<?php
					foreach ($posts as $key => $post) {
						include(locate_template('template-parts/post-most-seen.php'));
					}
				?>
			</div>
			<div class="categories">
				<h6>Categories</h6>
				<ul>
					<?php
						foreach ($categories as $category) {
							
					?>
						<li><a><?= $category->name ?></a></li>

					<?php
						}
					?>
				</ul>
			</div>
			</section>
		</div>
	</section>
<?php

wp_reset_postdata(); 
get_footer(); 

?>