<?php get_header(); ?>

<?php if( have_posts() ): ?>

	<?php while( have_posts() ) : the_post(); ?>

		<?php $cover_class = !typology_get_option( 'single_cover' ) ? 'typology-cover-empty' : ''; ?>
		<div id="typology-cover" class="typology-cover <?php echo esc_attr($cover_class); ?>">
			<?php get_template_part('template-parts/cover/cover-single'); ?>
		</div>
		<div class="typology-fake-bg">
			<div class="typology-section">

				<?php get_template_part('template-parts/single/content'); ?>

				<?php
				if ( function_exists( 'get_coauthors' ) ) {

			        $coauthors = get_coauthors();

					foreach ( $coauthors as $coauthor ) {

						if ( isset( $coauthor->type ) && 'guest-author' === $coauthor->type ) {
						    // we have a guest author ?>

							<!-- <?php d($coauthor); ?> -->

							<?php $guest_author_thumbnail = $coauthors_plus->guest_authors->get_guest_author_thumbnail( $coauthor, $size ); ?>

							<?php typology_section_heading( array( 'title' => __typology('about_author') ) ); ?>

							<div class="section-content typology-author">

								<div class="container">

									<?php if (!is_null( $guest_author_thumbnail )) {
										echo '<div class="col-lg-2">'.coauthors_get_avatar( $coauthor, 100 ).'</div>';
									} ?>

									<div class="col-lg-10">

										<?php echo '<h5 class="typology-author-box-title">'.coauthors_posts_links_single( $coauthor ).'</h5>'; ?>

										<div class="typology-author-desc">
											<?php echo wpautop( $coauthor->description ); ?>
										</div>

										<!-- // need to get coauthor portion of path -->
										<div class="typology-author-links">
											<?php $nice = $coauthor->user_nicename; ?>
											<?php echo '<div><a class="typology-button-social hover-on" href="/author/'.$nice.'">View All</a></div>'; ?>
										</div>

									</div>

								</div>

							</div>

						<?php
						} else {
							// get_template_part('template-parts/single/author');
							continue;
							// d($coauthor);
						}
					}
				}
				?>

				<?php comments_template(); ?>

			</div>

		<?php get_template_part('template-parts/single/related'); ?>

	<?php endwhile; ?>

<?php endif; ?>

<?php get_template_part('template-parts/single/sticky'); ?>

<?php get_footer(); ?>
