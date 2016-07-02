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
	<h1>publication oh yeah</h1>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$the_ID = get_the_ID();
			// $media = get_attached_media( 'image' );
			// print_r($media);
			$images = get_children( 
				array(
					'post_parent' => $the_ID, 
					'post_status' => 'inherit', 
					'post_type' => 'attachment', 
					'post_mime_type' => 'image', 
					'order' => 'ASC', 
					'orderby' => 'menu_order ID'
				)
			);
			 		
			if (isset($images)) {
				
				foreach( $images as $image ) {
					
					$imageID 	= $image->ID;
					$thumb 		= wp_get_attachment_image_src($imageID, $size = 'thumb', $icon = false); 
					$large 		= wp_get_attachment_image_src($imageID, $size = 'large', $icon = false); 
					$title 		= $image->post_title;
					echo '<a href="' . $large[0] . '" title="' . $title .'">';
					echo '	<img src="' . $thumb[0] . '" border="0" alt="' . $title .'">';
					echo '</a>';
				} 
			}

			the_content();

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
