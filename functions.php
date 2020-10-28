<?php

/**
 * *****************************************************************************
 * Define issue fields
 * *****************************************************************************
 */
// FROM :: WPML Coding API -- https://wpml.org/documentation/support/wpml-coding-api/
define ( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
// FROM :: CONTROLLING BEHAVIOR BY SETTING CONSTANTS --- http://contactform7.com/controlling-behavior-by-setting-constants/
define ( 'WPCF7_LOAD_CSS', false );
define ( 'WPCF7_AUTOP', false );
// FROM :: Using contact Form 7 3.9 or higher
add_filter ( 'wpcf7_load_css', '__return_false' );
add_filter ( 'wpcf7_autop', '__return_false' );
// FROM: Using woocommerce
if(class_exists('woocommerce')) {
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}
}

/**
 * *****************************************************************************
 * Define custom fields
 * *****************************************************************************
 */

// DEVELOPMENT MODE
define ( "DEVELOPMENT_MODE", false);

// DEBUG fields
define ( "DEBUG_ADMIN", false );

// DESIGN BY
define ( "DESIGN_BY", "Design with ❤️ by");

// DESIGN BY TEXT
define ( "DESIGN_BY_TEXT", "NGCH43 Company");

include get_template_directory() . '/theme-custom-fields.php';


// THEME fields
$theme = wp_get_theme();
define ( "THEME_NAME", $theme->get( 'Name' ) );
define ( "THEME_TITLE", ucfirst($theme->get( 'Name' )) );

// URL PATHS
define ( "CONFIG_DIRECTORY", get_template_directory_uri() . "/config" );
define ( "ASSETS_DIRECTORY", get_template_directory_uri() . "/assets" );
define ( "TEMPLATE_PARTS_DIRECTORY", get_template_directory_uri() . "/template-parts" );
define ( "IMAGES_DIRECTORY", ASSETS_DIRECTORY . "/images" );
define ( "CSS_DIRECTORY", ASSETS_DIRECTORY . "/css" );
define ( "JS_DIRECTORY", ASSETS_DIRECTORY . "/js" );

// SERVER PATHS
define ( "SERVER_CONFIG_DIRECTORY", get_template_directory() . "/config" );
define ( "SERVER_ASSETS_DIRECTORY", get_template_directory() . "/assets" );
define ( "SERVER_TEMPLATE_PARTS_DIRECTORY", get_template_directory() . "/template-parts" );
define ( "SERVER_IMAGES_DIRECTORY", SERVER_ASSETS_DIRECTORY . "/images" );
define ( "SERVER_CSS_DIRECTORY", SERVER_ASSETS_DIRECTORY . "/css" );
define ( "SERVER_JS_DIRECTORY", SERVER_ASSETS_DIRECTORY . "/js" );


// ACTIVE PARALLAX SCENE
define ( "ACTIVE_PARALLAX_SCENE", false );

// POSTS PER PAGE
define("DMS_POST_PER_PAGE", 10);

// DEFINE DMS USER ID ADMIN
define( "DMS_USER_ID", 1);

// DEVELOPERS
$developers = array(
	"ngch" => true,
);

/**
 * *****************************************************************************
 * Require files
 * *****************************************************************************
 */

// TGM config
require_once get_template_directory() . '/config/wp-require-plugins.php';

// GLOBAL VAR ARRAY ANIMATIONS
require_once get_template_directory() . '/config/dms-animations.php';

// NEED INSTALLED ACF
if(class_exists('acf')){
	
	require_once get_template_directory() . '/emails/DMS_Email.php';
	require_once get_template_directory() . '/emails/smtpvalidateclass.php';

	// ADD PAGES OF THEME SETTINGS
	require_once get_template_directory() . '/config/dms-acf-theme-settings.php';

	// ADD CUSTOM FIELDS IN PAGES OF THEME SETTINGS
	// require_once get_template_directory() . '/config/dms-acf-theme-fields.php'; // DEPRECATED - NO USE

	if(ACTIVE_PARALLAX_SCENE){
		// ADD PAGES OF THEME SETTINGS
		require_once get_template_directory() . '/config/dms-config-parallax-scene.php';
	}

}




if(function_exists("is_woocommerce")){
	//include_once('widgets/woocommerce-dropdown-cart.php');
}
 
/**
 * *****************************************************************************
 * Favicon setup
 * *****************************************************************************
 */
function favicon() {

	if(class_exists('acf')){

		$url_favicon 		= get_field("theme_settings_general__favicon", "option");
		$favicon 			= ($url_favicon) ? $url_favicon["sizes"]["large"] : IMAGES_DIRECTORY . '/favicon.ico';

		echo '<link rel="shortcut icon" href="' . $favicon  . '" />';

	}

}

/**
 * *****************************************************************************
 * Login setup
 * *****************************************************************************
 */
function my_login_logo() {

	if(class_exists('acf')){

		$url_logo 			= get_field("theme_settings_general__logo", "option");
		$logo 				= ($url_logo) ? $url_logo["sizes"]["large"] : IMAGES_DIRECTORY . '/logo.png';

		$background_image_login = get_field("theme_settings_general__login_bg_image", "option");
		if($background_image_login) $background_image_login = $background_image_login["sizes"]["large"];
		$background_image_register = get_field("theme_settings_general__register_bg_image", "option");
		if($background_image_register) $background_image_register = $background_image_register["sizes"]["large"];

		favicon();

		?>
	    <style type="text/css">
	    	/* Custom login */
	        body.login div#login h1 a {
	            width: 100%;
				background: url(<?php echo $logo; ?>) no-repeat;
	        	margin-bottom: 10px;
	        	background-position: center;
	        	background-size: contain;
	        	height: 140px;
	        }

	        body.login  #backtoblog,  body.login  #nav{
	        	padding: 15px;
	        	background-color: rgba(255,255,255, 1);
	        }
	        body.login  #backtoblog{
	        	margin-top: 0;
	        }

	        body.login #backtoblog a, body.login #nav a{
	        	color: #72777c;
	        	font-size: 1.2em;
	        }

	        body.login #backtoblog a:hover, body.login #nav a:hover {
			    color: #00a0d2;
			}

			html{
				background: none!important;
			}

			html, body.login{
				height: auto!important;
				min-height: 100vh;
			}

	        body.login.login-action-login{
	        	background: url(<?php echo $background_image_login; ?>) no-repeat center center;
	        	background-size: cover;
	        	background-attachment: fixed; 
	        }

	        body.login.login-action-register{
	        	background: url(<?php echo $background_image_register; ?>) no-repeat center center;
	        	background-size: cover;
	        	background-attachment: fixed;
	        }



	    </style>
		<?php

	}
	
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {return home_url();}
function my_login_logo_url_title() {return THEME_TITLE;}
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/**
 * *****************************************************************************
 * Setup
 * *****************************************************************************
 */


if (isset($_GET['activated']) && is_admin()){


	//Title Pages
	$home_page_title 	 =  __('Home', THEME_NAME);
	$contact_page_title  =  __('Contact', THEME_NAME);
	$thanks_page_title 	 =  __('Thanks', THEME_NAME);
	$error_page_title 	 =  __('404', THEME_NAME);
	$about_page_title 	 =  __('About us', THEME_NAME);
	$legal_page_title 	 =  __('Legal Advice', THEME_NAME);
	$cookies_page_title  =  __('Cookies Policy', THEME_NAME);
	$blog_page_title  	 =  __('Blog', THEME_NAME);

	//Content & Slug pages
    $new_page_content	 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec.';
    $new_page_slug 	  	 = '';
    $blog_page_slug 	 = 'blog';

    //Name og template pages
    $new_page_template 		 = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
    $home_page_template  	 = 'templates/dms-template-home.php';
    $contact_page_template   = 'templates/dms-template-contact.php';
    $thanks_page_template    = 'templates/dms-template-thanks.php';
    $error_page_template     = 'templates/dms-template-error.php';
    $about_page_template     = 'templates/dms-template-about-us.php';
    $legal_page_template     = 'templates/dms-template-legal.php';
    $cookies_page_template   = 'templates/dms-template-cookies.php';
    $blog_page_template   	 = 'templates/dms-template-blog.php';

    //Cheks
    $page_check_home 		= get_page_by_title($home_page_title);
    $page_check_contact 	= get_page_by_title($contact_page_title); 
    $page_check_thanks 		= get_page_by_title($thanks_page_title); 
    $page_check_error	    = get_page_by_title($error_page_title); 
    $page_check_about 		= get_page_by_title($about_page_title); 
    $page_check_legal 		= get_page_by_title($legal_page_title); 
    $page_check_cookies 	= get_page_by_title($cookies_page_title);
    $page_check_blog 		= get_page_by_title($blog_page_title);


	    $page_home = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $home_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1,
	        'ID' 			=> 3
	    );
	    $page_contact = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $contact_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    ); 
	    $page_thanks = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $thanks_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    );
	    $page_error = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $error_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    );
	    $page_about = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $about_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    );
	    $page_legal = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $legal_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    );
	    $page_cookies = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $cookies_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $new_page_slug,
	        'post_author' 	=> 1
	    );
	    $page_blog = array(
	    	'post_type' 	=> 'page',
	        'post_title' 	=> $blog_page_title,
	        'post_content' 	=> $new_page_content,
	        'post_status'	=> 'publish',
	        'post_slug' 	=> $blog_page_slug,
	        'post_author' 	=> 1
	    );


    if(!isset($page_check_home->ID)){
        $home_page_id = wp_insert_post($page_home);
        if(!empty($home_page_template)){
            update_post_meta($home_page_id, '_wp_page_template', $home_page_template);
        }
    }
    if(!isset($page_check_contact->ID)){
        $contact_page_id = wp_insert_post($page_contact);
        if(!empty($contact_page_template)){
            update_post_meta($contact_page_id, '_wp_page_template', $contact_page_template);
        }
    }
    if(!isset($page_check_thanks->ID)){
        $thanks_page_id = wp_insert_post($page_thanks);
        if(!empty($thanks_page_template)){
            update_post_meta($thanks_page_id, '_wp_page_template', $thanks_page_template);
        }
    }
    if(!isset($page_check_error->ID)){
        $error_page_id = wp_insert_post($page_error);
        if(!empty($error_page_template)){
            update_post_meta($error_page_id, '_wp_page_template', $error_page_template);
        }
    }
     if(!isset($page_check_about->ID)){
        $about_page_id = wp_insert_post($page_about);
        if(!empty($about_page_template)){
            update_post_meta($about_page_id, '_wp_page_template', $about_page_template);
        }
    }
    if(!isset($page_check_legal->ID)){
        $legal_page_id = wp_insert_post($page_legal);
        if(!empty($legal_page_template)){
            update_post_meta($legal_page_id, '_wp_page_template', $legal_page_template);
        }
    }
    if(!isset($page_check_cookies->ID)){
        $cookies_page_id = wp_insert_post($page_cookies);
        if(!empty($cookies_page_template)){
            update_post_meta($cookies_page_id, '_wp_page_template', $cookies_page_template);
        }
    }

    if(!isset($page_check_blog->ID)){
        $blog_page_id = wp_insert_post($page_blog);
        if(!empty($blog_page_template)){
            update_post_meta($blog_page_id, '_wp_page_template', $blog_page_template);
        }
    }

}

if (isset($_GET['activated']) && is_admin()){
	// Set the blog page
	$blog = get_page_by_title( 'Blog' );
	update_option( 'page_for_posts', $blog->ID );

	// Use a static front page
	$front_page = 3; // this is the default page created by WordPress
	update_option( 'page_on_front', $front_page );
	update_option( 'show_on_front', 'page' );
}



/**
 * A function used to programmatically create a post in WordPress. The slug, author ID, and title
 * are defined within the context of the function.
 *
 * @returns -1 if the post was never created, -2 if a post with the same title exists, or the ID
 *          of the post if successful.
 */
/*
function programmatically_create_post() {

	// Initialize the page ID to -1. This indicates no action has been taken.
	$post_id = -1;

	// Setup the author, slug, and title for the post
	$author_id 	= 1;
	$slug 		= 'noticia-de-ejemplo';
	$title 		= 'Noticia de ejemplo';
	$content    = 'Hola! Este es tu primer post. Edítalo o bórralo, luego empieza a escribir! 😉';

	// If the page doesn't already exist, then create it
	if( !post_exists_by_slug( $slug ) ) {

		// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_author'		=>	$author_id,
				'post_name'			=>	$slug,
				'post_title'		=>	$title,
				'post_content'		=>  $content,
				'post_status'		=>	'publish',
				'post_type'			=>	'post'
			)
		);

	// Otherwise, we'll stop
	} else {

    		// Arbitrarily use -2 to indicate that the page with the title already exists
    		$post_id = -2;

	} // end if

} */// end programmatically_create_post

add_filter( 'after_setup_theme', 'programmatically_create_post' );


 /**
 * post_exists_by_slug.
 *
 * @return mixed boolean false if no post exists; post ID otherwise.
 */
function post_exists_by_slug( $post_slug ) {
    $args_posts = array(
        'post_type'      => 'post',
        'post_status'    => 'any',
        'name'           => $post_slug,
        'posts_per_page' => 1,
    );
    $loop_posts = new WP_Query( $args_posts );
    if ( ! $loop_posts->have_posts() ) {
        return false;
    } else {
        $loop_posts->the_post();
        return $loop_posts->post->ID;
    }
}



/**
 * Removes excess Wordpress header tags from default themes. 
 *         feel free to customize the options to suit your own needs.
 */
function clean_wp_header() {
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'feed_links',2);
  remove_action('wp_head', 'feed_links_extra',3);
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

  remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
  remove_action('welcome_panel', 'wp_welcome_panel');

}
add_action('init', 'clean_wp_header');



add_action('admin_head','favicon');
if (! function_exists ( 'theme_setup' )) :
	function theme_setup() {
		
		// Load text domain
		load_theme_textdomain ( THEME_NAME, get_template_directory () . '/languages' );
		// Add theme supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support('post-thumbnails');
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
		) );
		
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
		) );
		
		add_theme_support('woocommerce');

		// instanciate email (NEED INSTALLED ACF)
		if(class_exists('DMS_Email')){

			$GLOBALS['dms_emails'] = DMS_Email::instance(null);

		}
		
	}
endif;
add_action ( 'after_setup_theme', 'theme_setup' );

if (! function_exists ( 'theme_admin_setup' )) :
	function theme_admin_setup() {
		// Restrict admin page
		if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			wp_redirect( home_url() );
			exit;
		} else {
			// Add capabilities

		}
	}
endif;
add_action( 'admin_init', 'theme_admin_setup', 1 );


/**
 * *****************************************************************************
 * Task after install
 * *****************************************************************************
 */

add_action( 'admin_init', 'dms_wptai_remove_default_post');
add_action( 'admin_init', 'dms_wptai_remove_default_page');
add_action( 'admin_init', 'dms_wptai_change_uncategorized');
add_action( 'admin_init', 'dms_wptai_set_permalink_postname' );
add_action( 'admin_init', 'dms_wptai_delete_plugins' );
add_action( 'admin_init', 'dms_wptai_disable_comments_and_pings' );
add_action( 'admin_init', 'dms_wptai_delete_config_sample_file' );
add_action( 'admin_init', 'dms_wptai_delete_readme_html_file' );
add_action( 'admin_init', 'dms_wptai_delete_themes' );
// add_action( 'admin_init', 'dms_wptai_deactivate_this_plugin' );


// Remove default post 'Hello Word'
function dms_wptai_remove_default_post() {
	
	if ( FALSE === get_post_status( 1 ) ) {
	   	// The post does not exist - do nothing.		
	} else {
	   	wp_delete_post(1);
	}
	
} // end of dms_wptai_remove_default_post() function.

// Remove the default example page
function dms_wptai_remove_default_page() {
	
	if ( FALSE === get_post_status( 2 ) ) {
	   	// The page does not exist - do nothing.		
	} else {
	   	wp_delete_post(2);
	}
	
} // end of dms_wptai_remove_default_page() function


// Change the name and slug of default category to news
function dms_wptai_change_uncategorized() {
	
	$term = term_exists( __('Uncategorized', 'wp-tasks-after-install', 'wp-tai'), 'category'); // check if 'uncategorized' category exists
	
	if ($term !== 0 && $term !== null) {  // if exists change name and slug
	  wp_update_term(1, 'category', array(
	  	'name' => __( 'Blog', 'wp-tasks-after-install', 'wp-tai' ),
	  	'slug' => __( 'blog', 'wp-tasks-after-install', 'wp-tai' )
	  ));
	}
	
} // end of dms_wptai_change_uncategorized() function.


// Set permlinks to postname  /%postname%/
/* function dms_wptai_set_permalink_postname() {
	
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
    
} */ // end of dms_wptai_set_permalink_postname() function.


// remove hello world and akismet plugins
function dms_wptai_delete_plugins() {
	
    $plugins = array( 'hello.php', 'akismet/akismet.php' );
	delete_plugins( $plugins );
	
} // end of dms_wptai_delete_plugins function.

// Disable comments and trackbacks
function dms_wptai_disable_comments_and_pings() {

	// Disable pings
	if( '' != get_option( 'default_ping_status' ) ) {
		update_option( 'default_ping_status', '' );
	} // end if

	// Disable comments
	if( '' != get_option( 'default_comment_status' ) ) {
		update_option( 'default_comment_status', '' );
	} // end if

} // end dms_wptai_disable_comments_and_pings() function.


// Delete wp-config-sample.php file
function dms_wptai_delete_config_sample_file() {
	
	$url_config_sample = "wp-config-sample.php";
	$abspath=$_SERVER['DOCUMENT_ROOT'];
	$file_url = $abspath . '/' . $url_config_sample;
	if (file_exists($file_url)) {
	    unlink($file_url);
	}

} // end of dms_wptai_delete_config_sample_file() function.

// Delete readme.html file
function dms_wptai_delete_readme_html_file() {
	
	$url_readme_html = "readme.html";
	$abspath=$_SERVER['DOCUMENT_ROOT'];
	$file_url = $abspath . '/' . $url_readme_html;
	if (file_exists($file_url)) {
	    unlink($file_url);
	}

} // end of dms_wptai_delete_readme_html_file() function.


// Remove unactivated themes
// function dms_wptai_delete_themes() {

// 	// The current themes.
// 	$installed_themes = wp_get_themes();

// 	// The themes we want to keep (delete the others).
// 	$theme_data = wp_get_theme();
// 	$current_theme = $theme_data->get( 'dms_theme' );

// 	$themes_to_keep = array( $current_theme );

// 	// Loop through installed themes.
// 	foreach ( $installed_themes as $theme ) {

// 		// The name of the theme.
// 		$name = $theme->get_template();

// 		// If it's not one we want to keep...
// 		if ( ! in_array( $name, $themes_to_keep ) ) {
// 			$stylesheet = $theme->get_stylesheet();

// 			// Delete the theme.
// 			delete_theme( $stylesheet, false );
// 		}
// 	} // end of foreach - themes
	
// } // end of dms_wptai_delete_themes() function.






/**
 * *****************************************************************************
 * Theme admin debug
 * *****************************************************************************
 */
if (DEBUG_ADMIN) {
	if (!function_exists('debug_admin_menus')):
		function debug_admin_menus() {
			if ( !is_admin())
				return;
			global $submenu, $menu, $pagenow;
			if ( current_user_can('manage_options') ) {
				if( $pagenow == 'index.php' ) {
					echo '<pre>'; print_r( $menu ); echo '</pre>';
					echo '<pre>'; print_r( $submenu ); echo '</pre>';
				}
			}
		}
		add_action( 'admin_notices', 'debug_admin_menus' );
	endif;
}

/**
 * *****************************************************************************
 * Enqueue scripts and styles
 * *****************************************************************************
 */
function custom_admin_enqueue_scripts() {

	wp_enqueue_style( 'font-awesome', 		ASSETS_DIRECTORY . "/bower_components/font-awesome/css/font-awesome.min.css"  );

	// CUSTOM ADMIN JS
	wp_enqueue_script( 'custom-admin-js', 	JS_DIRECTORY . "/min/custom-admin.min.js", array( 'jquery', 'jquery-ui-tabs', 'jquery-ui-datepicker' ), '', true );
	
}
add_action ( 'admin_enqueue_scripts', 'custom_admin_enqueue_scripts' );

function custom_wp_enqueue_scripts() {

	global $developers;

	// CSS
	
	// NORMALIZE CSS
	// wp_enqueue_style( 'normalize', 		ASSETS_DIRECTORY . "/bower_components/normalize-css/normalize.css" );

	// ANIMATE CSS
	// wp_enqueue_style( 'animate', 		ASSETS_DIRECTORY . "/bower_components/animate.css/animate.min.css" );

	// FONT AWESOME CSS
	// wp_enqueue_style( 'font-awesome', 	ASSETS_DIRECTORY . "/bower_components/font-awesome/css/font-awesome.min.css" );

	// SWIPER CSS
	// wp_enqueue_style( 'swiper', 		ASSETS_DIRECTORY . "/bower_components/Swiper/dist/css/swiper.min.css" );

	// STYLE CSS
	wp_enqueue_style( 'style', 			get_template_directory_uri() . "/style.css" );

	// BASE CSS
	wp_enqueue_style( 'base', 			CSS_DIRECTORY . "/base.css", false, filemtime( SERVER_CSS_DIRECTORY . "/base.css" ) );

	// DEVS CSS
	foreach ($developers as $developer => $active) {

		if($active){

			$string_css = "/sass-" . $developer . "/" . $developer . ".css";

			// CURRENT DEV CSS
			wp_enqueue_style( $developer, 			CSS_DIRECTORY . $string_css, false, filemtime( SERVER_CSS_DIRECTORY . $string_css ) );

		}

	}



	// JS

	// SWIPER JS
	// wp_enqueue_script( 'swiper',  		ASSETS_DIRECTORY . '/bower_components/Swiper/dist/js/swiper.jquery.min.js', array('jquery'), false, true);

	// PARALLAX JS - IS ACTIVE PARALLAX SCENE
	if(ACTIVE_PARALLAX_SCENE){

		wp_enqueue_script( 'parallax', 		ASSETS_DIRECTORY . '/bower_components/parallax/deploy/parallax.min.js', array('jquery'), false, true);

	}

	// CUSTOM JS
	wp_enqueue_script( 'custom', 		JS_DIRECTORY . "/min/custom.min.js", array( 'jquery' ), filemtime( SERVER_JS_DIRECTORY . "/min/custom.min.js" ), true ); 

	// GET TEXT OF POPUP LEGAL ADVICE IN CONTACT
	$id_page_legal_advice = 20;
	$current_post_legal_advice = get_post($id_page_legal_advice);
	$dms_legal_advice_content_in_popup = apply_filters( 'the_content', $current_post_legal_advice->post_content );

	if(empty($dms_legal_advice_content_in_popup)) $dms_legal_advice_content_in_popup = "content default functions.php";


	// CUSTOM DATA
	$custom_data = array(
		'dms_ajax_url'						=> admin_url(  'admin-ajax.php' ),
		'dms_legal_advice_content_in_popup' => $dms_legal_advice_content_in_popup
	);

	// SEND CUSTOM DATA TO CUSTOM JS
	wp_localize_script( 'custom', 'custom_data', $custom_data );

}

add_action ( 'wp_enqueue_scripts', 'custom_wp_enqueue_scripts' );

/**
 * *****************************************************************************
 * Register menus
 * *****************************************************************************
 */
if (! function_exists ( 'custom_navigation_menus' )) :
	function custom_navigation_menus() {
		$locations = array(
				'header_menu' 		=> __( 'Header Menu', THEME_NAME ),
				'header_menu_alt' 	=> __( 'Header Menu Alternative', THEME_NAME ),
				'footer_menu' 		=> __( 'Footer Menu', THEME_NAME ),
				'footer_menu_alt' 	=> __( 'Footer Menu Alternative', THEME_NAME ),
		);
		register_nav_menus( $locations );
	}
	add_action ( 'init', 'custom_navigation_menus' );
endif;
/**
 * *****************************************************************************
 * Register sidebars
 * *****************************************************************************
 */
if (! function_exists ( 'custom_sidebars' )) {
	function custom_sidebars() {
		register_sidebar( array(
	        'name' => __( 'Blog Sidebar', THEME_NAME ),
	        'id' => 'dms-sidebar-custom',
	        'description' => __( 'Widgets in this area will be shown on all posts and pages.', THEME_NAME ),
	        'before_widget' => '<div id="%1$s" class="sidebar-block %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="sidebar-title">',
			'after_title'   => '</h3>',
	    ) );
	}
	add_action ( 'widgets_init', 'custom_sidebars' );
}

/**
 * *****************************************************************************
 * Optimice title page
 * *****************************************************************************
 */
function custom_wp_title() {

	// DEFAULT
	if (empty ( $title ) && is_home ()) {
		return get_bloginfo ( 'title' ) . ' | ' . get_bloginfo ( 'description' ) ;
	}
	if (is_front_page ()) {
		return get_bloginfo ( 'title' ) . ' | ' . get_bloginfo ( 'description' ) ;
	}
	$title = get_the_title();
	if(!!$title) return $title . ' | ' . get_bloginfo ( 'title' );

	return get_bloginfo ( 'title' ) . ' | ' . get_bloginfo ( 'description' ) ;
	
}

add_filter('pre_get_document_title', 'custom_wp_title');

/**
 * *****************************************************************************
 * Customize wp_head function; add google analytics, facebook, twitter api, etc
 * *****************************************************************************
 */
function custom_wp_head() {
	
	$google_analytics = get_field("theme_settings_general__google_analytics", "option");

	if($google_analytics){
		?>
		<!-- [google_analytics] begin -->

		<?php echo $google_analytics; ?>
		
		<!-- [google_analytics] end -->
		<?php
	}
	
}
add_action ( 'wp_head', 'custom_wp_head' );

/**
 * *****************************************************************************
 * Excerpt Lenght
 * *****************************************************************************
 */
function custom_excerpt_length($length) {
	return 40;
}
// add_filter ( 'excerpt_length', 'custom_excerpt_length', 99 );

/**
 * *****************************************************************************
 * Contact form 7 hook
 * *****************************************************************************
 */
function wpcf7_before_send_mail($contact_form) {
	global $dms_emails;
	
	$mail = $contact_form->prop( 'mail' );
	
	$body = $mail['body'];
	$mail['body'] = $dms_emails->get_html_body($mail['body']);
	
	$contact_form->set_properties( array( 'mail' => $mail ) );
}
add_action('wpcf7_before_send_mail', 'wpcf7_before_send_mail');

/**
 * *****************************************************************************
 * Translation functions
 * *****************************************************************************
 */
function dms_get_default_language() {
	return get_option( 'qtranslate_default_language' );
}
function dms_get_current_language(){
	global $q_config;
	return qtrans_getLanguage();
}
// Function to get url for a determinate language.
function dms_get_url_for_language( $original_url, $lang = null ) {
	global $wpdb, $qtranslate_slug;
	if (is_null($lang)) {
		$lang = qtrans_getLanguage();
	}

	// Search original url in post metadata
	$post_id = null;
	$default_lang = dms_get_default_language();
	$wpdb->query("SELECT `post_id`, `meta_value` FROM $wpdb->postmeta WHERE `meta_key` = '_qts_slug_$default_lang'");
	foreach($wpdb->last_result as $row) {
		if ($row->meta_value == ltrim($original_url, '/') ) {
			$post_id = $row->post_id;
			break;
		}
	}

	if ($post_id == null) {
		return $qtranslate_slug->home_url();
	} else {
		$url = get_site_url();
		if ($lang != $default_lang) {
			$url .= "/" . $lang;
		}
		$url .= "/" . $qtranslate_slug->get_slug($post_id, $lang);
		return $url;
	}

	return $original_url;
}

/**
 * *****************************************************************************
 * Woocommerce Functions
 * *****************************************************************************
 */
if(class_exists('woocommerce')) :
	add_filter( 'product_type_selector', 'remove_product_types' );
	function remove_product_types( $types ){
		return $types;
	}

	function get_country_selector($select_name, $default = "") {
		$countries_obj   = new WC_Countries();
		$countries   = $countries_obj->__get('countries');
		woocommerce_form_field($select_name, 
				array(
						'type'       => 'select',
						'options'    => $countries,
						'default'    => $default,
				)
		);
	}

	// Custom extension woocommerto to put a checkout wrap
	function woocommerce_checkout_wrap() {
		get_template_part( "template-parts/woocommerce-checkout", "wrap" );
	}
	add_action( 'woocommerce_checkout_wrap', 'woocommerce_checkout_wrap' );

	// Separate order review from checkout payments.
	//remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
	//add_action('woocommerce_checkout_payment', 'woocommerce_checkout_payment');

	// Function product is complete
	function dms_custom_payment_complete($order_id) {

	}
	add_action("woocommerce_payment_complete", 'dms_custom_payment_complete');
endif;

/**
 * *****************************************************************************
 * Custom Functions
 * *****************************************************************************
 */

// function to check if device is a mobile.
function is_mobile() {
	return (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
			'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
			'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
}

// function to add classes in body of browser and OS
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_edge, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	elseif($is_edge) $classes[] = 'edge';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';


	if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
		$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
		$classes[] = 'windows';
	}

	// IS RENDER WEBKIT
	if( preg_match('/webkit/', strtolower($_SERVER['HTTP_USER_AGENT']) ) ) { 
	    $classes[] = 'webkit'; 
	}

	if(is_mobile()) $classes[] = 'is_mobile';

	return $classes;
}
add_filter('body_class','browser_body_class');



// Function to send custom email
function dms_send_email($subject, $email_to, $html_content) {
	global $dms_emails;
	$dms_emails->send($subject, THEME_TITLE, FROM_EMAIL, BCC_EMAIL, $email_to, $html_content);
}

function my_remove_meta_boxes() {
	// if( !current_user_can('manage_options') ) {
		// remove_meta_box('qtranxs-meta-box-lsb', 'page', 'normal');
		// remove_meta_box('qtranxs-meta-box-lsb', 'page', 'advanced');
		// remove_meta_box('qtranxs-meta-box-lsb', 'page', 'side');
	// }
}
// add_action( 'admin_menu', 'my_remove_meta_boxes', 999 );


// EDIT COLUMNS BACKEND CPT


// NECCESARY FOR REPLACE [:es] IN BACKEND IN TAXS COLUMNS
// add_filter('manage_edit-service_columns', 'add_new_service_columns');
// function add_new_service_columns($columns) {
// 	$new_columns['cb'] = $columns['cb'];
// 	$new_columns['title'] = $columns['title'];
// 	$new_columns['language'] = $columns['language'];
// 	$new_columns['service_type'] = __("Services type", THEME_NAME);
// 	$new_columns['date'] = $columns['date'];

// 	return $new_columns;
// }

// NECCESARY FOR REPLACE [:es] IN BACKEND IN TAXS COLUMNS
// add_action('manage_service_posts_custom_column', 'manage_service_columns', 10, 2);
// function manage_service_columns($column_name, $id) {
// 	global $wpdb;
// 	switch ($column_name) {
// 		case 'service_type':
// 			// Get taxonomies asociated to this post
// 			$str = "";
// 			foreach(get_the_terms($id, "service_type") as $term) {
// 				$str .= '<a href="' . site_url() . "/wp-admin/edit.php?post_type=service&service_type=" . $term->slug . '">' . $term->name . '</a>, ';
// 			}
// 			echo rtrim($str, ", ");
// 			break;
// 		default:
// 			break;
// 	}
// }

// DISPLAY CORRECTLY TAXS IN BACKEND
add_filter( 'wp_terms_checklist_args', 'checked_not_ontop', 1, 2 );
function checked_not_ontop( $args, $post_id ) {

	// IF NEED SPECIFICATION
    if ( 'cpt' == get_post_type( $post_id ) && $args['taxonomy'] == 'custom_tax' ) $args['checked_ontop'] = false;

    // DEFAULT
	$args['checked_ontop'] = false;

    return $args;

}


// DETERMINE THE TOP MOST PARENT OF A TERM
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    // climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){
        $term_id = $parent->parent;

        $parent  = get_term_by( 'id', $term_id, $taxonomy);
    }
    return $parent;
}


// ADD CURRENT ITEMS IN NAV MENU IF CURRENT PAGE IS SINGLE-{CPT}
// add_action('nav_menu_css_class', 'add_current_nav_class_trip', 10, 2 );
	function add_current_nav_class_trip($classes, $item ) {

	// Necessary, otherwise we can't get current post ID
	global $post;

	// Grabs the terms from the current post
	$page_tax_terms = wp_get_object_terms($post->ID, 'custom_tax');

	// Grabs the term object that was returned by wp_get_object_terms()
	$page_tax = $page_tax_terms[0];

	// Grabs the post type of the current post
	$page_post_type = get_post_type();

	// Grabs the Description of the current menu item, trims whitespace
	$item_desc = trim($item->description);

	// Do the magic...
	if ($item_desc != '' && (($item_desc == $page_post_type) || ($item_desc == $page_tax->name))) {
	       $classes[] = 'current-menu-item';
	};

	// Return the corrected set of classes to be added to the menu item
	return $classes;
}

class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {

        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
        
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        global $post;
        global $term;

        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        // DMS
		$needleAncestorCPT     	= "ancestor-cpt";

		// ADD DINAMICALLY CLASSES HAS CHILDREN IN ANCESTOR, IF EXIST MENU
		if($item->classes){

			if ( in_array($needleAncestorCPT, $item->classes) ){
        	
	        	if(is_singular("cpt")){

	        		$classes[] = " current-menu-item";

	        	}

	        }

		}

        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="nav-item ' . $depth_class_names . ' ' . $class_names . '">';

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $current_title = apply_filters( 'the_title', $item->title, $item->ID );

        if ( $item->object == "page" ) {

        	$current_title = get_the_title($item->object_id);

        }

        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            $current_title,
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

} 

// DEBUG PHP - DATA TO BROWSER CONSOLE
function debug_to_console($data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
}

// DEBUG IN HTML
function dump($var){

	echo "<!-- <pre>" . var_dump($var) . "</pre>  -->";
	
}


// RETURN FORMATTED DATE
function dms_format_date($date, $format){
	// extract Y,M,D
	$y = substr($date, 0, 4);
	$m = substr($date, 4, 2);
	$d = substr($date, 6, 2);

	// create UNIX
	$time = strtotime("{$d}-{$m}-{$y}");

	// return format date
	return date($format, $time);
}

/**
 * *****************************************************************************
 * Custom user meta fields
 * *****************************************************************************
 */

function dms_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';
//add Instagram
$contactmethods['instagram'] = 'Instagram';
//add Address
$contactmethods['address'] = 'Dirección';
//add City
$contactmethods['city'] = 'Ciudad';
//add Province
$contactmethods['province'] = 'Provincia';
//add Phone
$contactmethods['phone'] = 'Teléfono';
 
return $contactmethods;
}
add_filter('user_contactmethods','dms_new_contactmethods',10,1);



/**
 * *****************************************************************************
 * ACF Predefined Fields
 * *****************************************************************************
 */



/**
 * *****************************************************************************
 * Theme custom functions
 * *****************************************************************************
 */

function hwl_home_pagesize( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_category() ) {
        // Display only 1 post for the original blog archive
        $query->set( 'posts_per_page', DMS_POST_PER_PAGE );
        return;
    }

}
// add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );



function custom_pagination_base() {
	global $wp_rewrite;

  	// Translate
	$wp_rewrite->pagination_base = __("page", THEME_NAME);

	$wp_rewrite->flush_rules();

}
add_action( 'init', 'custom_pagination_base', 1 );


function dms_search_multidimensional_array($array, $field, $value){

    foreach($array as $row) {

       if($row->$field == $value) return $row;

    }

    return NULL;
    
}

/*

RETURN STRING ONLY VALUE OF CURRENT LANG

STRING: 	[:lang1]lorem ipsum current-lang[:lang2]lorem ipsum another-lang[:]
RETURN:  	lorem ipsum current-lang

*/
function dms_qtranslate_items_name($item) {
	if(function_exists(qtranxf_use) && function_exists(qtrans_getLanguage)){
		if (is_array($item)) {
			foreach ($item as $value ) {
				if(is_array($value)){
					$value['name'] = qtranxf_use(qtrans_getLanguage(), $value['name'], false); 
				}else if(is_object($value)){
					$value->name = qtranxf_use(qtrans_getLanguage(), $value->name, false); 
				}
			}
		} else {
			$item = qtranxf_use(qtrans_getLanguage(), $item, false);
		}
	}
	return $item;
}
add_filter('get_terms', 'dms_qtranslate_items_name', 10, 1);
add_filter('get_the_terms', 'dms_qtranslate_items_name', 10, 1);
add_filter('the_title', 'dms_qtranslate_items_name', 10, 1);

// REMOVE SHOW ADMIN BAR
add_filter('show_admin_bar', '__return_false', 100);

function dmsBreakLines($content){

	$content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content;

} 

// custom filter to replace '=' with 'LIKE'
function cpt_offer_subfield_search( $where )
{
	$slugField 		= "cpt_event_repeater_dates";
	$slugSubField 	= "cpt_event_repeater_dates_subfield_offer_check";
	$where = str_replace("meta_key = '" . $slugField . "_%_" . $slugSubField . "'", "meta_key LIKE '" . $slugField . "_%_" . $slugSubField . "'", $where);
 
	return $where;
}
// add_filter('posts_where', 'cpt_offer_subfield_search');


// DMS - CONTACT FORM 7
// NO PRINT CONTENT IN <span>[_your-field] YOUR FIELD: [your-field][_your-field]</span>
// IF NOT EXIST [your-field]
add_filter( 'wpcf7_special_mail_tags', 'empty_field_characters',10,2);
function empty_field_characters( $output,$name ) {
	$name=trim(ltrim($name,'_'));
	if(empty($_POST[$name])){
		$output='{}';
	} else $output=' ';
	return $output;
}
//filter to remove any p tags that contain the special characters for an empty field</p>
add_filter( 'wpcf7_mail_components', 'remove_blank_lines' );
function remove_blank_lines( $mail ) {
	if ( is_array( $mail ) && ! empty( $mail['body'] ) )
		$mail['body'] = preg_replace('/<span\b[^>]*>{}(.*?){}<\/span>/i', '', $mail['body'] );
	return $mail;
}


// ACTION AFTER GET HEADER
// add_action ( 'dms_get_header_after', 'dms_open_main' );
function dms_open_main($classes = ""){

	$classesAnimationSection 	= " fadeIn animated dms-animated--level-2";

	?>
    	<main class="dms-site-content <?php echo $classesAnimationSection . " " . $classes; ?>">
	<?php

}


// ACTION BEFORE GET FOOTER
// add_action ( 'get_footer', 'dms_close_main' );
function dms_close_main(){

	?>
		</main>
	<?php
	
}



function dmsMenuDesktopType($active = true){

	/*

		0.1.0 DMS MENU TYPE

		DISPLAY SUBMENU WITH ANIM CSS, ONLY 1 SUBMENU LEVEL ACTUALLY

		$parent_class 	= "nav";			// REQUIRED nav 							IS REQUIRED WITH NAME NAV, TARGET CLASS IN CSS
		$display_type 	= "inline"; 		// inline / vertical  						DISPLAY MENU HORIZONTAL(INLINE) OR VERTICAL
		$submenu_init 	= "left";			// left / auto    							DISPLAY SUBMENU LEFT 0 OF MENU-DEPTH-0, INIT AUTO =  INIT LEFT 0 OF MENU-ITEM-DEPTH-0
		$type_menu 		= "menu-1"			// menu-1, menu-2, menu-3, menu-4, menu-5.	SUBMENU ANIMATION TYPE

	*/

	if(!$active) return "";

	if(class_exists('acf')){

		$display_type 	= get_field("theme_settings_header__header_menu_display_type", "option");
		$submenu_init 	= get_field("theme_settings_header__header_menu_position", "option");
		$type_menu 		= get_field("theme_settings_header__header_menu_animation_type", "option");

	}

	if(empty($display_type)) 	$display_type 	= "inline";
	if(empty($submenu_init)) 	$submenu_init 	= "left";
	if(empty($type_menu)) 		$type_menu 		= "menu-1";

	// OPTIONS
	$parent_class 	= "nav";

	// CREATE CLASSES
	$display_type 	= $parent_class . "--" . $display_type;
	$submenu_init 	= $parent_class . "--" . "init-" . $submenu_init;
	$type_menu    	= $parent_class . "--" . $type_menu;

	$classes 		= $parent_class . " " . $display_type . " " . $submenu_init . " " . $type_menu;

	return $classes;
	
}

// CHANGE MAIL FROM IN SEND WP_MAIL
add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email ){
    return $email;
}
// CHANGE NAME FROM IN SEND WP_MAIL
add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name ){
    return $name;
}

add_action( 'wp_ajax_dms_ajax_more_posts', 'dms_ajax_more_posts_callback' );
add_action( 'wp_ajax_nopriv_dms_ajax_more_posts', 'dms_ajax_more_posts_callback' );
function dms_ajax_more_posts_callback() {

	dms_load_ajax_posts();

}

/**
 * Prints next page of posts on ajax load more action
 * @return html Complete posts container and data
 */
function dms_load_ajax_posts() {

	$next_page 		= ( $_POST['paged'] ) 	? $_POST['paged'] : 2;
	
	$post_type 		= ( $_POST['post_type'] ) 	? $_POST['post_type'] : 'post';

	$query_vars 	=  array(
							'post_type' => 'post',
							'posts_per_page' => 6,
							'paged' => 2
						);

	$query_vars["paged"] = $next_page;

	$query_vars["post_type"] = $post_type;

	$query = new WP_Query( $query_vars );

	$found_posts = $query->found_posts;

	$max_num_pages = $query->max_num_pages;

	$ajax_status 	= 200;
	$html 			= "";
	$debug 			= ""; // VAR FOR DEBUG AND SEE IN JS
	$confirm        =false;
    if ( $query->have_posts() ) {

    	ob_start();

        $m = 0;

		// Start the loop.
		while ( $query->have_posts() ) : $query->the_post();

			switch ($post_type) {
				case 'post':
					include(locate_template('template-parts/template-part-loop-post.php'));
					break;
				case 'news':
					include(locate_template('template-parts/template-part-loop-news.php'));
					$confirm=true;
					break;
				
				default:
					include(locate_template('template-parts/template-part-loop-post.php'));
					break;
			}

			$m++;

		endwhile;
		// End the loop.

		$html = ob_get_contents();

		ob_end_clean();

    } else {

        $ajax_status = 600; // NO POSTS

    }

	if( $max_num_pages <= $next_page ) $ajax_status = 601; // NO NEXT PAGE OF POSTS FOR THIS QUERY

	echo json_encode( array('ajax_status' => $ajax_status, 'html' => $html, 'debug' => $debug,'type'=>$post_type,'confirm'=>$confirm ) );

	/* Restore original Post Data */
    wp_reset_postdata();

	exit;

}

/**
 * Print custom button used in ajax load more action
 * @param  WP_Query  	$query   	Query object in which load more action is required
 * @param  string  		$classes 	Extra classes to apply to the button
 * @return html          			Full button html
 */
function dms_print_load_more_button( $query, $classes = "" ){

	$next_page = 2;
	$query_vars = $query->query_vars;

	if( $query->max_num_pages > $next_page ){
		?>
			<div class="dms-block-content-button-ajax__button js-dms-ajax-more-posts__button <?php echo $classes; ?>"
				data-paged='<?php echo $next_page; ?>'
				data-query='<?php echo json_encode( $query_vars, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>'
			>
				<span class="dms-block-content-button-ajax__text"><?php _e("See more", THEME_NAME); ?></span>
			</div>
		<?php
	}

}


// DEBUG ONLY FOR AUTHOR DMS
function dms_dump($var){

	$current_user = wp_get_current_user();

	if ( DMS_USER_ID == $current_user->ID ) {

	    // ONLY AUTHOR DMS
	    var_dump($var);
	    
	}

}

// DEBUG ONLY ACCES FOR AUTHOR DMS
function dms_only_access(){

	$current_user = wp_get_current_user();

	if ( DMS_USER_ID != $current_user->ID ) {

		// IF USER LOGGED IS NOT AUTHOR DMS
	    wp_redirect(site_url());
		exit;
	    
	}

}

// DISABLE NOTIFICATIONS FOR THEMES, WP CORE AND PLUGINS
function remove_core_updates(){

	global $wp_version;
	return(object) array('last_checked'=> time(), 'version_checked'=> $wp_version);

}

// ONLY DISABLE IF USER IS NOT DMS
function dms_disable_update_notifications(){

	$current_user = wp_get_current_user();

	if ( DMS_USER_ID != $current_user->ID ) {

		add_filter('pre_site_transient_update_core', 'remove_core_updates');
		add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
		add_filter('pre_site_transient_update_themes', 'remove_core_updates');

	}

}
add_action('after_setup_theme', 'dms_disable_update_notifications');

// DISABLE AUTOMATIC UPDATER WP
add_filter( 'automatic_updater_disabled', '__return_true' );


// Our filter callback function
add_filter( 'cn_cookie_notice_output', 'dms_cookie_notice', 10, 3 );
function dms_cookie_notice($output, $options ) {

    // message output

    $frontpage_ID 	= get_option('page_on_front');
    $text_cookie_notice = get_field("page_template_home_text_cookie", $frontpage_ID);
    $button_text = get_field("page_template_home_text_button_cookie", $frontpage_ID);

    if(!$text_cookie_notice) 
    	$text_cookie_notice = __( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', THEME_NAME );

    if(!$button_text) $button_text = __('I agree.', THEME_NAME);
	
	$output = '
	<div id="cookie-notice" class="cn-' . ($options['position']) . ($options['css_style'] !== 'none' ? ' ' . $options['css_style'] : '') . '" style="color: ' . $options['colors']['text'] . '; background-color: ' . $options['colors']['bar'] . ';">'
		. '<div class="cookie-notice-container"><span id="cn-notice-text">'. $text_cookie_notice . '</span>'
		. '<a href="#" id="cn-accept-cookie" data-cookie-set="accept" class="cn-set-cookie button' . ($options['css_style'] !== 'none' ? ' ' . $options['css_style'] : '') . '">' . $button_text . '</a>'
		. ($options['refuse_opt'] === 'yes' ? '<a href="#" id="cn-refuse-cookie" data-cookie-set="refuse" class="cn-set-cookie button' . ($options['css_style'] !== 'none' ? ' ' . $options['css_style'] : '') . '">' . $button_text . '</a>' : '' )
		. ($options['see_more'] === 'yes' ? '<a href="' . ($options['see_more_opt']['link_type'] === 'custom' ? $options['see_more_opt']['link'] : get_permalink( $options['see_more_opt']['id'] )) . '" target="' . $options['link_target'] . '" id="cn-more-info" class="button' . ($options['css_style'] !== 'none' ? ' ' . $options['css_style'] : '') . '">' . $button_text . '</a>' : '') . '
		</div>
	</div>';

    return $output;

}

// CHECK IF STRING CONTAINS SUBSTRING
// RETURN FALSE / TRUE
function dms_string_contains_substring($str, $substr){

	if (strpos($str, $substr) !== false) return true;
	return false;

}

// RETURN FIRST SRC IMAGE OF CONTENT
function dms_get_first_src_image_of_content($content){

	preg_match( '@src="([^"]+)"@' , $content, $match );
	$src = array_pop($match);

	// example return: /path/image.jpg
	if($src) return $src;
	return "";

}

// RETURN IMAGES OF CONTENT
function dms_get_url_images_of_content($content){

	preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $match);
	if($match) return $match[3];
	return false;

}

// EXAMPLE USAGE: $page_id = dms_get_page_id_by_template('templates/dms-template-contact.php');
// RETURN FIRST ID PAGE WITH TEMPLATE $slug_template
function dms_get_page_id_by_template($slug_template){

	// SLUG TEMPLATE EXAMPLE: templates/dms-template-contact.php

	// GET PAGES
	$args = [
	    'post_type' => 'page',
	    'fields' => 'ids',
	    'nopaging' => true,
	    'meta_key' => '_wp_page_template',
	    'meta_value' => $slug_template
	];
	$pages = get_posts( $args );
	if(is_array($pages) && count($pages)>0) return $pages[0];
	return false;

}

add_action( 'admin_head', 'hide_editor' );
function hide_editor() {

    global $pagenow;
    if( !( 'post.php' == $pagenow ) ) return;

    global $post;

    // $template_file = basename( get_page_template() );

    // switch ($template_file) {

    // 	case 'dms-template-home.php':
    // 		remove_post_type_support('page', 'editor');
    // 		remove_meta_box( 'postimagediv','page','side' );

    // 		break;
    	
    // 	default:
    // 		# code...
    // 		break;
    // }

}

function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

// Breadcrumbs
function dms_custom_breadcrumbs( $separator = '&gt;', $breadcrums_id = 'dms-breadcrumbs', $breadcrums_class  = 'dms-breadcrumbs', $home_title = false) {

	if(empty($home_title)) $home_title = get_the_title(get_option('page_on_front'));
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {


			$current_term = get_queried_object();

        	if($current_term->parent != 0){

        		$parent = get_term_by('term_id', $current_term->parent, 'category');
        		$cat_id         = $parent->term_id;
                $cat_nicename   = $parent->slug;
                $cat_link       = get_term_link($parent->term_id, 'category');
                $cat_name       = $parent->name;

        		// Parent term
        		echo '<li class="item-cat"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
        		// Separator
        		echo '<li class="separator"> ' . $separator . ' </li>';

        		// Category page child (current)
            	echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

        	}else{

        		// Category page parent
            	echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

        	}
               
            
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}

function mytheme_comment($comment, $args, $depth) {

    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    
    ?>
    <?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', THEME_NAME ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'),
            qtranxf_use(qtrans_getLanguage(), get_comment_date("j F, y"), false),
            qtranxf_use(qtrans_getLanguage(), get_comment_time("H:i"), false)
        ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );

        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php

}


/**
 * *****************************************************************************
 * Custom post types
 * *****************************************************************************
 */

if ( ! function_exists('dms_theme_post_type') ) {
	function dms_theme_post_type() {

		// Create custom post types


		// flush_rewrite_rules();
		
	}
	add_action( 'init', 'dms_theme_post_type', 0 );
}


// CUSTOM SELECT DMS
// HOW TO USE - IN TEMPLATE
// $args = array(
// 	"first_label" => __("Postal code", THEME_NAME),
// 	"first_value" => "all",
// 	"options" => array(
// 		array(
// 			"label" => "the_label_1",
// 			"value" => "the_value_1",
// 		),
// 		array(
// 			"label" => "the_label_2",
// 			"value" => "the_value_2",
// 		)
// 	)
// );
// $custom_classes = "custom_classes"
// dms_custom_select($args, $custom_classes);
// END HOW TO USE
function dms_custom_select($args = array(), $custom_classes = ""){

	if(!!$args){

		$args['first_label'] = !!$args['first_label'] ? $args['first_label'] : __("All", THEME_NAME);
		$args['first_value'] = !!$args['first_value'] ? $args['first_value'] : "all";
		$args['options'] = !!$args['options'] ? $args['options'] : false;

		if($args['options']){

			?>
				<div class="js-dms-custom-select dms-custom-select <?php echo $custom_classes; ?>" tabindex="1" data-value="<?php echo $args['first_value']; ?>" data-label="<?php echo $args['first_label']; ?>">
					<span><?php echo $args['first_label']; ?></span>
					<ul class="js-dms-custom-select__dropdown dms-custom-select__dropdown">
						<li data-label="<?php echo $args['first_label']; ?>" data-value="<?php echo $args['first-value']; ?>">
							<a href="#"><?php echo $args['first_label']; ?></a>
						</li>
						<?php
							
							foreach($args['options'] as $current_option){
								// VARS
								$the_label 		= $current_option["label"];
								$the_value 		= $current_option["value"];
								if(!$the_value) $the_value = $the_label;
								?>
									<li data-label="<?php echo $the_label; ?>" data-value="<?php echo $the_value; ?>">
										<a href="#"><?php echo $the_label; ?></a>
									</li>
								<?php
							}
							
						?>
					</ul>
				</div>
			<?php

		}

	}else{
		?> <div>select - no options</div> <?php
	}

}

// SECURITY - BLOCK ACCESS TO URL AUTHOR PARAMETER
if (!is_admin()) {
	// default URL format
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2); } function shapeSpace_check_enum($redirect, $request) {
	// permalink URL format
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}

// LOGIN ERROR MESSAGE
function login_error_message($error){

    //its the right error so you can overwrite it
    $error = __("Wrong information", THEME_NAME);
    return $error;

}
add_filter('login_errors','login_error_message');




//Minify HTML for WordPress without a Plugin

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
   	 {
   		 $this->parseHTML($html);
   	 }
    }
    public function __toString()
    {
   	 return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
   	 $raw = strlen($raw);
   	 $compressed = strlen($compressed);
   	 
   	 $savings = ($raw-$compressed) / $raw * 100;
   	 
   	 $savings = round($savings, 2);
   	 
   	 return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
   	 $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
   	 preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
   	 $overriding = false;
   	 $raw_tag = false;
   	 // Variable reused for output
   	 $html = '';
   	 foreach ($matches as $token)
   	 {
   		 $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
   		 
   		 $content = $token[0];
   		 
   		 if (is_null($tag))
   		 {
   			 if ( !empty($token['script']) )
   			 {
   				 $strip = $this->compress_js;
   			 }
   			 else if ( !empty($token['style']) )
   			 {
   				 $strip = $this->compress_css;
   			 }
   			 else if ($content == '<!--wp-html-compression no compression-->')
   			 {
   				 $overriding = !$overriding;
   				 
   				 // Don't print the comment
   				 continue;
   			 }
   			 else if ($this->remove_comments)
   			 {
   				 if (!$overriding && $raw_tag != 'textarea')
   				 {
   					 // Remove any HTML comments, except MSIE conditional comments
   					 $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
   				 }
   			 }
   		 }
   		 else
   		 {
   			 if ($tag == 'pre' || $tag == 'textarea')
   			 {
   				 $raw_tag = $tag;
   			 }
   			 else if ($tag == '/pre' || $tag == '/textarea')
   			 {
   				 $raw_tag = false;
   			 }
   			 else
   			 {
   				 if ($raw_tag || $overriding)
   				 {
   					 $strip = false;
   				 }
   				 else
   				 {
   					 $strip = true;
   					 
   					 // Remove any empty attributes, except:
   					 // action, alt, content, src
   					 $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
   					 
   					 // Remove any space before the end of self-closing XHTML tags
   					 // JavaScript excluded
   					 $content = str_replace(' />', '/>', $content);
   				 }
   			 }
   		 }
   		 
   		 if ($strip)
   		 {
   			 $content = $this->removeWhiteSpace($content);
   		 }
   		 
   		 $html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
   	 $this->html = $this->minifyHTML($html);
   	 
   	 if ($this->info_comment)
   	 {
   		 $this->html .= "\n" . $this->bottomComment($html, $this->html);
   	 }
    }
    
    protected function removeWhiteSpace($str)
    {
   	 $str = str_replace("\t", ' ', $str);
   	 $str = str_replace("\n",  '', $str);
   	 $str = str_replace("\r",  '', $str);
   	 
   	 while (stristr($str, '  '))
   	 {
   		 $str = str_replace('  ', ' ', $str);
   	 }
   	 
   	 return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');


/*
	Disable Default Dashboard Widgets
	@ https://digwp.com/2014/02/disable-default-dashboard-widgets/
*/
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	// wp..
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	// bbpress
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
	// yoast seo
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
	// gravity forms
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);


//Custom Dashboard Widgets in WordPress

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Soporte 📌', 'custom_dashboard_help');

}
 
function custom_dashboard_help() {

    $current_user = wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instanceof WP_User) )
     *     return;
     **/

	if ( is_user_logged_in () && ( $current_user->user_firstname ) ) { //usuario conectado que ha rellenado el campo de 	nombre en su perfil
	
		echo '<p>Bienvenid@ de nuevo ' . $current_user->user_firstname . '! 👋</br></p>
	
		<p> <strong>¿Necesitas ayuda?</strong></p>
	
		<p>Si es asi puedes contactar con nosotros desde <a href="mailto:info@deideasmarketing.com">aqui</a>.</p>
	
		<p><a href="https://deideasmarketing.com/" target="_blank">Deideas Marketing Solutions</a> </p>'
		 ; 
	}else { //usuario conectado que NO ha rellenado el campo de nombre en su perfil
	
		echo '<p>Bienvenid@ de nuevo ' . $current_user->user_login . '! 👋</br></p>
	
		<p> <strong>¿Necesitas ayuda?</strong></p>
	
		<p>Si es asi puedes contactar con nosotros desde <a href="mailto:info@deideasmarketing.com">aqui</a>.</p>
	
		<p><a href="https://deideasmarketing.com/" target="_blank">Deideas Marketing Solutions</a> </p>'
		 ; 
	}
}

//Change the Footer in WordPress Admin Panel

function remove_footer_admin () {
 
echo 'Design with ❤️ by <a href="https://deideasmarketing.com/" target="_blank">Deideas Marketing Solutions</a> | Contacto: <a href=mailto:info@deideasmarketing.com"" target="_blank">info@deideasmarketing.com</a> | &copy; 2018</p>';
 
}
 
add_filter('admin_footer_text', 'remove_footer_admin');

//Remove WordPress Version Number

function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');


//Custom Icon in admin dashboard

function wpb_custom_logo() {
echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
background-image: url(' . get_bloginfo('stylesheet_directory') . '/assets/images/favicon.ico) !important;
background-position: 0 0;
color:rgba(0, 0, 0, 0);
background-size: contain;
}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
background-position: 0 0;
}
</style>
';
}
 
//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');


/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );


//This function prints the JavaScript to the footer
function add_this_script_footer(){ ?>
 
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/gracias/';
}, false );
</script>
 
<?php } 
 
add_action('wp_footer', 'add_this_script_footer'); 


//Redirect to error page

// add_action( 'template_redirect', 'notFound' );

// function notFound()
// {
//     // check if is a 404 error
//     if( is_404())
//     {
//         // then redirect to yourdomain.com/error
//         wp_redirect( home_url( '/error/' ) );
//         exit();
//     }
// }


//Custom status post revisions

add_filter('display_post_states', 'custom_post_state');
function custom_post_state($states) {
  global $post;
  $show_custom_state = get_post_meta($post->ID, '_status');
  if ($show_custom_state) {
    $states[] = __('<span class="custom_state ' . strtolower($show_custom_state[0]) . '">' . $show_custom_state[0] . '</span>');
  }
  return $states;
}
add_action('post_submitbox_misc_actions', 'custom_status_metabox');
 
function custom_status_metabox() {
    global $post;
    $custom = get_post_custom($post->ID);
    $status = $custom["_status"][0];
    $i = 0;
    $estado = __( 'Custom status: ', THEME_NAME );
    /* ----------------------------------- */
    /*   Array of custom status messages            */
    /* ----------------------------------- */
    $custom_status = array('Ortografía ',' Revisión ',' Errores ',' Fuente ',' Rechazado ',' Final ', );
    echo '<div class="misc-pub-section custom">';
    echo '<label>' ,
     $estado;
    echo '</label><select name="status">';
    echo '<option class="default">',
    $estado;
    echo '</option>';
    echo '<option>-----------------</option>';
        for ($i = 0; $i < count($custom_status); $i++) {
        if ($status == $custom_status[$i]) {
            echo '<option value="' . $custom_status[$i] . '" selected="true">' . $custom_status[$i] . '</option>';
        } else { echo '<option value="' . $custom_status[$i] . '">' . $custom_status[$i] . '</option>'; }
    }
     
    echo '</select>';
    echo '<br /></div>';
}
add_action('save_post', 'save_status');
 
function save_status() {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post->ID;
    }
    update_post_meta($post->ID, "_status", $_POST["status"]);
}
add_action('admin_head', 'status_css');
 
function status_css() {
    echo '<style type="text/css">
    .default{font-weight:bold;}
    .custom{border-top:solid 1px #e5e5e5;}
    .custom_state{
    font-size:9px;
    color:#666;
    background:#e5e5e5;
    padding:3px 6px 3px 6px;
    -moz-border-radius:3px;
    }
    /* ----------------------------------- */
    /*   change color of messages below            */
    /* ----------------------------------- */
    .spelling{background:#4BC8EB;color:#fff;}
    .review{background:#CB4BEB;color:#fff;}
    .errors{background:#FF0000;color:#fff;}
    .source{background:#D7E01F;color:#333;}
    .rejected{background:#000000;color:#fff;}
    .final{background:#DE9414;color:#333;}
    </style>';
}
///test

function limit_text($text,$limit,$link) {
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		
		$pos = array_keys($words);
		$text = substr($text, 0, $pos[$limit]) . "<a href=".$link.">....</a>";
	}
	return $text;
}

function wp_trim_char($x, $length,$link){
	if(strlen($x)<=$length){
		return wp_strip_all_tags($x);
	}else{
		$y=substr(wp_strip_all_tags($x),0,$length+1) . "....";
		return $y;
	}
}

function get_the_image_post($id_post){
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($id_post),'single-post-thumbnail');
	return $image[0];
}

/* Post type projects */

if ( ! function_exists('theme_post_type_projects') ) {
	function theme_post_type_projects() {

		/*** CPT REFERENCES ***/

		$labels_projects = array(
				'name'                => _x( 'Projects', 'Post Type General Name', THEME_NAME ),
				'singular_name'       => _x( 'Projects', 'Post Type Singular Name', THEME_NAME ),
				'menu_name'           => __( 'Projects', THEME_NAME ),
				'parent_item_colon'   => __( 'Parent Projects:', THEME_NAME ),
				'all_items'           => __( 'All Projects', THEME_NAME ),
				'view_item'           => __( 'View Projects', THEME_NAME ),
				'add_new_item'        => __( 'Add New Projects', THEME_NAME ),
				'add_new'             => __( 'Add Project', THEME_NAME ),
				'edit_item'           => __( 'Edit Project', THEME_NAME ),
				'update_item'         => __( 'Update Projects', THEME_NAME ),
				'search_items'        => __( 'Search Projects', THEME_NAME ),
				'not_found'           => __( 'Not found', THEME_NAME ),
				'not_found_in_trash'  => __( 'Not found in Trash', THEME_NAME ),
		);
		$args_projects = array(
				'label'               => __( 'Projects', THEME_NAME ),
				'description'         => __( 'Projects', THEME_NAME ),
				'labels'              => $labels_projects,
				'supports'            => array( 'title', 'thumbnail', 'page-attributes','editor','custom-fields'),
				'taxonomies'          => array('category'),
				'hierarchical'        => false,
				'public' 			  => true,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queriable'  => false,  // you should be able to query it
				'show_ui' 			  => true,  // you should be able to edit it in wp-admin
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,  // you shouldn't be able to add it to menus
				'show_in_admin_bar'   => true,
				'menu_position'       => 56,
				'can_export'          => true,
				'has_archive' 		  => false,  // it shouldn't have archive page
				'exclude_from_search' => true,  // you should exclude it from search results
				'rewrite' 			  => true,  // it shouldn't have rewrite rules

				'capability_type'     => 'page',
				'menu_icon'           => 'dashicons-id-alt'
		);
	
		register_post_type( 'projects', $args_projects );

		/*** C-TAX PROPERTY TYPE ***/

		$labels_projects_type = array(
				'name'                       => _x( 'Project type', 'Taxonomy General Name', THEME_NAME ),
				'singular_name'              => _x( 'Project type', 'Taxonomy Singular Name', THEME_NAME ),
				'menu_name'                  => __( 'Project type', THEME_NAME ),
				'all_items'                  => __( 'All Projects type', THEME_NAME ),
				'parent_item'                => __( 'Parent Projects type', THEME_NAME ),
				'parent_item_colon'          => __( 'Parent Projects type:', THEME_NAME ),
				'new_item_name'              => __( 'New News type Name', THEME_NAME ),
				'add_new_item'               => __( 'Add New News type', THEME_NAME ),
				'edit_item'                  => __( 'Edit News type', THEME_NAME ),
				'update_item'                => __( 'Update News type', THEME_NAME ),
				'separate_items_with_commas' => __( 'Separate News type with commas', THEME_NAME ),
				'search_items'               => __( 'Search News type', THEME_NAME ),
				'add_or_remove_items'        => __( 'Add or remove News type', THEME_NAME ),
				'choose_from_most_used'      => __( 'Choose from the most used News type', THEME_NAME ),
				'not_found'                  => __( 'Not Found', THEME_NAME ),
		);
		$args_projects_type = array(
				'labels'                     => $labels_projects_type,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				// 'meta_box_cb'				 => false,
				'rewrite'                    => array( 
													'slug' => ("projects"),
													'with_front' => false,
													'hierarchical' => true 
												),
		);

		register_taxonomy( 'projects_type', array( 'projects' ), $args_projects_type );

	}
	
	add_action( 'init', 'theme_post_type_projects', 0 );
	
}

function archive_rewrite_rules() {

	$post_type="news"; // Espeficica el custom post type
	$taxonomy = 'news_type'; // Especifica la taxonomia 
	$terms = get_terms($taxonomy);

	/* Añade las nuevas reglas para cada categoria especificada en la taxonomia */
	foreach($terms as $term){
		/* var_dump($term->slug); */
		/* echo('^'.$term->slug.'/(.*)/?$'); */
		add_rewrite_rule(
			'^'.$term->slug.'/(.*)/?$',
			'index.php?post_type='.$post_type.'&name=$matches[1]',
			'top'
		);
	}
	
	/* Añade por defecto una regla para las categorias que no tengan una especificada */
    add_rewrite_rule(
        '^not-category/(.*)/?$',
        'index.php?post_type='.$post_type.'&name=$matches[1]',
        'top'
	);
	
	/* flush_rewrite_rules(); */ // use only once
}
add_action( 'init', 'archive_rewrite_rules' );


function gp_remove_cpt_slug( $post_link, $post ) {


	if ( ('reference' === $post->post_type ||'news' === $post->post_type) && 'publish' === $post->post_status ) {
		
		$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

		$terms = wp_get_object_terms( $post->ID, 'news_type' );
		
		if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
		else $taxonomy_slug = 'not-category';
		
		$post_link =str_replace('%category%', $taxonomy_slug, $post_link);
		
	}

	
	return $post_link;
}
add_filter('post_link', 'gp_remove_cpt_slug', 10, 3);
add_filter( 'post_type_link', 'gp_remove_cpt_slug', 10, 3 );


/* Añade la nueva estuctura del post_type  */

function register_post_type_args( $args, $post_type ) {

	/* Espeficida la custom post type a modificar */
	$post_type_to_modif = "news";

	/* Añade nueva estructura del rewrite */
	$new_rewrite = array( 
						'slug' => ("news/%category%"),
						'with_front' => false,
					);

				
    if ( $post_type_to_modif === $post_type ) {
        $args['rewrite'] = $new_rewrite;
    }

    return $args;
}
add_filter( 'register_post_type_args', 'register_post_type_args', 10, 2 );


/* Modify the request of the links without slug */
function na_parse_request( $query ) {
	/* var_dump($query->is_main_query());
	var_dump($query->query);
	var_dump($query->is_main_query()); */
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		/* var_dump("salgo repentinamente"); */
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
		/* var_dump($query->query['name']); */
        $query->set( 'post_type', array( 'post','reference', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );



/**
 * Custom fields
 */
