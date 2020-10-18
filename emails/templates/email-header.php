<?php
/**
 * Email Header
 *
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<!DOCTYPE html>
<html dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>
    <body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
            	<tr>
                	<td align="center" valign="top">
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- Header -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header">
                                        <tr>
                                            <td id="header_wrapper">
                                            	<h1>
                                            		<?php 

                                                        $mail_logo = get_field("theme_settings_email__logo", "option");
                                                        if(empty($mail_logo)) $mail_logo = get_field("theme_settings_general__logo", "option");

                                            			if ( !empty($mail_logo) ) {
                                            				echo '<img src="' . $mail_logo['url'] . '" alt="' . get_bloginfo( 'name', 'display' ) . '" />';
                                            			} else {
                                            				echo wp_get_theme()->get ( 'Name' );
                                            			}
                                            		?>
                                            	</h1>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Header -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- Body -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                                    	<tr>
                                            <td valign="top" id="body_content">
                                                <!-- Content -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div id="body_content_inner">
