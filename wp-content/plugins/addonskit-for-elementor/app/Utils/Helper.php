<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Utils;

use Elementor\Plugin;

class Helper {
    public static function run_shortcode( $tag, $atts = [], $content = null ) {

        global $shortcode_tags;

        if ( ! isset( $shortcode_tags[$tag] ) ) {
            return false;
        }

        echo call_user_func( $shortcode_tags[$tag], $atts, $content, $tag );
    }

    public static function is_edit() {
        return ( Plugin::instance()->editor->is_edit_mode() ||
            Plugin::instance()->preview->is_preview_mode() ||
            is_preview() );
    }

    public static function is_elementor_using_single_listing( $post_id = '' ) {

        $get_template = get_directorist_option( 'single_listing_template' );
        $template = 'current_theme_template' === $get_template ? true : false;

        if ( $template && ! is_singular( ATBDP_POST_TYPE ) && is_plugin_inactive( 'elementor-pro/elementor-pro.php' ) ) {
            return;
        }

        $current_dir = directorist_get_listings_directory_type( $post_id );

        $elementor_library_posts = get_posts(
            [
                'post_type' => 'elementor_library',
                'meta_key' => '_elementor_conditions',
                'meta_value' => '',
                'meta_compare' => '!=',
            ]
        );

        foreach ( $elementor_library_posts as $elementor_library_post ) {
            $post_type = get_post_meta( $elementor_library_post->ID, '_elementor_conditions', true );
            $posts = implode( ',', $post_type );

            if ( strpos( $posts, 'singular/at_biz_dir' ) !== false ) {
                return true;
            } elseif ( preg_match( "/\/$current_dir$/", $posts ) ) {
                return true;
            } else {
                return;
            }
        }
    }

    public static function get_img( $filename ) {
        $path = "/img/{$filename}";

        return AKFE_ASSETS . $path;
    }

    public static function get_reading_time( $content, $tag ) {
        $stripped_content = strip_tags( $content );
        $total_word = str_word_count( $stripped_content );
        $reading_minute = floor( $total_word / 200 );
        $reading_seconds = floor( $total_word % 200 / ( 200 / 60 ) );

        if ( ! $reading_minute ) {
            $reading_time = $reading_seconds;
            $unit_name = __( 'secs', 'addonskit-for-elementor' );
        } else {
            $reading_time = $reading_minute;
            $unit_name = __( 'mins', 'addonskit-for-elementor' );
        }

        $reading_time_html = sprintf( '<%s>%s %s %s </%s>', $tag, $reading_time, $unit_name, __( 'read', 'addonskit-for-elementor' ), $tag );

        return $reading_time_html;
    }

    public static function get_svg( $attachment_id ) {
        $file = get_attached_file( $attachment_id );
        $svg = file_get_contents( $file );
        $svg = trim( $svg );

        return $svg;
    }

    public static function get_svg_icon( $filename ) {
        $dir = "/icons/{$filename}.svg";
        $file = AKFE_ASSETS . $dir;
        $svg = file_get_contents( $file );
        $svg = trim( $svg );

        return $svg;
    }
}