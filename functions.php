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

// this is a copy of typology_get_author_links that makes author archive button
if (!function_exists('statorec_get_coauthor_links')):
    function statorec_get_coauthor_links($author_id)
    {

        $output = '';

        if (is_singular()) {

            // get author post url should be get coauthor posts
            $output .= '<a class="typology-button-social hover-on" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID', $author_id))) . '">' . __typology('view_all') . '</a>';
        }


        if ($url = get_the_author_meta('url', $author_id)) {
            $output .= '<a href="' . esc_url($url) . '" target="_blank" class="typology-icon-social hover-on fa fa-link"></a>';
        }

        $social = typology_get_social();

        if (!empty($social)) {
            foreach ($social as $id => $name) {
                if ($social_url = get_the_author_meta($id, $author_id)) {

                    if ($id == 'twitter') {
                        $social_url = (strpos($social_url, 'http') === false) ? 'https://twitter.com/' . $social_url : $social_url;
                    }

                    $output .= '<a href="' . esc_url($social_url) . '" target="_blank" class="typology-icon-social hover-on fa fa-' . esc_attr($id) . '"></a>';
                }
            }
        }

        return wp_kses_post($output);
    }
endif;





?>
