<?php

/*
Template Name: DMS - News
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];

$args = array(
	'post_type' => 'news',
	'posts_per_page' => 6,
);
$query = new WP_Query( $args );
$posts = $query->posts;


	
	/* echo "<pre>";
	var_dump($posts[0]);
	echo "</pre>"; */
	

?>

	<section class="dms-template-news">
		<div class="cabecera" style="background-image: url(<?= $image ?>)">
			<h1>
				<?php echo get_the_title(); ?>
			</h1>
		</div>
		<div class="cajas">
			<?php foreach( $posts as $post ){?>
				<div class="caja"  data-id='<?= $post->ID ?> ' data-post-type='<?= $post->post_type?>'>
					<?php if(get_the_image_post($post->ID)){?>
						<img src="<?= get_the_image_post($post->ID) ?>" alt="Imagen destacada del post">
					<?php } ?>
					<div>
						
						<h3><?= $post->post_title ?></h3>
						<div class="descripcion">
							<?php
								$description = get_field('descripcion',$post->ID);
								echo wp_trim_char($description,200,$post->guid);
							?>
						</div>
					</div>					
				</div>
				
			<?php } ?>
		</div>


		<div class="js-dms-ajax-more-posts__button" data-paged="2" data-post_type="news">
						Cargar mas
		</div>

	</section>

<?php

get_footer(); 

?>