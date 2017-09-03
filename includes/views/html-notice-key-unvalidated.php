<?php
/**
 * Admin View: Notice - License Unvalidated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated">
	<p class="rp-updater-dismiss" style="float:right;"><a href="<?php echo esc_url( add_query_arg( 'dismiss-' . sanitize_title( $this->plugin_slug ), '1' ) ); ?>"><?php _e( 'Hide notice', 'restaurantpress' ); ?></a></p>
	<p><?php printf( __( '%sPlease enter your license key%s in the plugin list below to get updates for <strong>%s</strong>.', 'restaurantpress' ), '<a href="' . esc_url( admin_url( 'plugins.php#' . sanitize_title( $this->plugin_slug ) ) ) . '">', '</a>', esc_html( $this->plugin_data[ 'Name' ] ) ); ?></p>
</div>
