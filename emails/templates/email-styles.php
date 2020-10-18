<?php
/**
 * Email Styles
 *
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// VARS
$logo_width  = get_field("theme_settings_email__logo_width", "option");

// COLORS
$email_bg_color     = get_field("theme_settings_email__email_bg_color", "option");
$header_bg_color    = get_field("theme_settings_email__header_bg_color", "option");
$header_text_color  = get_field("theme_settings_email__header_text_color", "option");
$body_bg_color      = get_field("theme_settings_email__body_bg_color", "option");
$body_text_color    = get_field("theme_settings_email__body_text_color", "option");
$footer_text_color  = get_field("theme_settings_email__footer_text_color", "option");




$bg              = $email_bg_color      ? $email_bg_color    : "#efefef";
$header          = $header_bg_color     ? $header_bg_color   : "#557da1";
$header_text     = $header_text_color   ? $header_text_color : "#ffffff";
$body            = $body_bg_color       ? $body_bg_color     : "#ffffff";
$body_text       = $body_text_color     ? $body_text_color   : "#000000";
$footer_text     = $footer_text_color   ? $footer_text_color : "#000000";


$bg_darker_10    = $email->color_hex_darker($bg, 10);
$header_lighter_20 = $email->color_hex_lighter($header, 20);
$body_darker_10  = $email->color_hex_darker($body, 10);
$header_lighter_40 = $email->color_hex_lighter($header, 40);
$body_text_lighter_20 = $email->color_hex_lighter($body_text, 20);

$header_img_width = $logo_width ? $logo_width : "200";

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
?>
#wrapper {
    background-color: <?php echo esc_attr( $bg ); ?>;
    margin: 0;
    padding: 70px 0 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;
}

#template_container {
    box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important;
    background-color: <?php echo esc_attr( $body ); ?>;
    border: 1px solid <?php echo esc_attr( $bg_darker_10 ); ?>;
    border-radius: 3px !important;
}

#template_header {
    background-color: <?php echo esc_attr( $header ); ?>;
    border-radius: 3px 3px 0 0 !important;
    color: <?php echo esc_attr( $header_text ); ?>;
    border-bottom: 0;
    font-weight: bold;
    line-height: 100%;
    vertical-align: middle;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
}

#template_header h1 {
    color: <?php echo esc_attr( $header_text ); ?>;
}

#template_footer td {
    padding: 0;
    -webkit-border-radius: 6px;
}

#template_footer #credit {
    border:0;
    color: <?php echo esc_attr( $header_lighter_40 ); ?>;
    font-family: Arial;
    font-size:12px;
    line-height:125%;
    text-align:center;
    padding: 0 48px 48px 48px;
}

#body_content {
    background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
    padding: 30px 48px;
}

#body_content table td td {
    padding: 12px;
}

#body_content table td th {
    padding: 12px;
}

#body_content p {
    margin: 0 0 16px;
}

#body_content_inner {
    color: <?php echo esc_attr( $body_text_lighter_20 ); ?>;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 14px;
    line-height: 150%;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}
.body_content_inner {
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    line-height: 150%;
}

.td {
    color: <?php echo esc_attr( $body_text_lighter_20 ); ?>;
    border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
}

.text {
    color: <?php echo esc_attr( $body_text ); ?>;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
}

.link {
    color: <?php echo esc_attr( $header ); ?>;
}

#header_wrapper {
    padding: 20px;
    display: block;
}

h1 {
    color: <?php echo esc_attr( $header ); ?>;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 30px;
    font-weight: 300;
    line-height: 150%;
    margin: 0;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
    text-shadow: 0 1px 0 <?php echo esc_attr( $header_lighter_20 ); ?>;
    -webkit-font-smoothing: antialiased;
    text-align: center;
    text-transform: uppercase;
    height: 100px;
}

h2 {
    color: <?php echo esc_attr( $header ); ?>;
    display: block;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 8px;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
    color: <?php echo esc_attr( $header ); ?>;
    display: block;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 8px;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
    color: <?php echo esc_attr( $header ); ?>;
    font-weight: normal;
    text-decoration: underline;
}

h1 img {
	height: auto;
  	width: <?php echo esc_attr( $header_img_width ); ?>px;
    border: none;
    display: inline;
    font-size: 14px;
    font-weight: bold;
    line-height: 100%;
    outline: none;
    text-decoration: none;
    text-transform: capitalize;
}

#template_footer {
	padding: 20px 48px;
}

#social-networks {
	text-align: center;
	padding-bottom: 20px;
}
#support-email {
	text-align: center !important;
	padding-bottom: 10px;
	font-size: 12px !important;
	color: #888 !important;
}
#copy-email {
	text-align: center !important;
	padding-bottom: 20px;
	font-size: 12px !important;
	color: #888 !important;
}
#template_footer #support-email a{
    color: <?php echo esc_attr( $footer_text ); ?>;
}
<?php
