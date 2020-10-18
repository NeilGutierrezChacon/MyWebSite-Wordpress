<?php 

$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
$image = $image[0];

$the_permalink = get_permalink(get_the_ID());

$animation_for_post = $animation_for_post__odd;

if($m % 2 == 0){

$animation_for_post = $animation_for_post__even;

}

$the_content = get_field('descripcion');

$title= get_the_title();

?>

<div class="caja" data-id='<?= get_the_ID() ?>' data-post-type='<?= get_post_type() ?>'>
	<?php if($image){ ?>
		<img src="<?= $image ?>" alt="Imagen destacada del post">
	<?php } ?>
	<div>
		<h3><?= $title ?></h3>
		<div class="descripcion">
			<?=
				wp_trim_char($the_content,200,$the_permalink);
			?>
		</div>
	</div>			
</div>
