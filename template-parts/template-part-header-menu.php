<div class="dms-block-header-menu__block">

	<div class="dms-toggle-mobile-menu">
    	<i class="fa fa-bars"></i>
  	</div>

  	<div class="dms-content-nav js-dms-content-menu">
        <nav role="navigation">
          	<?php

	            wp_nav_menu( array(
	                'theme_location' 	=>  'header_menu',
	                'container'     	=>  '',
	                'items_wrap'    	=> '<ul class="%2$s">%3$s</ul>',
	                'menu_class'    	=> 'dms-menu dms-header-menu menu-depth-0',
	                'walker'  			=> new WPDocs_Walker_Nav_Menu() // custom walker
	            ));

          	?>
        </nav>

  	</div>

</div>