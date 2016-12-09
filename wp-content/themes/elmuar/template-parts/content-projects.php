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
				$targetSize = ($detect->isTablet()) ? '0.30' : '0.45';
			}

			if ( has_shortcode( $post->post_content, 'gallery' ) ) {
 				$gallery = get_attached_media( $post );
				$content = '<div '.$classParent.'>';

				foreach( $gallery as $key => $image_url ) {
					$image = wp_get_attachment_image_src($image_url->ID, 'project');
					$content .= '<div class="' . $styleChild . '" data-targetsize="' . $targetSize . '">';

					$content .= '<img class="lazy table__projects--image"  src="blank.gif" data-src="' . $image[0] . '" size="' . wp_get_attachment_image_sizes($image_url->ID) . '" srcset="'.wp_get_attachment_image_srcset($image_url->ID). '" height="50">';
					$content .= '</div>';
					if (get_field('white-space', $image_url->ID) && (!$detect->isMobile() && $detect->isTablet())) {
						$whiteProjects = get_field('white-space', $image_url->ID);
						for ($i=0; $i < $whiteProjects; $i++) { 
							$content .= '<div class="table__projects--child zoomTarget white--child" data-targetsize="' . $targetSize . '"></div>';
						}
					}
				}
				if (get_field('custom_content', $post->ID)) {
					$content .= '<div class="custom--content-box ' . $styleChild . '" data-targetsize="' . $targetSize . '">';
		 			$content .= '<p class="custom--content__excerpt">' . wp_trim_words( get_field('custom_content', $post->ID), 25, null) . '<br/><a class="custom--content__link" href="#" data-featherlight="#mylightbox">Leer más</a></p>';
					$content .= '<div id="mylightbox" class="custom--content__text">'. get_field('custom_content', $post->ID) . '</div>';
					$content .= '</div>';
				}

				$content .= '</div>';
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
