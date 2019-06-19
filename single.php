<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PBBiz
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// Custom post nav array
			the_post_navigation( array(
				'prev_text'                  => __( '<span class="title">
														<i class="fas fa-chevron-left"></i>이전 글 보기
													</span>
													<span class="post-title">
														%title
													</span>' ),
				'next_text'                  => __( '<span class="title">
														<i class="fas fa-chevron-right"></i>다음 글 보기
													</span>
													<span class="post-title">
														%title
													</span>' ),
				'in_same_term'               => true,
				'taxonomy'                   => __( 'post_tag' ),
				'screen_reader_text' => __( '계속 보기' ),
			) );
			// Custom post nav array end

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>

	</div><!-- #primary -->

<?php
get_footer();
