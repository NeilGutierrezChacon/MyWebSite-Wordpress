<?php

if ( ! function_exists('dms_custom_post_type_parallax_scene') ) {
	function dms_custom_post_type_parallax_scene() {

		// Create custom post types

		// PARALLAX SCENE CPT
		$labels_parallax_scene = array(
				'name'                => _x( 'Parallax Scenes', 'Post Type General Name', THEME_NAME ),
				'singular_name'       => _x( 'Parallax Scene', 'Post Type Singular Name', THEME_NAME ),
				'menu_name'           => __( 'Parallax Scenes', THEME_NAME ),
				'parent_item_colon'   => __( 'Parent Parallax Scene:', THEME_NAME ),
				'all_items'           => __( 'All Parallax Scenes', THEME_NAME ),
				'view_item'           => __( 'View Parallax Scene', THEME_NAME ),
				'add_new_item'        => __( 'Add New Parallax Scene', THEME_NAME ),
				'add_new'             => __( 'Add New', THEME_NAME ),
				'edit_item'           => __( 'Edit Parallax Scene', THEME_NAME ),
				'update_item'         => __( 'Update Parallax Scene', THEME_NAME ),
				'search_items'        => __( 'Search Parallax Scene', THEME_NAME ),
				'not_found'           => __( 'Not found', THEME_NAME ),
				'not_found_in_trash'  => __( 'Not found in Trash', THEME_NAME ),
		);
		$args_parallax_scene = array(
				'label'               => __( 'Parallax Scene', THEME_NAME ),
				'description'         => __( 'Parallax Scenes', THEME_NAME ),
				'labels'              => $labels_parallax_scene,
				'supports'            => array( 'title', 'page-attributes'),
				'taxonomies'          => array( '' ),
				'hierarchical'        => false,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 70,
				'can_export'          => true,
				'public' 				=> false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' 	=> true,  // you should be able to query it
				'show_ui' 				=> true,  // you should be able to edit it in wp-admin
				'exclude_from_search' 	=> true,  // you should exclude it from search results
				'show_in_nav_menus' 	=> false,  // you shouldn't be able to add it to menus
				'has_archive' 			=> false,  // it shouldn't have archive page
				'rewrite' 				=> false,  // it shouldn't have rewrite rules
				'capability_type'     	=> 'page',
				'menu_icon'           	=> 'dashicons-images-alt2'
		);
		register_post_type( 'dms_parallax_scene', $args_parallax_scene );

		// flush_rewrite_rules();
		
	}
	add_action( 'init', 'dms_custom_post_type_parallax_scene', 0 );
	
}

function dms_print_parallax_scene($dms_parallax_scene_id){

	if(!!$dms_parallax_scene_id){

        $dms_parallax_scene = get_field("escenario_parallax", $dms_parallax_scene_id);

        if(!!$dms_parallax_scene){

            $imagen_fondo_parallax  = get_field("imagen_de_fondo_del_escenario", $dms_parallax_scene_id);

            $data_calibrate_x       = get_field("calibrate-x",  $dms_parallax_scene_id); if( !isset($data_calibrate_x) ) $data_calibrate_x   = false;
            $data_calibrate_y       = get_field("calibrate-y",  $dms_parallax_scene_id); if( !isset($data_calibrate_y) ) $data_calibrate_y   = true;
            $data_invert_x          = get_field("invert-x",     $dms_parallax_scene_id); if( !isset($data_invert_x) )    $data_invert_x      = true;
            $data_invert_y          = get_field("invert-y",     $dms_parallax_scene_id); if( !isset($data_invert_y) )    $data_invert_y      = true;
            $data_limit_x           = get_field("limit-x",      $dms_parallax_scene_id); if( !isset($data_limit_x) )     $data_limit_x       = false;
            $data_limit_y           = get_field("limit-y",      $dms_parallax_scene_id); if( !isset($data_limit_y) )     $data_limit_y       = false;
            $data_scalar_x          = get_field("scalar-x",     $dms_parallax_scene_id); if( !isset($data_scalar_x) )    $data_scalar_x      = '10.0';
            $data_scalar_y          = get_field("scalar-y",     $dms_parallax_scene_id); if( !isset($data_scalar_y) )    $data_scalar_y      = '10.0';
            $data_friction_x        = get_field("friction-x",   $dms_parallax_scene_id); if( !isset($data_friction_x) )  $data_friction_x    = '0.1';
            $data_friction_y        = get_field("friction-y",   $dms_parallax_scene_id); if( !isset($data_friction_y) )  $data_friction_y    = '0.1';
            $data_origin_x          = get_field("origin-x",     $dms_parallax_scene_id); if( !isset($data_origin_x) )    $data_origin_x      = '0.5';
            $data_origin_y          = get_field("origin-y",     $dms_parallax_scene_id); if( !isset($data_origin_y) )    $data_origin_y      = '0.5';

            ?>

                <div class="dms-parallax-scene" style="background-image:url(<?php echo $imagen_fondo_parallax['url']; ?>);">

                    <ul id="scene" class="dms-parallax-scene__scene js-dms-parallax-scene-custom"
                        data-calibrate-x="<?php echo $data_calibrate_x; ?>"
                        data-calibrate-y="<?php echo $data_calibrate_y; ?>"
                        data-invert-x="<?php echo $data_invert_x; ?>"
                        data-invert-y="<?php echo $data_invert_y; ?>"
                        data-limit-x="<?php echo $data_limit_x; ?>"
                        data-limit-y="<?php echo $data_limit_y; ?>"
                        data-scalar-x="<?php echo $data_scalar_x; ?>"
                        data-scalar-y="<?php echo $data_scalar_y; ?>"
                        data-friction-x="<?php echo $data_friction_x; ?>"
                        data-friction-y="<?php echo $data_friction_y; ?>"
                        data-origin-x="<?php echo $data_origin_x; ?>"
                        data-origin-y="<?php echo $data_origin_y; ?>"
                    >
                        
                        <?php 

                            foreach ($dms_parallax_scene as $key => $current_layer) {

                                $current_layer_repeater = $current_layer['layer'];
                                $current_layer_depth = $current_layer['depth'];
                                $current_layer_depth = floatval($current_layer_depth);
                                $current_layer_custom_classes = $current_layer['custom_classes'];

                                if($current_layer_depth<0.01){
                                    $current_layer_depth = 0;
                                }else if($current_layer_depth>0.99){
                                    $current_layer_depth = 1;
                                }
                                
                                if(!empty($current_layer_repeater)){

                                    ?>
                                        
                                        <li class="dms-parallax-scene__layer layer <?php echo $current_layer_custom_classes; ?>" data-depth="<?php echo $current_layer_depth; ?>">

                                            <?php

                                                foreach ($current_layer_repeater as $key => $layer) {
                                                    
                                                    $image = $layer['imagen'];
                                                    $left = $layer['left'];
                                                    $top = $layer['top'];
                                                    $negative_offset_x = floatval($data_scalar_x);
                                                    $negative_offset_y = floatval($data_scalar_y);

                                                    $total_left = floatval($left) - $negative_offset_x;
                                                    $total_top = floatval($top) - $negative_offset_y;

                                                    $max_width = 100 + ($negative_offset_x * 2);

                                                    ?>
                                                       
                                                        <img 
                                                        	class="dms-parallax-scene__image" 
                                                        	src="<?php echo $image['url']; ?>" 
                                                        	alt="<?php echo $image['alt']; ?>" 
                                                        	style=" top: <?php echo $total_top; ?>%; left: <?php echo $total_left; ?>%; max-width: <?php echo $max_width; ?>%;">
                                                       

                                                    <?php

                                                }

                                            ?>

                                        </li>

                                    <?php

                                }

                            }

                        ?>
                    </ul>
                </div>

            <?php

        }

    }

}
