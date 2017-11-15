<?php
	global $coauthors_plus;
	// d($coauthors_plus);
?>

<?php if( typology_get_option( 'single_author' ) ): ?>

		<?php
		if ( function_exists( 'get_coauthors' ) ) {

	        $coauthors = get_coauthors();

						// d($coauthors);
					foreach ( $coauthors as $coauthor ) {
						// d($coauthor);

						if ( isset( $coauthor->type ) && 'guest-author' === $coauthor->type ) {
						    // we have a guest author ?>
							<?php typology_section_heading( array( 'title' => __typology('about_author') ) ); ?>

								<div class="section-content typology-author">
									<div class="container">


<!-- 										the_field: <?php the_field('facebook', $coauthor->ID) ?>
										<br>
										get_field: <?php echo get_field('facebook', $coauthor->ID) ?>
 -->
										<!-- // only display the gravatar if there is one -->
										<?php $guest_author_thumbnail = $coauthors_plus->guest_authors->get_guest_author_thumbnail( $coauthor, $size ); ?>

										<?php if (!is_null( $guest_author_thumbnail )) {
											echo '<div class="col-lg-2">'.coauthors_get_avatar( $coauthor, 100 ).'</div>';
										} ?>

									<div class="col-lg-10">

										<?php echo '<h5 class="typology-author-box-title">'.coauthors_posts_links_single( $coauthor ).'</h5>'; ?>

										<div class="typology-author-desc">
											<?php echo wpautop( $coauthor->description ); ?>
										</div>

										<!-- // the red button -->
										<div class="typology-author-links">
											<?php $nice = $coauthor->user_nicename; ?>
											<?php echo '<div><a class="typology-button-social hover-on" href="/author/'.$nice.'">View All</a></div>'; ?>
										</div>

									</div> <!-- end col-lg-10 -->
								</div> <!-- end container -->
							</div> <!-- end section-content typology-author -->

						<?php
						} else {
							// get_template_part('template-parts/single/author');
							// continue because we don't ever want to see the wp user as author
							continue;
						}
					} // end foreach


	    } // end if function get_coauthors
		?>
<?php endif; ?>
