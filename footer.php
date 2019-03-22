<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PBBiz
 */

?>

	</div><!-- #content -->

	<div class="footer-wrapper">
		<div class="container">
			<footer id="footer-sidebar" class="row widget-area">
				<div id="footer-sidebar1" class="col-md-3">
					<?php
						if(is_active_sidebar('footer-sidebar-1')){
							dynamic_sidebar('footer-sidebar-1');
						}
					?>
				</div>
				<div id="footer-sidebar2" class="col-md-6">
					<?php
						if(is_active_sidebar('footer-sidebar-2')){
							dynamic_sidebar('footer-sidebar-2');
						}
					?>
				</div>
				<div id="footer-sidebar3" class="col-md-3">
					<?php
						if(is_active_sidebar('footer-sidebar-3')){
							dynamic_sidebar('footer-sidebar-3');
						}
					?>
				</div>
				<div id="footer-sidebar4">
					<?php
						if(is_active_sidebar('footer-sidebar-4')){
							dynamic_sidebar('footer-sidebar-4');
						}
					?>
				</div>
			</footer>
		</div><!-- .container -->
	</div><!-- .footer-wrapper -->

	<div class="colophon-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<footer id="colophon" class="site-footer" role="contentinfo">
						<div class="site-info">
							경기도 성남시 중원구 상대원동 사기막골로 31번길 18 (주) 파리크라상<br> All Rights Reserved © <?php echo date("Y");?> <span class="enfont">PARIS BAGUETTE, PARIS CROISSANT CO.,LTD.</span>
							<span class="sep"> | </span>
						    
							Developed by <a href="https://www.pariscroissant.co.kr">Paris Croissant Co., Ltd.</a>.
						</div><!-- .site-info -->
					</footer><!-- #colophon -->
				</div><!-- .col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .colophon-wrapper -->
</div><!-- #page -->

<div id="author-credits">
	<div>Icons made by <a href="http://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 		    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 		    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
