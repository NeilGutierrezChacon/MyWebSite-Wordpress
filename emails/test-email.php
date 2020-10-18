<?php 
/**
 * Testing Email
 *
 * Specific class to create testing emails templates.
 *
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */
require_once '../../../../wp-load.php';

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Print testing email.
global $dms_emails;
$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
$content .= "<br><br>";
$content .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
$content .= "<br><br>";
$content .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper pretium arcu, sit amet pretium augue vestibulum ut. Fusce in lacinia sapien.";
echo $dms_emails->get_html($content);