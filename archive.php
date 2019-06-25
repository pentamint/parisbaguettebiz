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

		<!-- Custom Code -->

		<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
			<?php
				if( $terms = get_terms( array(
					'taxonomy' => 'category',
					'orderby' => 'name'
				) ) ) : 

					echo '<select name="categoryfilter"><option value="">필터를 선택하세요.</option>';
					foreach ( $terms as $term ) :
						echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
					endforeach;
					echo '</select>';
				endif;
			?>
			<input type="text" name="price_min" placeholder="Min price" />
			<input type="text" name="price_max" placeholder="Max price" />
			<label>
				<input type="radio" name="date" value="ASC" /> Date: Ascending
			</label>
			<label>
				<input type="radio" name="date" value="DESC" selected="selected" /> Date: Descending
			</label>
			<label>
				<input type="checkbox" name="featured_image" /> Only posts with featured images
			</label>
			<button>Apply filter</button>
			<input type="hidden" name="action" value="myfilter">
		</form>
		<div id="response"></div>

		<script>
			jQuery(function($){
				$('#filter').submit(function(){
					var filter = $('#filter');
					$.ajax({
						url:filter.attr('action'),
						data:filter.serialize(), // form data
						type:filter.attr('method'), // POST
						beforeSend:function(xhr){
							filter.find('button').text('Processing...'); // changing the button label
						},
						success:function(data){
							filter.find('button').text('Apply filter'); // changing the button label back
							$('#response').html(data); // insert data
						}
					});
					return false;
				});
			});
		</script>

		<!-- Custom Code -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->

			<?php get_sidebar(); ?>

		</div><!-- #primary -->

<?php
get_footer();
