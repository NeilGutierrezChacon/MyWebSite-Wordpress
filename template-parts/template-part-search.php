<div class="dms-search js-dms-search">
	<form class="dms-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
			printf( '<input class="dms-input-search" type="text"  value="%1$s" name="s" title="%2$s" />',
				get_search_query(),
				esc_attr__( 'Search for:', THEME_NAME )
			);
		?>
		<div class="dms-button-search">
			<span class="fa fa-search js-dms-button-search"></span>
		</div>
	</form>
</div>