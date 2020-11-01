<?php

/*
Template Name: Template - Contacto
*/

get_header();

the_post();

$imagen_administrador = get_field('imagen_administrador');
$nombre_administrador = get_field('nombre_administrador');
$email_contacto = get_field('email_contacto');
$formulario_contacto = get_field('formulario_contacto');

?>

	<section class="page-contact">
		<!-- Title -->
		<div class="row mt-3">
			<div class="col-sm-12 col-md-12">
				<h1 class="text-center">
					How to find me?
				</h1>
			</div>
		</div>
		<!-- My profile -->
		<div class="row">
			<div class="col-sm-12 block-profile">
				<img
					src="<?= $imagen_administrador["url"] ?>"
					alt="Imagen de usuario"
				/>
				<div class="cont-text">
					<h3><?= $nombre_administrador ?></h3>
					<p>Email: <?= $email_contacto ?></p>
				</div>
			</div>
		</div>
		
		<!-- Redes sociales -->
		<div class="row">
			<div class="col-12 social">
				<i class="fab fa-facebook fa-4x"></i>
				<i class="fab fa-github fa-4x"></i>
				<i class="fab fa-linkedin-in fa-4x"></i>
			</div>
		</div>
      	<!-- Formulario de mensaje directo -->
		<div class="row d-flex justify-content-center mt-5 block-form-contact">
			<?= do_shortcode($formulario_contacto); ?>
		</div>
		
	</section>

<?php

get_footer(); 

?>