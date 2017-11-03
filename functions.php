<?php

function statorec_enqueue_styles() {

    $parent_style = 'typology-main'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/min.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'statorec_enqueue_styles' );



/**
 * Get links for co-authors plus plugin, based on typology to get button
 *
 */

if (!function_exists('statorec_coauthor_get_author_links')):
    function statorec_coauthor_get_author_links($author_id)
    {

        $output = '';

        if (is_singular()) {

            $output .= '<a class="typology-button-social hover-on" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID', $author_id))) . '">' . __typology('view_all') . '</a>';
        }

        return wp_kses_post($output);
    }
endif;

/* Allow shortcodes in widget areas */
add_filter('widget_text', 'do_shortcode');


?>
