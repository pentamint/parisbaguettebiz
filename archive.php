<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PBBiz
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<!-- Custom Code -->

		<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="pm_filters">
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
			<input type="text" name="price_min" placeholder="최소 금액" />
			<input type="text" name="price_max" placeholder="최대 금액" />
			<label>
				<input type="radio" name="date" value="ASC" /> 날짜순: 예전글부터
			</label>
			<label>
				<input type="radio" name="date" value="DESC" selected="selected" /> 날짜순: 최신글부터
			</label>
			<label>
				<input type="checkbox" name="featured_image" /> 특성이미지 있는 포스트만 보기
			</label>
			<button>Apply filter</button>
			<input type="hidden" name="action" value="myfilter">
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

					// the_posts_navigation();

					// Custom Pagination & Load More Button for AJAX Filters
					pm_paginator( get_pagenum_link() );

				else :

					get_template_part('template-parts/content', 'none');

				?>
			</div> <!-- #pm_posts_wrap -->
			<?php
				global $wp_query; // you can remove this line if everything works for you

				// don't display the button if there are not enough posts
				if (  $wp_query->max_num_pages > 1 )
					echo '<div id="pm_loadmore">More posts</div>'; // you can use <a> as well

				endif;
			?>
		</div> <!-- #response -->

		<script>
			jQuery(function($) {
				$('#pm_filters').submit(function() {
					var filter = $('#pm_filters');
					$.ajax({
						url: filter.attr('action'),
						data: filter.serialize(), // form data
						type: filter.attr('method'), // POST
						beforeSend: function(xhr) {
							filter.find('button').text('Processing...'); // changing the button label
						},
						success: function(data) {
							filter.find('button').text('Apply filter'); // changing the button label back
							$('#pm_posts_wrap').html(data); // insert data
						}
					});
					return false;
				});
			});
			// jQuery(function($) {
			// 	$document.ready(function() {
			// 		$('#response .query_items')addClass('container');
			// 		$('#response .query_items .wrapper')addClass('row');
			// 	}
			// };
		</script>

		<!-- Custom Code -->

	</main><!-- #main -->

	<?php get_sidebar(); ?>

</div><!-- #primary -->

<?php
get_footer();
