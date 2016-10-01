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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
    		echo '<h1>HOLA MOBILE</h1>';
    		$tmp = 'class="carousel" data-flickity';
			} else {
				echo '<h1>NOPEEEEE</h1>';
				$tmp = 'class="other"';
			}

			if( ! has_shortcode( $post->post_content, 'gallery' ) )
 				return $content;
 			$gallery = get_post_gallery_images( $post );
			$image_list = '<ul '.$tmp.'>';
			// Loop through each image in each gallery
			foreach( $gallery as $image_url ) {
				$image_list .= '<li class="carousel-cell">' . '<img src="' . $image_url . '">' . '</li>';
			}
			$image_list .= '</ul>';
			// Append our image list to the content of our post
			$content .= $image_list;
		 	echo $content;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elmuar' ),
				'after'  => '</div>',
			) );
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
