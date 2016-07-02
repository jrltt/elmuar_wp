<?php 
/**
 * Contain custom functions
 * @author jrltt <hola@jrltt.net>
 * @package Elisa_Murcia_Artengo
 * @since 1.0 
 */

function build_category_year() {
	$object_data = get_the_date('Y');
	$cat = get_the_category(); 
	foreach ($cat as $key => $value) {
		$object_data .= ' – ' . $value->name;
	}
	return $object_data;
}