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
	<?php
		if ( has_post_gallery() ) {
			build_gallery('full', $post->post_content, false , false);
		}
	?>
	<div class="entry-content entry--content">
		<div class="entry--content__custom">
			<?= get_field('custom_content', $post->ID); ?>
		</div>
	</div>
	<div class="entry-meta">
		<?php $type = (is_single() && custom_singular_type()) ? 'Y': 'F, Y'; ?>
		<time class="entry-date"><?php jrltt_posted_on_simple($type); ?></time>
	</div>
</article>
