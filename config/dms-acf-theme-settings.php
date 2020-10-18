<?php

// CUSTOM OPTIONS THEME
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme General Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'General',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Social Settings',
		'menu_title'	=> 'Social',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Email Settings',
		'menu_title'	=> 'Email',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme GDPR Settings',
		'menu_title'	=> 'GDPR',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

// GET IF ACF GROUP EXIST BY PARAMETER (DEFAULT post title)
function is_field_group_exists($value, $type='post_title') {
    $exists = false;
    if ($field_groups = get_posts(array('post_type'=>'acf-field-group'))) {
        foreach ($field_groups as $field_group) {
            if ($field_group->$type == $value) {
                $exists = true;
            }
        }
    }
    return $exists;
}

function dms_add_preview_dms_email( $field ) {
    
    if ($field['key'] == "field_5873a7537973e"){

        // Print testing email.
		global $dms_emails;
		$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
		$content .= "<br><br>";
		$content .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
		$content .= "<br><br>";
		$content .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
		echo $dms_emails->get_html($content);
		
    }

}
add_action( 'acf/render_field', 'dms_add_preview_dms_email', 10, 1 );