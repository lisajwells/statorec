<?php if( typology_get_option( 'single_author' ) ): ?>

	<?php typology_section_heading( array( 'title' => __typology('about_author') ) ); ?>

		<?php
		if ( function_exists( 'get_coauthors' ) ) {

	        $coauthors = get_coauthors();
	        d($coauthors);



	    } // end if function get_coauthors
		?>
<?php endif; ?>
