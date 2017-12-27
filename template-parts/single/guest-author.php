<?php
	global $coauthors_plus;


  if( typology_get_option( 'single_author' ) ):

	if ( function_exists( 'get_coauthors' ) ) {

        $coauthors = get_coauthors();

			foreach ( $coauthors as $coauthor ) {

				if ( isset( $coauthor->type ) && 'guest-author' === $coauthor->type ) {
				    // we have a guest author ?>
					<?php typology_section_heading( array( 'title' => __typology('about_author') ) ); ?>

					<div class="section-content typology-author">
						<div class="container">

							<!-- // only display the gravatar if there is one -->
							<?php $guest_author_thumbnail = $coauthors_plus->guest_authors->get_guest_author_thumbnail( $coauthor, $size ); ?>

							<?php if (!is_null( $guest_author_thumbnail )) {
								echo '<div class="col-lg-2">'.coauthors_get_avatar( $coauthor, 96 ).'</div>';
							} ?>

							<div class="col-lg-10">

								<?php echo '<h5 class="typology-author-box-title">'.coauthors_posts_links_single( $coauthor ).'</h5>'; ?>

								<div class="typology-author-desc">
									<?php echo wpautop( $coauthor->description ); ?>
								</div>

								<!-- // the red button -->
								<div class="typology-author-links">

								<?php
 									$nice = $coauthor->user_nicename;
 								    $website = $coauthor->website;
 								    $display_name = $coauthor->display_name;
 									// can include author's name in button
									//$display_name = $coauthor->display_name;
									$coauthor_facebook = get_field( "guest_author_facebook", $coauthor->ID );
									$coauthor_twitter = get_field( "guest_author_twitter", $coauthor->ID );
									$coauthor_instagram = get_field( "guest_author_instagram", $coauthor->ID );
									?>

									<!-- <?php //echo '<div><a class="typology-button-social hover-on" href="/author/'.$nice.'">View All by '.$display_name.'</a></div>'; ?> -->
									<?php echo '<div><a class="typology-button-social hover-on" href="/author/'.$nice.'">View All by '.$display_name.'</a>'; ?>
									<div class="coauthor-social">
									<?php if( $coauthor_facebook ) { echo '<a href="'.$coauthor_facebook.'" target="_blank" class="typology-icon-social hover-on fa fa-facebook"></a>'; } ?>
									<?php if( $coauthor_twitter ) { echo '<a href="'.$coauthor_twitter.'" target="_blank" class="typology-icon-social hover-on fa fa-twitter"></a>'; } ?>
									<?php if( $coauthor_instagram ) { echo '<a href="'.$coauthor_instagram.'" target="_blank" class="typology-icon-social hover-on fa fa-instagram"></a>'; } ?>
									<?php if( $website ) {
										echo '<a href="'.$website.'" target="_blank" class="typology-icon-social coauthor-website hover-on">'.$website.'</a>';
									} ?>
									<!-- .typology-icon-social -->
									<?php echo '</div>'; ?>
									</div>

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
