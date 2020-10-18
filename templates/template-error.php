<?php

/*
Template Name: Template - Error
*/

get_header();

the_post();

// FEATURED IMAGE
$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'single-post-thumbnail');
$image = $image[0];


$long_text = get_field('dms-texto-explicativo');
$another_title = get_field('dms-another-title');
$another_subtitle = get_field('dms-another-subtitle');
?>

  <section class="dms-template-thanks js-dms-get-page-title" data-page="<?php the_title(); ?>">
    <?php
          $imagen= get_field('imagen_destacada',$dms_post->ID) ;
          $imagen_ias_thumb =  wp_get_attachment_image_src($imagen['id'], 'large');  
    ?>

    <div class="dms-template-thanks__container" style="background-image:url('<?php echo $image?>')">
    <div class="dms-template-thanks__content">

      <div class="dms-template-thanks__message">
        <div class="dms-template-thanks__introtext"><?php echo get_the_content(); ?>
           
        </div>  
         <a href="<?php echo get_home_url();?>" title="Link de retorno al inicio"><span class="dms-button"> <?php e__('Go to home!', THEME_NAME); ?></span></a>                                           
      </div>                                 
     
  </div>
  </section>


<?php

get_footer(); 

?>