<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elisa_Murcia_Artengo
 */

$classTypeArticle = has_gallery();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array($classTypeArticle)); ?>>
	<header class="entry-header">
		<div class="entry--header__img-wrapper">
			<?php
				if ( has_post_gallery() ) {
					build_gallery('full', $post->post_content);
				} else if ( has_post_thumbnail() ) {
					the_post_thumbnail('full', array('class' => 'img-responsive'));
				} else {
					echo_first_image($post->ID);
				}
			?>
		</div>
	</header>

	<div class="entry-content">
		<?php if (!is_single()) : ?>
		<a class="entry--content__text-link" href="<?php echo get_the_permalink(); ?>">
			<?php the_title( '<h2 class="entry-title entry--content__title">', '</h2>' );?>
		</a>
		<?php else: ?>
			<?php the_title( '<h2 class="entry-title entry--content__title">', '</h2>' );?>
		<?php endif; ?>
		<?php
			
			echo get_field('custom_content', $post->ID);

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elmuar' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<div class="entry-meta">
		<?php jrltt_posted_on_simple(); ?>
	</div>
</article>