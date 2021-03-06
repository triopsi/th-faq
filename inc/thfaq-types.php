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

// Registers the teams post type.
add_action( 'init', 'register_thfaq_type' );

// Register new taxonomy.
add_action( 'init', 'register_thfaq_taxonomy' );

// Add update messages.
add_filter( 'post_updated_messages', 'thfaq_updated_messages' );

// Add new Column.
add_filter( 'manage_edit-thfaqs_categories_columns', 'thfaq_custom_categories_add_new_columns' );

// Adds the shortcode column in the postslistbar.
add_filter( 'manage_thfaq_posts_columns', 'add_thfaq_columns' );

// Handles shortcode column display.
add_action( 'manage_thfaq_posts_custom_column', 'thfaq_custom_columns', 10, 2 );

// Add new Column.
add_action( 'manage_thfaqs_categories_custom_column', 'thfaq_custom_categories_columns', 10, 3 );


/**
 * Function about the ini of the Plugin
 *
 * @return void
 */
function register_thfaq_type() {

	// Defines labels.
	$labels = array(
		'name'               => __( 'TH FAQ', 'thfaq' ),
		'singular_name'      => __( 'FAQ', 'thfaq' ),
		'menu_name'          => __( 'TH FAQ', 'thfaq' ),
		'name_admin_bar'     => __( 'TH FAQ', 'thfaq' ),
		'add_new'            => __( 'Add New FAQ', 'thfaq' ),
		'add_new_item'       => __( 'Add New FAQ', 'thfaq' ),
		'new_item'           => __( 'New FAQ', 'thfaq' ),
		'edit_item'          => __( 'Edit FAQ', 'thfaq' ),
		'view_item'          => __( 'View FAQ', 'thfaq' ),
		'all_items'          => __( 'All FAQs', 'thfaq' ),
		'search_items'       => __( 'Search FAQs', 'thfaq' ),
		'not_found'          => __( 'No FAQs found.', 'thfaq' ),
		'not_found_in_trash' => __( 'No FAQs found in Trash.', 'thfaq' ),
	);

	// Defines permissions.
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_admin_bar'  => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon'          => 'dashicons-editor-help',
		'query_var'          => true,
		'rewrite'            => false,
	);

	// Registers post type.
	register_post_type( 'thfaq', $args );

}

/**
 * Function to register post taxonomies
 */
function register_thfaq_taxonomy() {

	$labels = array(
		'name'                       => __( 'FAQ Categories', 'thfaq' ),
		'singular_name'              => __( 'FAQ Category', 'thfaq' ),
		'search_items'               => __( 'Search FAQ categories', 'thfaq' ),
		'all_items'                  => __( 'All FAQ categories', 'thfaq' ),
		'parent_item'                => __( 'Parent FAQ Category', 'thfaq' ),
		'parent_item_colon'          => __( 'Parent FAQ Category:', 'thfaq' ),
		'edit_item'                  => __( 'Edit FAQ Category', 'thfaq' ),
		'update_item'                => __( 'Update FAQ Category', 'thfaq' ),
		'add_new_item'               => __( 'Add New FAQ Category', 'thfaq' ),
		'new_item_name'              => __( 'New FAQ Category Name', 'thfaq' ),
		'separate_items_with_commas' => __( 'Separate FAQ categories with commas', 'thfaq' ),
		'add_or_remove_items'        => __( 'Add or remove FAQ category', 'thfaq' ),
		'choose_from_most_used'      => __( 'Choose from the most used FAQ categories', 'thfaq' ),
		'not_found'                  => __( 'No FAQ category found.', 'thfaq' ),
		'menu_name'                  => __( 'FAQ Categories', 'thfaq' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
	);

	// Register Taxonomies.
	register_taxonomy( 'thfaqs_categories', array( 'thfaq' ), $args );

}

/**
 * Update post message functions
 *
 * @param String $messages Message.
 * @return Array New Array with Message.
 */
function thfaq_updated_messages( $messages ) {
	$post              = get_post();
	$post_type         = get_post_type( $post );
	$post_type_object  = get_post_type_object( $post_type );
	$messages['thfaq'] = array(
		1  => __( 'FAQ updated.', 'thfaq' ),
		4  => __( 'FAQ updated.', 'thfaq' ),
		6  => __( 'FAQ published.', 'thfaq' ),
		7  => __( 'FAQ saved.', 'thfaq' ),
		10 => __( 'FAQ draft updated.', 'thfaq' ),
	);
	return $messages;
}

/**
 * Shortcodestyle function.
 *
 * @param Array   $column Collumn.
 * @param Integer $post_id Post ID.
 */
function thfaq_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'thfaq_shortcode':
			global $post;
			$slug      = '';
			$slug      = $post->ID;
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[thfaq id=&quot;' . $slug . '&quot;]" class="large-text code"></span>';
			echo $shortcode; // phpcs:ignore
			break;
	}
}


/**
 * Shortcodestyle function.
 *
 * @param String  $string Content.
 * @param Array   $columns Collumn.
 * @param Integer $term_id Post ID.
 */
function thfaq_custom_categories_columns( $string, $columns, $term_id ) {
	switch ( $columns ) {
		case 'thfaq_cat_shortcode':
			$slug      = get_term( $term_id, 'thfaqs_categories' );
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[thfaq category=' . $slug->slug . ']" class="large-text code"></span>';
			echo $shortcode; // phpcs:ignore
			break;
	}
}

/**
 * Add New collumn.
 *
 * @param Array $columns All Columns.
 * @return Array All Columns with new col.
 */
function thfaq_custom_categories_add_new_columns( $columns ) {

	$columns['thfaq_cat_shortcode'] = __( 'Shortcode', 'thfaq' );
	return $columns;
}

/**
 * AdminCollumnBar function.
 *
 * @param Array $columns Collumn.
 * @return Array Arraymerge.
 */
function add_thfaq_columns( $columns ) {
	$columns['title'] = __( 'Question', 'thfaq' );
	unset( $columns['author'] );
	unset( $columns['date'] );
	return array_merge( $columns, array( 'thfaq_shortcode' => __( 'Shortcode', 'thfaq' ) ) );
}

