<?php
/**
 * Email body
 *
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<p>
	<?php do_action( 'dms_email_body_content');?>
</p>