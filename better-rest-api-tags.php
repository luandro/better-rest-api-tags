<?php
/**
 * Better REST API Tags
 *
 * @package             better_rest_api_tags
 * @author              Luandro <luandro@gmail.com>
 * @license             GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:         Better REST API Tags
 * Plugin URI:          https://wordpress.org/plugins/better-rest-api-tags/
 * Description:         Adds a top-level field with featured image data including available sizes and URLs to the post object returned by the REST API.
 * Version:             1.0.0
 * Author:              Luandro
 * Author URI:          http://Luandro.com
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         better-rest-api-tags
 * Domain Path:         /languages
 */

add_action( 'plugins_loaded', 'better_rest_api_tags_load_translations' );

# Copy from:
# http://wordpress.stackexchange.com/questions/241814/wp-api-get-post-with-tag-names-instead-of-tag-ids
function ag_filter_post_json($response, $post, $context) {
    $tags = wp_get_post_tags($post->ID);
    $response->data['tag_names'] = [];

    foreach ($tags as $tag) {
        $response->data['tag_names'][] = $tag->name;
    }

    return $response;
}

add_filter( 'rest_prepare_post', 'ag_filter_post_json', 10, 3 );
