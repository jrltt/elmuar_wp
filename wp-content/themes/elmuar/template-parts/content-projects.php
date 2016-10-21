<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title entry--content__title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			// the_content();
			/**
			 * http://mobiledetect.net/ switch between mobile, tablet or pc
			 * https://codex.wordpress.org/Function_Reference/get_post_gallery_images
			 */
			
			$detect = new Mobile_Detect;
			if ($detect->isMobile() && !$detect->isTablet()) {
				$classParent = 'class="carousel" data-flickity';
				$styleChild = 'carousel-cell';
			} else {
				$classParent = 'class="table__projects other"';
				$styleChild = 'table__projects--child zoomTarget';
			}
			?>
			<?php
			if ( has_shortcode( $post->post_content, 'gallery' ) ) {
 				$gallery = get_attached_media( $post );
 				// print_r($gallery);
				$image_list = '<div '.$classParent.'>';
				foreach( $gallery as $key => $image_url ) {

					// if ($key == 214) {
					// 	print_r($image_url);
					// }
					$image_list .= '<div class="'. $styleChild .'" data-targetsize="0.5">' . '<img class=" table__projects--image" src="' . $image_url->guid . '">' . '</div>';
					if (get_field('class', $image_url->ID)) {
						$image_list .= '<div class="table__projects--child zoomTarget '.get_field('class', $image_url->ID).'"></div>';
					}
				}
				$image_list .= '</div>';
				// Append our image list to the content of our post
				$content .= $image_list;
		 		echo $content;
		 	}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'elmuar' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
