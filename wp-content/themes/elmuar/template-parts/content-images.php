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
		<?php 
		if ( has_post_gallery() ) {
			build_gallery('full', $post->post_content);
		} else if ( has_post_thumbnail() ) {
			the_post_thumbnail('full', array('class' => 'img-responsive'));
		} else {
			echo_first_image($post->ID);
		} ?>
	</header>

	<div class="entry-content">
		<a class="entry--content__text-link" href="<?php echo get_the_permalink(); ?>">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</a>
		<?php
			// the_content();

			echo get_field('custom_content');

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elmuar' ),
				'after'  => '</div>',
			) );
		?>
	</div>

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
	</footer>
</article>