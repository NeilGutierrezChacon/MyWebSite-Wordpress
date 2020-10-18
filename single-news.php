<?php

/*
Template display single post
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


$description = get_field('descripcion');

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 6,
);
$query = new WP_Query( $args );
$posts = $query->posts;



?>

	<section class="dms-template-single">
		<div class = "principal" >
			<div class = "contenido" >
				<h1><?php echo get_the_title(); ?></h1>
				<?php if(isset($image)){ ?>
					<img src="<?= $image ?>" alt="Imagen destacada">
				<?php } ?>
				<p><?php echo $description ?></p>
			</div>
			<!-- SubMenu de la vista News -->
			<div class = "sub-menu">
				<h4>Etiquetas</h4>
				<hr>
				<?php if(get_the_tags()){ ?>
					<ul class = "lista">
						<?php foreach (get_the_tags() as $tag) { ?>
							<li><?= $tag->name ?></li>
						<?php } ?>
					</ul>
				<?php }else{ ?>
					<p>Este post no tiene etiquetas</p>
				<?php } ?>
				<br>
				<h4><a href="http://neil.deideasmarketing.solutions/blog/">Blog</a></h4>
				<span>Posts destacados</span>
				<hr>
				<?php if(isset($posts)){ ?>
					<ul class = "lista">
						<?php foreach ($posts as $element) { ?>
							<li><a href="<?= $element->guid?>"><?= $element->post_title ?></a></li>
						<?php } ?>
					</ul>
				<?php }else{ ?>
					<p>No hay posts registradas</p>
				<?php } ?>
				<br>
				<h4><a href="http://neil.deideasmarketing.solutions/references/">Referencias</a></h4>


			</div>
		</div>
	</section>

<?php

get_footer(); 

?>