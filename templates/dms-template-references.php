<?php

/*
Template Name: DMS - References
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];

$args = array(
	'post_type' => 'reference',
	'posts_per_page' => 6,
);
$query = new WP_Query( $args );
$references = $query->posts;


	
	/* echo "<pre>";
	var_dump($references[0]);
	echo "</pre>"; */
	

?>

	<section class="dms-template-references">
		<div class="cabecera" style="background-image: url(<?= $image ?>)">
			<h1>
				<?php echo get_the_title(); ?>
			</h1>
		</div>
		<div class="lista-referencias">
			<?php foreach( $references as $reference ){?>
				<div class="item-reference" onclick="window.location.replace('<?= $reference->guid?>');">
					<div>
						<h3 class="title"><?= $reference->post_title ?></h3>
						<div class="descripcion">
							<?php
								$description = get_field('descripcion',$reference->ID);
								echo wp_trim_char($description,200,$reference->guid);
							?>
						</div>
					</div>
					
					<?php if(get_the_image_post($reference->ID)){ ?>
						<img class="imagen" src="<?= get_the_image_post($reference->ID) ?>" alt="Imagen destacada de la referencia">
					<?php } ?>					
				</div>
				
			<?php } ?>
		</div>


		<!-- <div class="js-dms-ajax-more-posts__button" data-paged="2" data-post_type="news">
						Cargar mas
		</div> -->

	</section>

<?php

get_footer(); 

?>