<?php

/*
Template display single post
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
$news = $query->posts;

	/* echo "<pre>";
	var_dump($news[0]);
	echo "</pre>"; */
?>

	<section class="dms-template-single">
		<div class = "principal" >
			<!-- Contenido principal -->
			<div class = "contenido" >
				<h1><?php echo get_the_title(); ?></h1>
				<?php if(isset($image)){ ?>
					<img src="<?= $image ?>" alt="Imagen destacada">
				<?php } ?>
				<p><?php echo get_the_content(); ?></p>
			</div>
			<!-- SubMenu de la vista single -->
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
				<h4><a href="http://neil.deideasmarketing.solutions/news/">News</a></h4>
				<span>Noticias destadacas</span>
				<hr>
				<?php if(isset($news)){ ?>
					<ul class = "lista">
						<?php foreach ($news as $element) { ?>
							<li><a href="<?= $element->guid?>"><?= $element->post_title ?></a></li>
						<?php } ?>
					</ul>
				<?php }else{ ?>
					<p>No hay noticias registradas</p>
				<?php } ?>
				<br>
				<h4><a href="http://neil.deideasmarketing.solutions/references/">Referencias</a></h4>
			</div>
		</div>
	</section>

<?php

get_footer(); 

?>