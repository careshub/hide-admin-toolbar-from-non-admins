<?php
/**
 * CARES Hide Admin Bar from Non-Admins.
 *
 * @package   cares-hide-admin-bar-from-non-admins
 * @license   GPL-2.0+
 *
 * Plugin Name:       CARES Hide Admin Bar from Non-Admins
 * Plugin URI:        https://github.com/buddypress/bp-blocks
 * Description:       On user creation, set the user meta that controls whether logged-in users see the front-end WP Toolbar to false for users who are not site admins.
 * Version:           1.0.0
 * Author:            dcavins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/careshub/hide-admin-bar-from-non-admins
 */
/**
 * On new user creation, set the `show_admin_bar_front` user meta to false for all 
 * non-admin users (who probably don't need to see the toolbar).
 *
 * About the filter hook: `insert_user_meta`
 * Filters a user's meta values and keys immediately after the user is created or updated
 * and before any user meta is inserted or updated.
 *
 * Does not include contact methods. These are added using `wp_get_user_contact_methods( $user )`.
 *
 * @since 1.0
 *
 * @param array $meta {
 *     Default meta values and keys for the user.
 *
 *     @type string   $nickname             The user's nickname. Default is the user's username.
 *     @type string   $first_name           The user's first name.
 *     @type string   $last_name            The user's last name.
 *     @type string   $description          The user's description.
 *     @type string   $rich_editing         Whether to enable the rich-editor for the user. Default 'true'.
 *     @type string   $syntax_highlighting  Whether to enable the rich code editor for the user. Default 'true'.
 *     @type string   $comment_shortcuts    Whether to enable keyboard shortcuts for the user. Default 'false'.
 *     @type string   $admin_color          The color scheme for a user's admin screen. Default 'fresh'.
 *     @type int|bool $use_ssl              Whether to force SSL on the user's admin area. 0|false if SSL
 *                                          is not forced.
 *     @type string   $show_admin_bar_front Whether to show the admin bar on the front end for the user.
 *                                          Default 'true'.
 *     @type string   $locale               User's locale. Default empty.
 * }
 * @param WP_User $user   User object.
 * @param bool    $update Whether the user is being updated rather than created.
 */
function cares_hide_admin_bar_filter_user_meta( $meta, $user, $update ) {
	// Act on user registration only.
	if ( ! $update ) {
		// Hide the top toolbar from users who don't need to access the WP Admin Dashboard.
		if ( ! user_can( $user, 'create_users' ) ) {
			$meta['show_admin_bar_front'] = 'false';
		}
	}
	return $meta;
}
add_filter( 'insert_user_meta', 'cares_hide_admin_bar_filter_user_meta', 10, 3 );
