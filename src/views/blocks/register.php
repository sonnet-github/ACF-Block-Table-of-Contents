<?php 
/**
 * ACF Blocks Registry
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    function register_layout_category( $categories ) {
        
        array_unshift($categories, [
            'slug'  => 'custom-layout',
            'title' => 'Custom Layout'
        ]);

        return $categories;
    }

    if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
        add_filter( 'block_categories_all', 'register_layout_category' );
    } else {
        add_filter( 'block_categories', 'register_layout_category' );
    }

    add_action( 'init', 'register_acf_blocks' );
    function register_acf_blocks() {

        // Add your ACF Blocks here
        $acf_blocks = [
            'hero',
            'three-tiles',
            'wysiwyg',
            'two-col-image-text',
            'text-with-two-ctas',
            'testimonials',
            'logo-slider',
            'lets-connect-banner',
            'latest-updates',
            'whitepaper-download',
            'marketing-events',
            'text-with-two-col',
            'lets-talk-form',
            'three-col-card',
            'pain-points',
            'four-col-icon-text',
            'two-col-icon-text',
            'select-services',
            'how-it-works',
            'three-col-icon-text',
            'our-services',
            'highlighted-slider',
            'two-column-wysiwyg',
            'sectors-we-serve',
            'full-width-rte-with-bg',
            'virtual-media-training',
            'two-col-image-text-container',
            'instagram-widget',
            'our-management-team',
            'icons-grid-with-text',
            'sectors-we-specialize-in',
            'three-key-factors',
            'contact-form',
            'floating-two-col-image-text',
            'listing-page',
            'newswire-single',
            'blogs-single',
            'media-directory',
        ];

        foreach($acf_blocks as $block){
            register_block_type( __DIR__ . '/' . $block );
        }
        
    }