<?php

	if(function_exists("qts_language_menu")){

	   	?>

	   		<div class="dms-languages">
		        <?php
			        // $type = 'text', 'image', 'dropdown', 'both';
			        // $args = array(
			        //     'id' => 'qts-lang-menu', // ID of html oputput
			        //     'class' => 'qts-lang-menu',  // class / classes of the html output
			        //     'short' => false // if true, display text as short 'English' -> 'en'
			        // );
			        $type = 'text';
			        $args = array(
		            	'id' => 'qts-lang-menu', // ID of html oputput
			            'class' => 'qts-lang-menu',  // class / classes of the html output
			            'short' => false // if true, display text as short 'English' -> 'en'
			        );

			        qts_language_menu($type, $args);

		        ?>
	      	</div>
	   
	  	<?php

	}

?>