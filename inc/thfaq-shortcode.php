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

// Add Scripts.
add_action( 'wp_enqueue_scripts', 'add_admin_thfaq_style_js' );

// Shortcode on the Page.
add_shortcode( 'thfaq', 'thfaq_sh' );

/**
 * Undocumented function
 *
 * @return void
 */
function add_admin_thfaq_style_js() {

	wp_register_style( 'th-faq-fronted-style', plugins_url( 'assets/css/front-style.css', THFAQ_PLUGIN_FILE ), array(), THFAQ_VERSION, 'all' );
	wp_enqueue_style( 'th-faq-fronted-style' );

	$use_awesome_cdn   = get_option( 'thfaq_settings_cdn_awesome' );
	$use_bootstrap_cdn = get_option( 'thfaq_settings_cdn_bootstrap' );

	if ( $use_awesome_cdn ) {

		// Font Awesome.
		wp_enqueue_style( 'thfaq-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3', 'all' );
	}

	if ( $use_bootstrap_cdn ) {

		// Bootstrap.
		wp_enqueue_script( 'thfaq-bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js', array(), '4.6.0', true );
		wp_enqueue_style( 'thfaq-bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css', array(), '4.6.0', 'all' );
	}

}

/**
 * Show the Shortcode in the post/site/content.
 *
 * @param Array $atts All Attributes.
 * @return String HTML Code.
 */
function thfaq_sh( $atts ) {

	// Data of the current Post.
	global $post;

	// Shortcode Parameter.
	// phpcs:ignore
	extract(
		shortcode_atts(
			array(
				'orderby'  => 'date',
				'order'    => 'ASC',
				'id'       => '',
				'category' => '',
			),
			$atts
		)
	);

	$order    = ( strtolower( $order ) === 'asc' ) ? 'ASC' : 'DESC';
	$orderby  = ! empty( $orderby ) ? $orderby : 'date';
	$id       = ! empty( $id ) ? $id : '';
	$category = ! empty( $category ) ? $category : '';

	// WP Query Parameters.
	$query_args = array(
		'post_type'      => 'thfaq',
		'post_status'    => array( 'publish' ),
		'posts_per_page' => -1,
		'order'          => $order,
		'orderby'        => $orderby,
	);

	// search single faq.
	if ( ! empty( $id ) ) {
		$query_args['p'] = $id;
	}

	// Search with category.
	if ( ! empty( $category ) ) {
		$query_args['tax_query'] = array( // phpcs:ignore
			array(
				'taxonomy' => 'thfaqs_categories',
				'field'    => 'name',
				'terms'    => $category,
			),
		);
	}

	// WP Query Parameters.
	$thfaq_query = new WP_Query( $query_args );

	// Default Output.
	$htmlout = '';

	if ( $thfaq_query->have_posts() ) {
		ob_start();
		$o        = ob_get_clean();
		$htmlout .= thfaq_get_output_list( $thfaq_query, $post );
	}
	wp_reset_postdata(); // Reset WP Query.
	return $o . $htmlout;

}


/**
 * Get HTMl Code.
 *
 * @param Object  $thfaq_query Array of questions.
 * @param WC_Post $post Acutal Post.
 * @return String HTML Code.
 */
function thfaq_get_output_list( $thfaq_query, $post ) {

	$htmlout = '<!-- Start Triopsi Hosting FAQ List -->';

	if ( $thfaq_query->have_posts() ) {

		// itteration.
		$i = 0;

		$htmlout .= '<div class="accordion" id="thAccordionFAQ">';

		// Outputt all Services.
		foreach ( $thfaq_query->get_posts() as $single_faq ) :

			$iduid = uniqid();

			// Get the ID.
			$id_faq = $iduid . $single_faq->ID;

			// Get the title.
			$title_faq = $single_faq->post_title;

			// Get the body.
			$body_faq = $single_faq->post_content;

			// itteration high.
			$i++;

			$htmlout .= '<!--' . $i . '-->';
			$htmlout .= '<div class="card th-faq-card">';
			$htmlout .= '<a class="th-faq-link-title collapsed" role="button" href="#th' . $id_faq . '" data-toggle="collapse" aria-expanded="false" aria-controls="th' . $id_faq . '">';
			$htmlout .= '<div class="card-header border-0 p-3 pr-5 th-faq-card-header">';
			$htmlout .= '<h6 class="mb-0">';
			$htmlout .= esc_html( $title_faq );
			$htmlout .= '</h6>';
			$htmlout .= '</div>';
			$htmlout .= '</a>';
			$htmlout .= '<div id="th' . $id_faq . '" class="collapse th-faq-collapse" aria-labelledby="th' . $id_faq . '" data-parent="#thAccordionFAQ">';
			$htmlout .= '<div class="card-body th-faq-body">';
			$htmlout .= $body_faq;
			$htmlout .= '</div>';
			$htmlout .= '</div>';
			$htmlout .= '</div>';

		endforeach;

		$htmlout .= '</div>';
	}
	$htmlout .= '<!-- End Triopsi Hosting FAQ List -->';
	return $htmlout;
}
