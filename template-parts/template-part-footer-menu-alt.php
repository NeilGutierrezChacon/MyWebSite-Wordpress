<div class="dms-content-footer-menu-alt">
	<?php
		wp_nav_menu(array(
				'theme_location' => 'footer_menu_alt',
				'container'      => '',
				'items_wrap'    => '<ul class="%2$s">%3$s</ul>',
				'menu_class'     => 'dms-footer-menu-alt',
				'walker'  => new WPDocs_Walker_Nav_Menu() // custom walker
			)
		);
	?>
</div>