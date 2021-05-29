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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add Menue.
add_action( 'admin_menu', 'thfaq_register_help_page' );

/**
 * Add help page function
 *
 * @return void
 */
function thfaq_register_help_page() {
	add_submenu_page(
		'edit.php?post_type=thfaq',
		__( 'How It Works', 'thfaq' ),
		__( 'Help', 'thfaq' ),
		'manage_options',
		'thfaq_help',
		'thfaq_help_page'
	);
}

/**
 * Text HTML
 *
 * @return void
 */
function thfaq_help_page() { ?>
	<style type="text/css">
		.thfaq-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php esc_html_e( 'How It Works - Display and shortcode', 'thfaq' ); ?></span>
								</h3>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php esc_html_e( 'Geeting Started with TH FAQ', 'thfaq' ); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php esc_html_e( 'Step 1. Go to "All FAQs --> Add New FAQ"', 'thfaq' ); ?></li>
														<li><?php esc_html_e( 'Step 2. Add a title and the answer in the text box.', 'thfaq' ); ?></li>
														<li><?php _e( 'Step 3a. Copy-paste the shortcode <span class="thfaq-shortcode-preview">[thfaq]</span> anywhere in your post or site for show a accordion.', 'thfaq' ); // phpcs:ignore ?></li>
														<li><b><?php esc_html_e( 'or', 'thfaq' ); ?></b></li>
														<li><?php _e( 'Step 3b. Copy-paste the shortcode <span class="thfaq-shortcode-preview">[thfaq id="&lt;id&gt;"]</span> anywhere in your post or site for show a single faq.', 'thfaq' ); // phpcs:ignore ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php esc_html_e( 'All Shortcodes', 'thfaq' ); ?>:</label>
												</th>
												<td>
													<span class="thfaq-shortcode-preview">[thfaq]</span> – <?php esc_html_e( 'Show all faq in a accordion', 'thfaq' ); ?> <br />
													<span class="thfaq-shortcode-preview">[thfaq id=&lt;id&gt;]</span> – <?php esc_html_e( 'show a single faq', 'thfaq' ); ?> <br />
													<span class="thfaq-shortcode-preview">[thfaq category=&lt;slug-name&gt;]</span> – <?php esc_html_e( 'Show all faq from the category in a accordion', 'thfaq' ); ?> <br />
												</td>
											</tr>			

											<tr>
												<th>
													<label><?php esc_html_e( 'All Shortcodes parameters', 'thfaq' ); ?>:</label>
												</th>
												<td>
													<span class="thfaq-shortcode-preview">orderby="date"</span> – <?php esc_html_e( 'orderby the atribute of faqs Value=date, ID, title, name or rand, Default=date', 'thfaq' ); ?> <br />
													<span class="thfaq-shortcode-preview">order="asc"</span> – <?php esc_html_e( 'sort the faq in ascending or descending order. Value=asc or desc, Default=ASC', 'thfaq' ); ?> <br />
													<br />
													<?php esc_html_e( 'e.g.', 'thfaq' ); ?>
													<span class="thfaq-shortcode-preview">[thfaq orderby="date" order="desc"]</span>
												</td>
											</tr>
											<tr>
												<th>
													<label><?php esc_html_e( 'Need Support?', 'thfaq' ); ?></label>
												</th>
												<td>
													<p><?php esc_html_e( 'Check plugin document for shortcode parameters.', 'thfaq' ); ?></p> <br/>
													<a class="button button-primary" href="http://triopsi-hosting.com" target="_blank"><?php esc_html_e( 'Documentation', 'thfaq' ); ?></a>									
													<a class="button button-secondary" href="http://paypal.me/triopsi" target="_blank">❤️ <?php esc_html_e( 'Donate', 'thfaq' ); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
	<?php
}
