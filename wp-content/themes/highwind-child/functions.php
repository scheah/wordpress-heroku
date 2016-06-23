<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
require_once( get_stylesheet_directory() . '/framework/highwind-template.php' );
/**
 * Timeline Express Add Custom Metabox
 * @param array $options Array of options for Timeline Express.
 */
function define_custom_excerpt_metabox( $options ) {
    $announcement_custom_metabox = new_cmb2_box( array(
       'id' => 'custom_meta',
       'title' => __( 'Announcement Custom Excerpt', 'text-domain' ),
       'object_types' => array( 'te_announcements' ), // Post type
       'context' => 'advanced',
       'priority' => 'high',
       'show_names' => true, // Show field names on the left
    ) );
    // Container class
    $announcement_custom_metabox->add_field( array(
       'name' => __( 'Custom Excerpt', 'text-domain' ),
       'desc' => __( 'Enter the custom excerpt for this announcement in the field above.', 'text-domain' ),
       'id' => 'announcement_custom_excerpt',
       'type' => 'wysiwyg',
    ) );
}
add_action( 'timeline_express_metaboxes', 'define_custom_excerpt_metabox' );
/**
 * Replace the default excerpt with our new custom excerpt
 * @param string $excerpt The original announcement excerpt.
 * @param integer $post_id The announcement post ID
 * @return string Return the new excerpt to use.
 */
function replace_default_timeline_express_excerpt( $excerpt, $post_id ) {
    if ( timeline_express_get_custom_meta( $post_id, 'announcement_custom_excerpt', true ) ) {
       return apply_filters( 'the_content', get_post_meta( $post_id, 'announcement_custom_excerpt', true ) );
    } else {
       return $excerpt;
    }
}
add_filter( 'timeline_express_frontend_excerpt', 'replace_default_timeline_express_excerpt', 10, 2 );
?>