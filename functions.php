<?php

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
?>
