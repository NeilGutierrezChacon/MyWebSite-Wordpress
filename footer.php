<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package "theme"
 */

$classesAnimationFooter 	= " fadeIn animated dms-animated--level-2";
$frontpage_ID 	= get_option('page_on_front');

$legal_advice = get_field('dms_copyright', 'option');
$url = get_field('dms_url_aviso_legal', 'option');
$postID = $url->ID 

?>

				</main>

				<!-- FOOTER -->
				<footer>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 col-sm-12 block-message">
								<div class="h-100 d-flex align-items-center">
									<h4 class="text-center message">"Hello world"</h4>
								</div>
							</div>
							<div class="col-md-3 col-sm-12 footer-menu block-menu">
								<!-- Lista de documentacion sobre la pagina -->
								<h4>Site</h4>
								<!-- <ul>
								<li><a href="/cookies">Cookies</a></li>
								<li><a href="/privacy-policy">Privacy Policy</a></li>
								<li><a href="/contact">Contact</a></li>
								<li><a href="/docs/">Documentation</a></li>
								<li><a href="/legal-notice">Legal notice</a></li>
								</ul> -->
								<?php
									wp_nav_menu(array(
											'theme_location' => 'footer_menu',
											'container'      => '',
											'items_wrap'    => '<ul class="%2$s">%3$s</ul>',
											'walker'  => new WPDocs_Walker_Nav_Menu() // custom walker
										)
									);
								?>
							</div>
							<div class="col-md-5 col-sm-12 p-0 block-social">
								<div class="social">
									<a href="https://www.facebook.com/">
										<i class="fab fa-facebook fa-6x"></i>
									</a>
									<a href="https://github.com/NeilGutierrezChacon">
										<i class="fab fa-github fa-6x"></i>
									</a>
									<a href="https://www.linkedin.com/in/ngch43">
										<i class="fab fa-linkedin-in fa-6x"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</footer>

		<!-- BUTTON TO TOP -->
		<div class="dms-to-top dms-button-to-top js-dms-to-top">
			<span class="fa fa-angle-up"></span>
		</div>

		<!-- SCRIPTS -->
		<div class="dms-scripts">
			<?php wp_footer(); ?>
			<!-- Bootstrap JS -->
			<script
			src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
			integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
			crossorigin="anonymous"
			></script>
			<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
			integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
			crossorigin="anonymous"
			></script>
			<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
			integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
			crossorigin="anonymous"
			></script>
		</div>

	</body>
</html>