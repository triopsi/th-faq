<?php
/**
 * Plugin Name: TH FAQ
 * Plugin URI: https://triopsi-hosting.com
 * Description: A simple FAQ Plugin for WordPress. Add and manage frequently asked questions on your site.
 * Version: 1.0.0
 * Author: triopsi
 * Author URI: https://triopsi-hosting.com
 * Text Domain: thfaq
 * Domain Path: /lang/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
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
 * along with thpp. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package thpp
 **/

// Definie plugin version.
if ( ! defined( 'THFAQ_VERSION' ) ) {
	define( 'THFAQ_VERSION', '1.0.0' );
}

define( 'THFAQ_PLUGIN_FILE', __FILE__ );

/* Loads plugin's text domain. */
add_action( 'init', 'thfaq_load_plugin_textdomain' );

// Add Admin Actions.
require_once 'inc/thfaq-admin.php';
require_once 'inc/thfaq-types.php';
require_once 'inc/thfaq-help.php';
require_once 'inc/thfaq-setting.php';

// Shortcode.
require_once 'inc/thfaq-shortcode.php';

/**
 * Init Script. Load languages
 *
 * @return void
 */
function thfaq_load_plugin_textdomain() {
	load_plugin_textdomain( 'thfaq', '', 'th-faq/lang/' );
}
