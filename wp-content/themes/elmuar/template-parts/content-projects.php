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
			$classParent = 'class="table__projects other gallery"';
			$styleChild = 'table__projects--child';
			if ( has_shortcode( $post->post_content, 'gallery' ) ) {
				$gallery = get_attached_media( $post );
				$content = '<div data-gallery-id="gallery-'. $post->ID .'" data-gallery-title="' . $post->post_title . '" '.$classParent.'>';

				foreach( $gallery as $key => $image_url ) {
					$whiteProjects = 0;
					$smallImage = wp_get_attachment_image_src($image_url->ID, 'project');
					$fullImage = wp_get_attachment_image_src($image_url->ID, 'full');
					$content .= '<div class="image table__projects--child">';

					if (get_field('white-space', $image_url->ID)) {
						$whiteProjects = get_field('white-space', $image_url->ID);
					}
					$content .= '<a  data-href="' . $fullImage[0] . '" data-href2="' . $smallImage[0] . '" data-white-space="givemespace-'.$whiteProjects.'">';
					$content .= '<img class="table__projects--image img-small" data-flickity-lazyload-srcset="' . $fullImage[0] .' 767w" sizes="(min-width: 767px) 280px" data-flickity-lazyload-src="'.$fullImage[0].'" >';
					$content .= '</a>';

					$content .= '</div>';
				}
				if (get_field('custom_content', $post->ID)) {
					$projectTitle = lcfirst(str_replace(' ', '', str_replace('\'', '',$post->post_title)));
					$content .= '<div class="custom--content-box table__projects--child">';
					$content .= '<a class="custom--content__link-main">';
					$content .= get_field('excerpt_custom_content', $post->ID) . '<a class="custom--content__link" href="#" data-featherlight="#'. $projectTitle .'">'. __( 'Leer más', 'elmuar' ) . '</a>';
					$content .= '</a>';
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
