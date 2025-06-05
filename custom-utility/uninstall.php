<?php
/**
 * Uninstall Custom Utility Plugin
 *
 * This file is executed when the user deletes the plugin from the WordPress admin.
 * It should be used to clean up any options, database tables, or files created by the plugin.
 *
 * @package Custom_Utility_Plugin
 * @since 1.0.0
 */

// Exit if accessed directly for security.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
