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

function build_gallery($size = 'default')
{
	// $gallery = get_post_gallery_images( $post );
	$gallery = get_attached_media( 'image' );
	?>
	<div class="carousel" data-flickity='{ "imagesLoaded": true,"prevNextButtons": false, "pageDots":false, "lazyLoad": true }'>
	<?php foreach( $gallery as $key => $value ) { ?>
			<div class="gallery-cell">
				<img class="box wp-post-image" data-flickity-lazyload="<?php echo $value->guid; ?>" alt="nope">
				<div class="gallery-cell--metadata">
					<?php if ($value->post_title) : ?>
					<h4 class="gallery-cell--metadata__title"><?php echo $value->post_title ?></h4>
					<?php endif; ?>
					<?php if ($value->post_excerpt) : ?>
					<p class="gallery-cell--metadata__excerpt"><?php echo $value->post_excerpt; ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php
	}
	// $image_list .= '</div>';
	// $content .= $image_list;
	?>
	</div>
	<?php
	// print_r($content);
}

function jrltt_posted_on_simple()
{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	echo '<span class="posted-on">' . $time_string . '</span>';
}

function echo_first_image( $postID ) {
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
		$html = '<ul id="primary-menu" class="menu">';
		foreach ($pages as $key => $value) {
			$html .= '<li class="menu-item"><a href="'. $value->guid . '" class="">'.$value->post_title; 
			if (is_page_template('projects.php')) {
				if ($value->ID == 10 && $value->post_title == 'Projets') {
					$html .= get_projects_by_title();
				}
			}
			$html .= '</a></li>';
		}
		$html .= '</ul>';
	echo $html;
}

function get_projects_by_title() {
	$args = array(
		'post_type'					=>	 	'project',
		'order'							=> 		'DESC',
		'orderby'						=>		'date',
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