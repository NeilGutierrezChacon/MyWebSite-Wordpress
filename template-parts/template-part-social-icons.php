<?php

$facebook 		= get_field("theme_settings_social__facebook", "option");
$twitter 		= get_field("theme_settings_social__twitter", "option");
$google 		= get_field("theme_settings_social__google", "option");
$linkedin 		= get_field("theme_settings_social__linkedin", "option");
$instagram 		= get_field("theme_settings_social__instagram", "option");
$pinterest 		= get_field("theme_settings_social__pinterest", "option");
$youtube 		= get_field("theme_settings_social__youtube", "option");
$tripadvisor 	= get_field("theme_settings_social__tripadvisor", "option");

?>
<div class="dms-social-icons">
	<?php if($facebook){ 	?><a target="_blank" title="Enlace a facebook" href="<?php echo $facebook; ?>" 		class="dms-social-icon"><i class="fa fa-facebook"></i></a><?php } ?>
	<?php if($twitter){ 	?><a target="_blank" title="Enlace a twiter" href="<?php echo $twitter; ?>" 		class="dms-social-icon"><i class="fa fa-twitter"></i></a><?php } ?>
	<?php if($google){ 		?><a target="_blank" title="Enlace a google" href="<?php echo $google; ?>" 			class="dms-social-icon"><i class="fa fa-google"></i></a><?php } ?>
	<?php if($linkedin){ 	?><a target="_blank" title="Enlace a linkein" href="<?php echo $linkedin; ?>" 		class="dms-social-icon"><i class="fa fa-linkedin-square"></i></a><?php } ?>
	<?php if($instagram){ 	?><a target="_blank" title="Enlace a instagram" href="<?php echo $instagram; ?>" 		class="dms-social-icon"><i class="fa fa-instagram"></i></a><?php } ?>
	<?php if($pinterest){ 	?><a target="_blank" title="Enlace a pinterest" href="<?php echo $pinterest; ?>" 		class="dms-social-icon"><i class="fa fa-pinterest"></i></a><?php } ?>
	<?php if($youtube){ 	?><a target="_blank" title="Enlace a youtube" href="<?php echo $youtube; ?>" 		class="dms-social-icon"><i class="fa fa-youtube"></i></a><?php } ?>
	<?php if($tripadvisor){ ?><a target="_blank" title="Enlace a tripadvisor" href="<?php echo $tripadvisor; ?>" 	class="dms-social-icon"><i class="fa fa-tripadvisor"></i></a><?php } ?>
</div>