<?php
/**
 * Email Class
 *
 * Specific class to create emails templates.
 * 
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'DMS_Email' ) ) :
	class DMS_Email {
		
		/** Singleton pattern */
		protected static $_instance = null;
		public static function instance($dms) {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self($dms);
			}
			return self::$_instance;
		}
		
		/* Fields */
		private $css;
		private $header;
		private $body;
		private $footer;
		
		/* Constructor */
		private function __construct($dms = null) {
			require_once 'libs/Emogrifier.php';
			$this->init($dms);
		}
		
		/* Methods */
		private function init($dms) {
			set_query_var( 'email', $this );
			set_query_var( 'dms', $dms );
			
			ob_start();
			get_template_part( 'emails/templates/email', 'styles' );
			$this->css    =  ob_get_clean();
			
			ob_start();
			get_template_part( 'emails/templates/email', 'header' );
			$this->header = ob_get_clean();
			
			ob_start();
			get_template_part( 'emails/templates/email', 'body' );
			$this->body   = ob_get_clean();
			
			ob_start();
			get_template_part( 'emails/templates/email', 'footer' );
			$this->footer = ob_get_clean();
		}
		
		public function get_html($content) {
			$tmp_html = $this->header . $this->body . $content . $this->footer;

			// Apply css to body
			try {
				$emogrifier = new Emogrifier( $tmp_html, $this->css );
				$html = $emogrifier->emogrify();
			} catch ( Exception $e ) {
				$html = $tmp_html;
			}
		
			return $html;
		}
		
		public function get_html_body($content) {
			$tmp_html = $this->header . $this->body . $content . $this->footer;
			
			// Apply css to body
			try {
				$emogrifier = new Emogrifier( $tmp_html, $this->css );
				$html = $emogrifier->emogrifyBodyContent();
			} catch ( Exception $e ) {
				$html = $tmp_html;
			}
			
			return $html;
		}
		
		public function send($subject, $theme_title, $email_from, $email_bcc, $email_to, $content) {
			$html = $this->get_html($content);
			
			// Send email
			$headers[] = 'From: ' . $theme_title . ' <' . $email_from . '>';
			$headers[] = 'Bcc: ' . $theme_title . ' <' . $email_bcc . '>';
			
			function set_html_content_type() {return 'text/html';}
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );
			wp_mail( $email_to, $subject, $html, $headers);
			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
		}
		
		public function color_hex_darker( $color, $factor = 30 ) {
			$base  =  $this->rgb_from_hex( $color );
			$color = '#';
		
			foreach ( $base as $k => $v ) {
				$amount      = $v / 100;
				$amount      = round( $amount * $factor );
				$new_decimal = $v - $amount;
		
				$new_hex_component = dechex( $new_decimal );
				if ( strlen( $new_hex_component ) < 2 ) {
					$new_hex_component = "0" . $new_hex_component;
				}
				$color .= $new_hex_component;
			}
		
			return $color;
		}
		
		public function color_hex_lighter( $color, $factor = 30 ) {
			$base  = $this->rgb_from_hex( $color );
			$color = '#';
		
			foreach ( $base as $k => $v ) {
				$amount      = 255 - $v;
				$amount      = $amount / 100;
				$amount      = round( $amount * $factor );
				$new_decimal = $v + $amount;
		
				$new_hex_component = dechex( $new_decimal );
				if ( strlen( $new_hex_component ) < 2 ) {
					$new_hex_component = "0" . $new_hex_component;
				}
				$color .= $new_hex_component;
			}
		
			return $color;
		}
		
		// PRIVATE functions
		private function rgb_from_hex( $color ) {
			$color = str_replace( '#', '', $color );
			// Convert shorthand colors to full format, e.g. "FFF" -> "FFFFFF"
			$color = preg_replace( '~^(.)(.)(.)$~', '$1$1$2$2$3$3', $color );
		
			$rgb      = array();
			$rgb['R'] = hexdec( $color{0}.$color{1} );
			$rgb['G'] = hexdec( $color{2}.$color{3} );
			$rgb['B'] = hexdec( $color{4}.$color{5} );
		
			return $rgb;
		}
	}
endif;