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
						    // we have a guest author
							get_template_part('template-parts/single/guest-author');
						} else {
							get_template_part('template-parts/single/author');
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
