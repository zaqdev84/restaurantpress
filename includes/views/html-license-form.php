<?php
/**
 * Admin View: Plugins - License form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$license_row = sanitize_title( $this->plugin_slug . '_license_row' );
$license_key = sanitize_title( $this->plugin_slug . '_license_key' );

?>
<tr id="<?php echo esc_attr( $license_row ); ?>" class="active plugin-update-tr rp-license-key-row-tr">
	<td class="plugin-update" colspan="3">
		<div class="rp-license-key-row">
			<label for="<?php echo $license_key ?>"><?php _e( 'License:', 'user-registration' ); ?></label>
			<input type="text" id="<?php echo $license_key; ?>" name="<?php echo esc_attr( $license_key ); ?>" placeholder="<?php echo esc_attr( 'XXXX-XXXX-XXXX-XXXX', 'restaurantpress' ); ?>" />
			<span class="description"><?php _e( 'Enter your license key and hit return. A valid key is required for updates.' ); ?> <?php printf( 'Lost your key? <a href="%s">Retrieve it here</a>.', esc_url( 'https://wpeverest.com/lost-licence-key/' ) ); ?></span>
		</div>
	</td>
	<script>
		jQuery( function() {
			jQuery( 'tr#<?php echo esc_attr( $license_row ); ?>' ).prev().addClass( 'restaurantpress-license-updater' );
		});
	</script>
</tr>
