<?php 
/**
 * Contain custom functions
 * @author jrltt <hola@jrltt.net>
 * @package Elisa_Murcia_Artengo
 * @since 1.0 
 */

/**
 * Build a string with the category name and the 
 * created date of category
 * @return String 
 */
function build_category_year() {
	$object_data = get_the_date('Y');
	$cat = get_the_category(); 
	foreach ($cat as $key => $value) {
		$object_data .= ' – ' . $value->name;
	}
	return $object_data;
}

function getEdTromCatId () {
	$catEdTromp = get_term_by('slug', 'editions-trompeloeil', 'category');
	// $args = array(
	// 	'category'         => $catEdTromp->term_id,
	// 	'post_type'        => 'publication',
	// 	'post_status'      => 'publish'
	// );
	// $posts_array = get_posts( $args );
	// $edTrompIds = array();
	// foreach ($posts_array as $key => $value) {
	// 	array_push($edTrompIds, $value->ID);
	// }
	return $catEdTromp->term_id;
}