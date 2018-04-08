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
				$classParent = 'class="table__projects other gallery"';
				$styleChild = 'table__projects--child';
			}

			if ( has_shortcode( $post->post_content, 'gallery' ) ) {
 				$gallery = get_attached_media( $post );
				$content = '<div data-gallery-id="gallery-'. $post->ID .'" data-gallery-title="' . $post->post_title . '" '.$classParent.'>';

				foreach( $gallery as $key => $image_url ) {
					$whiteProjects = 0;
					$smallImage = wp_get_attachment_image_src($image_url->ID, 'project');
					$fullImage = wp_get_attachment_image_src($image_url->ID, 'full');
					$content .= '<div class="image ' . $styleChild . '">';

					if (get_field('white-space', $image_url->ID)) {
						$whiteProjects = get_field('white-space', $image_url->ID);
					}
					$content .= '<a  href="' . $fullImage[0] . '" data-white-space="givemespace-'.$whiteProjects.'">';
					$content .= '<img class="table__projects--image img-small"  src="' . $smallImage[0] . '" height="50">';
					$content .= '</a>';

					$content .= '</div>';
				}
				if (get_field('custom_content', $post->ID)) {
					$projectTitle = lcfirst(str_replace(' ', '', $post->post_title));
					$content .= '<div class="custom--content-box ' . $styleChild . '">';
		 			$content .= '<p class="custom--content__excerpt">' . wp_trim_words( get_field('custom_content', $post->ID), 25, null) . '<br/><a class="custom--content__link" href="#" data-featherlight="#'. $projectTitle .'">Leer más</a></p>';
					$content .= '<div id="'. $projectTitle .'" class="custom--content__text">'. get_field('custom_content', $post->ID) . '</div>';
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
