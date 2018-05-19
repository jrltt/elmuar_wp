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
function build_category_year() 
{
	$object_data = get_the_date('Y');
	$cat = get_the_category(); 
	foreach ($cat as $key => $value) {
		$object_data .= ($value->slug == 'editions-trompeloeil') ? '' :' – ' . $value->name;
	}
	return $object_data;
}

function getEdTromCatId () 
{
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

function defaultImages () 
{
	$images = array();
	for ($i=0; $i < 4 ; $i++) { 
		$image = get_template_directory_uri() . '/images/defaultImage'. $i .'.png';
		array_push($images, $image);
	}
	$imageHtml = '<img src="' . $images[rand(0,count($images)-1)] .'" alt="ELMUAR Default image">';
	return $imageHtml;
}

function has_post_gallery()
{
	global $post;
	if( ! has_shortcode( $post->post_content, 'gallery' ) )
		return false;
	$gallery = get_post_gallery_images( $post );
	return (count($gallery) >= 0);
}

function get_match( $regex, $content ) {
	preg_match($regex, $content, $matches);
	return $matches[1];
} 
function build_gallery($size = 'default', $post_content = null)
{
	// https://wordpress.stackexchange.com/questions/80408/how-to-get-page-post-gallery-attachment-images-in-order-they-are-set-in-backend
	// Extract the shortcode arguments from the $page or $post
	$shortcode_args = shortcode_parse_atts(get_match('/\[gallery\s(.*)\]/isU', $post_content));
	// get the ids specified in the shortcode call
	$ids = $shortcode_args['ids'];
	// get the attachments specified in the "ids" shortcode argument
	$gallery = get_posts(
		array(
			'include' => $ids, 
			'post_status' => 'inherit', 
			'post_type' => 'attachment', 
			'post_mime_type' => 'image', 
			'order' => 'menu_order ID', 
			'orderby' => 'post__in', //required to order results based on order specified the "include" param
		)
	);
	?>

	<div class="carousel" data-flickity='{"adaptiveHeight": true, "imagesLoaded": true,"prevNextButtons": true, "pageDots":false, "lazyLoad": true}'>
		<?php foreach( $gallery as $key => $value ) { ?>
			<div class="gallery-cell">
				<div class="flex-align-center">
					<img class="box wp-post-image" data-flickity-lazyload="<?php echo $value->guid; ?>" alt="<?php echo $value->post_title ."\n". $value->post_excerpt; ?>">
				</div>
			</div>
		<?php } ?>
	</div>
	<?php if (is_single()): ?>
		<div class="caption">&nbsp;</div>
	<?php endif; ?>
	<?php
}

function jrltt_posted_on_simple($type = 'F, Y')
{
	echo '<span class="posted-on">' . get_the_date( $type ). '</span>';
}

function echo_first_image( $postID ) 
{
	$args = array(
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',
		'post_parent' => $postID,
		'post_status' => null,
		'post_type' => 'attachment',
	);

	$attachments = get_children( $args );
	if ( $attachments ) {
		foreach ( $attachments as $attachment ) {

			$image = wp_get_attachment_image_src( $attachment->ID, 'full' );
			echo '<img src="' . $image[0] . '" class="current wp-post-image">';
		}
	}
}

function custom_navigation_menu() 
{
	$args = array(
		'sort_order' => 'asc',
		'sort_column' => 'menu_order',
		'post_type' => 'page',
		'post_status' => 'publish'
	); 
	$pages = get_pages($args);
	$html = '<ul class="projects__menu menu">';
	foreach ($pages as $key => $value) {
		if ($value->post_title == 'Projets') {
		$html .= '<li class="menu-item"><a href="'. $value->guid . '" class="">'.$value->post_title; 
		if (is_page_template('projects.php')) {
			if ($value->ID == 10 && $value->post_title == 'Projets') {
				$html .= get_projects_by_title();
			}
		}
		$html .= '</a></li>';
		}
	}
	$html .= '</ul>';
	echo $html;
}

function get_projects_by_title() 
{
	$args = array(
		'post_type'				=>	 	'project',
		'order'					=> 		'DESC',
		'orderby'				=>		'date',
		'posts_per_page'		=>		-1
	);
	$loop = new WP_Query($args);
	$html = '<ul class="sub-menu">';
	while ( $loop->have_posts() ) : $loop->the_post();
		$html .= '<li class="menu-item menu-item-type-post_type post-'. get_the_ID() .'">';
		$html .= '<a href="#post-'. get_the_ID() .'">'. get_the_title() .'</a>';
		$html .= '</li>';
	endwhile;
	wp_reset_postdata();
	$html .= '</ul>';
	return $html;
}

function has_gallery() 
{
	$response = 'image__type--default';
	if ( has_post_gallery() ) {
		$response = 'image__type--gallery';
	} else if ( has_post_thumbnail() ) {
		$response = 'image__type--thumbnail';
	}
	return $response;
}

function languages_list_footer()
{
	$languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
		echo '<ul class="header--leng__list">';
		foreach($languages as $l){
			echo '<li>';
			if(!$l['active']) echo '<a href="'.$l['url'].'">';
			echo icl_disp_language($l['native_name']);
			if(!$l['active']) echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
}

function jrltt_back_to() 
{
	if (is_single()) {
		if (is_singular('comission')) {
			$url =  (ICL_LANGUAGE_CODE == fr) ? '/fr/commandes' : '/encargos';
		} else if (is_singular('publication')) {
			$url =  (ICL_LANGUAGE_CODE == fr) ? '/fr/publications' : '/publicaciones';
		} else if (is_singular('edtromp')) {
			$url =  (ICL_LANGUAGE_CODE == fr) ? '/fr/editions-trompeloeil' : '/editions-trompeloeil';
		} else if (is_singular('project')) {
			$url =  (ICL_LANGUAGE_CODE == fr) ? '/fr/projects' : '/proyectos';
		} else {
			$url =  (ICL_LANGUAGE_CODE == fr) ? '/fr/nouvelles' : '/novedades';
		}
		return $url;
	}
}

function custom_singular_type() {
	return (is_singular('comission') || is_singular('publication') || is_singular('edtromp') || is_singular('project'));
}
