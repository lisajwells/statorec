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

function statorec_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'statorec_add_editor_styles' );

/**
 * Get links for co-authors plus plugin, based on typology, to get button
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

/* Create shortcode for copyright year */
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');
// Use [year] in your posts.


/**
 * Get post excerpt, but don't strip tags
 *
 * Copy of typology_get_excerpt
 */

if (!function_exists('statorec_get_excerpt')):
    function statorec_get_excerpt($limit = 250)
    {

        $manual_excerpt = false;

        if (has_excerpt()) {
            $content = get_the_excerpt();
            $manual_excerpt = true;
        } else {
            $text = get_the_content('');
            $text = strip_shortcodes($text);
            $text = apply_filters('the_content', $text);
            $content = str_replace(']]>', ']]&gt;', $text);
        }

        if (!empty($content)) {
            if (!empty($limit) || !$manual_excerpt) {
                $more = typology_get_option('more_string');
                // $content = wp_strip_all_tags($content);
                $content = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content);
                $content = typology_trim_chars($content, $limit, $more);
            }
            return wp_kses_post(wpautop($content));
        }

        return '';

    }
endif;

// add superscript button to tinymce
// function my_mce_buttons_2($buttons) {
    /**
     * Add in a core button that's disabled by default
     */
//     $buttons[] = 'sup';
//     $buttons[] = 'sub';

//     return $buttons;
// }
// add_filter('mce_buttons_2', 'my_mce_buttons_2');

/**
 * Add Formats menu to tinymce for custom styles
 */
// http://www.wpbeginner.com/wp-tutorials/how-to-add-custom-styles-to-wordpress-visual-editor/
function statorec_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
        /**
     * Add in a core button that's disabled by default
     */
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';

    return $buttons;
}
add_filter('mce_buttons_2', 'statorec_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/
function my_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

    $style_formats = array(
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(
            'title' => 'Byline',
            'block' => 'p',
            'classes' => 'byline',
            // 'wrapper' => true,
        ),
        array(
            'title' => 'Footnote',
            'block' => 'p',
            'classes' => 'footnote',
        ),
        array(
            'title' => 'Heading 3 no-space-after',
            'block' => 'h3',
            'classes' => 'no-space-after',
        ),
        array(
            'title' => 'Heading 4 no-space-after',
            'block' => 'h4',
            'classes' => 'no-space-after',
        ),
        array(
            'title' => 'Heading 5 no-space-after',
            'block' => 'h5',
            'classes' => 'no-space-after',
        ),
        array(
            'title' => 'Heading 6 no-space-after',
            'block' => 'h6',
            'classes' => 'no-space-after',
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

?>
