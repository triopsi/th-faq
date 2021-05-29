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

// Register our thfaq_options_page to the admin_menu action hook.
add_action( 'admin_menu', 'thfaq_option_menue' );

/**
 * Register thfaq_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'thfaq_settings_init' );


/**
 * Init setting setup
 *
 * @return void
 */
function thfaq_settings_init() {

	// register new settings.
	register_setting( 'thfaq', 'thfaq_settings_cdn_awesome' );
	register_setting( 'thfaq', 'thfaq_settings_cdn_bootstrap' );

	// Font Awesome CDN.
	add_settings_section(
		'thfaq_settings_section_font_cdn',
		'Font Awesome CDN',
		'thfaq_settings_cdn_section_cb',
		'thfaq'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'thfaq_settings_cdn_awesome',
		__( 'Use Font Awesome CDN?', 'thfaq' ),
		'thfaq_settings_field_cdn_cb',
		'thfaq',
		'thfaq_settings_section_font_cdn'
	);

	// Bootstrap Awesome CDN.
	add_settings_section(
		'thfaq_settings_section_bootstrap_cdn',
		'Bootstrap v4.16 CDN',
		'thfaq_settings_cdn_bootstrap_section_cb',
		'thfaq'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'thfaq_settings_cdn_awesome',
		__( 'Use Bootstrap CDN?', 'thfaq' ),
		'thfaq_settings_field_bootstrap_cdn_cb',
		'thfaq',
		'thfaq_settings_section_bootstrap_cdn'
	);
}

/**
 * Setting Field.
 */
function thfaq_settings_field_cdn_cb() {
	$old_setting_value = ( ! empty( get_option( 'thfaq_settings_cdn_awesome' ) ) ? get_option( 'thfaq_settings_cdn_awesome' ) : 'yes' );
	?>
	<input type="checkbox" id="thfaq_settings_cdn_awesome" name="thfaq_settings_cdn_awesome" value="1" <?php echo checked( 1, $old_setting_value, false ); ?>/>
	<label for="thfaq_settings_cdn_awesome"><?php esc_html_e( 'Enable', 'thfaq' ); ?></label>
	<?php
}

/**
 * Setting Field.
 */
function thfaq_settings_field_bootstrap_cdn_cb() {
	$old_setting_value = ( ! empty( get_option( 'thfaq_settings_cdn_bootstrap' ) ) ? get_option( 'thfaq_settings_cdn_bootstrap' ) : 'yes' );
	?>
	<input type="checkbox" id="thfaq_settings_cdn_bootstrap" name="thfaq_settings_cdn_bootstrap" value="1" <?php echo checked( 1, $old_setting_value, false ); ?>/>
	<label for="thfaq_settings_cdn_bootstrap"><?php esc_html_e( 'Enable', 'thfaq' ); ?></label>
	<?php
}

/**
 * Font Awesome library CDN Header.
 */
function thfaq_settings_cdn_section_cb() {
	esc_html_e( 'Want to use the CDN for Font Awesome Icons?', 'thfaq' );
}

/**
 * Bootrap library CDN Header.
 */
function thfaq_settings_cdn_bootstrap_section_cb() {
	esc_html_e( 'Want to use the CDN for Bootrap library?', 'thfaq' );
}

/**
 * Add Top level menue.
 */
function thfaq_option_menue() {

	add_options_page(
		__( 'TH FAQ Options', 'thfaq' ),
		__( 'TH FAQ Options', 'thfaq' ),
		'manage_options',
		'thfaq',
		'thfaq_options_page_html'
	);
}

/**
 *  Page content.
 *
 * @return void
 */
function thfaq_options_page_html() {
	// Check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		<form action="options.php" method="post">
			<?php
				// output security fields for the registered setting "thfaq".
				settings_fields( 'thfaq' );

				// output setting sections and their fields.
				// (sections are registered for "thfaq", each field is registered to a specific section).
				do_settings_sections( 'thfaq' );

				// output save settings button.
				submit_button( __( 'Save Settings', 'thfaq' ) );
			?>
		</form>
		<div id="post-body-content">
			<div id="thfaq-admin-page" class="meta-box-sortabless">
				<div id="thfaq-shortcode" class="postbox">
					<div class="inside">
						<h3 class="wp-pic-title"><?php esc_html_e( 'Supports', 'thfaq' ); ?></h3>
						<div class="thfaq-wrap-option-page">
							<a href="https://paypal.me/triopsi" target="_blank" class="button button-secondary">❤️ <?php esc_html_e( 'Donate', 'thfaq' ); ?></a> 
							<a href="edit.php?post_type=thfaq&page=thfaq_help" target="_self" class="button button-secondary">ℹ️ <?php esc_html_e( 'Help', 'thfaq' ); ?></a> 
						</div>
					</div>
				</div>
			</div>
		<?php if ( WP_DEBUG ) { ?>
			<div class="debug-info">
				<h3><?php esc_html_e( 'Debug information', 'thfaq' ); ?></h3>
				<p><?php esc_html_e( 'You are seeing this because your WP_DEBUG variable is set to true.', 'thfaq' ); ?></p>
				<pre>thfaq_plugin_version: <?php print_r( get_option( 'thfaq_plugin_version' ) ); // phpcs:ignore ?></pre>
				<pre>thfaq_settings_cdn_awesome: <?php print_r( get_option( 'thfaq_settings_cdn_awesome' ) ); // phpcs:ignore ?></pre>
				<pre>thfaq_settings_cdn_bootstrap: <?php print_r( get_option( 'thfaq_settings_cdn_bootstrap' ) ); // phpcs:ignore ?></pre>
				<pre><?php esc_html_e( 'All FAQs', 'thfaq' ); ?>: <?php print_r( thfaq_show_all_faqs() ); // phpcs:ignore ?></pre>
			</div><!-- /.debug-info -->
		<?php } ?>
	</div>
	<?php
}

/**
 * Find all faqs.
 *
 * @return Object All FAQs.
 */
function thfaq_show_all_faqs() {
	$post_type_arg   = array(
		'post_type'      => 'thfaq',
		'posts_per_page' => -1,
	);
	$getpostsentries = get_posts( $post_type_arg );
	return $getpostsentries;
}
