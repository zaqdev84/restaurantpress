<?php
/**
 * Duplicate food functionality
 *
 * @class    RP_Admin_Duplicate_Food
 * @version  1.4.0
 * @package  RestaurantPress/Admin
 * @category Admin
 * @author   WPEverest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RP_Admin_Duplicate_Food', false ) ) :

/**
 * RP_Admin_Duplicate_Food Class.
 */
class RP_Admin_Duplicate_Food {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_action_duplicate_food', array( $this, 'duplicate_food_action' ) );
		add_filter( 'post_row_actions', array( $this, 'dupe_link' ), 10, 2 );
		add_action( 'post_submitbox_start', array( $this, 'dupe_button' ) );
	}

	/**
	 * Show the "Duplicate" link in admin foods list.
	 * @param  array   $actions
	 * @param  WP_Post $post Post object
	 * @return array
	 */
	public function dupe_link( $actions, $post ) {
		if ( ! current_user_can( apply_filters( 'restaurantpress_duplicate_food_capability', 'manage_restaurantpress' ) ) ) {
			return $actions;
		}

		if ( 'food_menu' !== $post->post_type ) {
			return $actions;
		}

		$actions['duplicate'] = '<a href="' . wp_nonce_url( admin_url( 'edit.php?post_type=food_menu&action=duplicate_food&amp;post=' . $post->ID ), 'restaurantpress-duplicate-food_' . $post->ID ) . '" aria-label="' . esc_attr__( 'Make a duplicate from this food', 'restaurantpress' ) . '" rel="permalink">' . __( 'Duplicate', 'restaurantpress' ) . '</a>';

		return $actions;
	}

	/**
	 * Show the dupe product link in admin.
	 */
	public function dupe_button() {
		global $post;

		if ( ! current_user_can( apply_filters( 'restaurantpress_duplicate_food_capability', 'manage_restaurantpress' ) ) ) {
			return;
		}

		if ( ! is_object( $post ) ) {
			return;
		}

		if ( 'food_menu' !== $post->post_type ) {
			return;
		}

		if ( isset( $_GET['post'] ) ) {
			$notify_url = wp_nonce_url( admin_url( "edit.php?post_type=food_menu&action=duplicate_food&post=" . absint( $_GET['post'] ) ), 'restaurantpress-duplicate-food_' . $_GET['post'] );
			?>
			<div id="duplicate-action"><a class="submitduplicate duplication" href="<?php echo esc_url( $notify_url ); ?>"><?php _e( 'Copy to a new draft', 'restaurantpress' ); ?></a></div>
			<?php
		}
	}

	/**
	 * Duplicate a food action.
	 */
	public function duplicate_food_action() {
		if ( empty( $_REQUEST['post'] ) ) {
			wp_die( __( 'No food to duplicate has been supplied!', 'restaurantpress' ) );
		}

		$food_id = isset( $_REQUEST['post'] ) ? absint( $_REQUEST['post'] ) : '';

		check_admin_referer( 'restaurantpress-duplicate-food_' . $food_id );

		$food = rp_get_food( $food_id );

		if ( false === $food ) {
			/* translators: %s: food id */
			wp_die( sprintf( __( 'Food creation failed, could not find original food: %s', 'restaurantpress' ), $food_id ) );
		}

		$duplicate = $this->food_duplicate( $food );

		do_action( 'restaurantpress_food_duplicate', $duplicate, $food );

		// Redirect to the edit screen for the new draft page.
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $duplicate->get_id() ) );
		exit;
	}

	/**
	 * Function to create the duplicate of the food.
	 *
	 * @param  WC_Food $food
	 * @return WC_Food
	 */
	public function food_duplicate( $food ) {
		// Here goes the duplication tasks.
	}
}

endif;

return new RP_Admin_Duplicate_Food();
