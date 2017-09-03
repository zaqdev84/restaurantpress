<?php
/**
 * Admin View: Notice - License Deactivated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="updated notice is-dismissible">
	<p><?php printf( __( 'Your licence for <strong>%s</strong> has been deactivated.', 'wp-plugin-updater' ), esc_html( $this->plugin_data['Name'] ) ); ?></p>
</div>
