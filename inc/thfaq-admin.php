<?php
/**
 * Author: triopsi
 * Author URI: http://triopsi-hosting.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0
 *
 * Thfaq is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Thfaq is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with thfaq. If not, see https://www.gnu.org/licenses/gpl-2.0.
 *
 * @package thfaq
 **/

// Loaded Plugin.
add_action( 'plugins_loaded', 'thfaq_check_version' );

/**
 * Version Check.
 */
function thfaq_check_version() {
	if ( THFAQ_VERSION !== get_option( 'thfaq_plugin_version' ) ) {
		thfaq_activation();
	}
}

/**
 * Update Version Number
 *
 * @return void
 */
function thfaq_activation() {
	update_option( 'thfaq_plugin_version', THFAQ_VERSION );
}
