<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PBBiz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<!-- Custom Code -->

		<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="pm_filters">
			<label for="pm_number_of_results">글수 보기</label>
			<select name="pm_number_of_results" id="pm_number_of_results">
				<option><?php echo get_option( 'posts_per_page' ) ?></option><!-- it is from Settings > Reading -->
				<option>18</option>
				<option>27</option>
				<option value="-1">All</option>
			</select>
		
			<label for="pm_order_by">정렬</label>
			<select name="pm_order_by" id="pm_order_by">
				<option value="date-DESC">날짜순 ↓</option><!-- I will explode these values by "-" symbol later -->
				<option value="date-ASC">날짜순 ↑</option>
				<option value="comment_count-DESC">댓글수 ↓</option>
				<option value="comment_count-ASC">댓글수 ↑</option>
			</select>

			<?php
			if ($terms = get_terms(array(
				'taxonomy' => 'category',
				'orderby' => 'id',
				'hide_empty' => false,
			))) :

				echo '<select name="categoryfilter">';
				foreach ($terms as $term) :
					echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
				endforeach;
				echo '</select>';
			endif;
			?>
			
			<input type="hidden" name="action" value="pmfilter">

			<button>필터 적용하기</button>

		</form>
		<!-- <header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
		</header> -->
		<div id="response">
			<div id="pm_posts_wrap" class="row">
				<!-- Show All Posts On First Page load -->
				<?php if (have_posts()) : ?>
					<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
						get_template_part('template-parts/content', get_post_type());

					endwhile;

				else :

					get_template_part('template-parts/content', 'none');

				endif;
				?>
			</div> <!-- #pm_posts_wrap -->
		</div> <!-- #response -->

		<?php
		// Custom Pagination & Load More Button for AJAX Filters
		pm_paginator( get_pagenum_link() ); ?>

		<!-- Custom Code -->

	</main><!-- #main -->

	<?php get_sidebar(); ?>

</div><!-- #primary -->

<?php
get_footer();
