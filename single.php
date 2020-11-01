<?php

/*
Template display single post
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


?>

	<section class="page-single-project project-<?= get_the_ID() ?>">
		
		<!-- Title -->
		<div class="row">
			<div class="col-12 block-title">
				<h1><?php echo get_the_title(); ?></h1>
			</div>
		</div>
		<!-- Links -->
		<div class="row">
			<div class="col-12 block-info-header">
			<div class="info-links">
				<a href="<?= get_field('github') ?>" class="text-info link">GitHub</a>
				<a href="<?= get_field('website') ?>" class="text-info link">WebSite</a>
			</div>
			<a class="info-date">
				<?= get_the_date() ?>
			</a>
			</div>
		</div>
		<!-- Content -->
		<div class="row">
			<div class="col-12 block-content">
				<?php echo get_the_content(); ?>
			</div>
		</div>
		
		<!-- Images carrusel -->
		<div class="swiper-container" type-slider="3D-coverflow">
			<div class="swiper-wrapper">
				<?php
					$images = get_field('galeria_imagenes');
					foreach ($images as $img) {
						
				?>
				<img src="<?= $img['url'] ?>" alt="Image project" class="swiper-slide" />
				<?php
					}
				?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>

		<!-- <pre>
			<?= var_dump(get_field('galeria_imagenes')) ?>
		</pre> -->

	</section>

<?php

get_footer(); 

?>