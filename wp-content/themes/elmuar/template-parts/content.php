<?php
/**
 * Template part for displaying posts.
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
				build_gallery('full');
			} else if ( has_post_thumbnail() ) {
				the_post_thumbnail('full',array('class' => 'img-responsive'));
			}

			// if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			/*} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}*/
			?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elmuar' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php jrltt_posted_on_simple(); ?>
		</div><!-- .entry-meta -->
		<?php
	endif; ?>
</article><!-- #post-## -->
