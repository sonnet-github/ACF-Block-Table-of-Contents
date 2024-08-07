<?php
/**
 * Hero Block Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $heading = get_field('heading') ?: get_the_title();
    $heading_color = get_field('heading_color') ?: '#FFFFFF';
    $heading_alignment = get_field('heading_alignment');
    $heading_spacing = get_field('heading_spacing');

    $subtitle = get_field('subtitle') ?: '';
    $subtitle_color = get_field('subtitle_color') ?: '#FFFFFF';
    $subtitle_alignment = get_field('subtitle_alignment');
    
    $content_width = get_field('content_width');

    $ctaType = get_field('cta_type') ?: 'link';
    $cta = get_field('cta') ?: false;
    $cta_text = get_field('cta_text');
    $ctaBG = get_field('cta_background_color') ?: '#EBB323';
    $ctaTextColor = get_field('cta_text_color') ?: '#FFFFFF';
    $cta_alignment = get_field('cta_alignment');
    $form = get_field('form_shortcode');

    $background_image = get_field('background_image') ?: '';
    $mobileBG = get_field('mobile_background_image') ?: '';

    $hero_type = get_field('hero_type');

    $show_line = get_field('show_line');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__hero';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }
    if (!$subtitle) {
        $class_name .= ' layout-two';
    }
    if (!is_home()) {
        $class_name .= ' sub-pages';
    }

    if (is_page('contact')) {
        $class_name .= ' contact-us';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?> <?= $hero_type; ?>" <?= $anchor ?> style="background-image: url('<?= $background_image ?>');">
        <?php if ($mobileBG) : ?>
            <img src="<?= $mobileBG['url']; ?>" alt="<?= $mobileBG['alt']; ?>" class="mobile-bg mobile-only">
        <?php endif; ?>
        <?php if (is_singular('newswire')) : ?>
            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/newswireHeader.jpg') ?>" class="mobile-bg mobile-only">
        <?php endif; ?>
        <?php if (is_singular('blogs')) : ?>
            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/blogsHeader.jpg') ?>" class="mobile-bg mobile-only">
        <?php endif; ?>
        <div class="hero-content container-block <?= $content_width; ?>">
            <?php if ($hero_type === 'hero-pt') : ?>
                <div class="date left">
                    <p><?php echo get_the_date('j F Y', get_the_ID()); ?></p>     
                </div>
            <?php endif; ?>
            
            <h1 class="<?= $heading_alignment; ?> <?= $heading_spacing; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h1>
            <?php if ($show_line) : ?>
                <hr>
            <?php endif; ?>
            <?php if($subtitle) : ?>
                <p class="hp-content <?= $subtitle_alignment; ?>" style="color: <?= $subtitle_color; ?>">
                    <?= $subtitle ?>
                </p>
            <?php endif; ?>

            <?php if ($hero_type === 'hero-pt') : ?>
                <div class="categories">
                    <?php  
                        if (is_singular('blogs')) {
                            $terms = get_the_terms( get_the_ID() , 'blog-category' );
                        } else {
                            $terms = get_the_terms( get_the_ID() , 'category' );
                        }
                        $count = count($terms);
                        foreach( $terms as $term ) { 
                            if ($term->term_id != 1) { ?>
                            <?php echo $term->name; ?><?php if ($count > 1) echo ' <span>•</span> '; $count--; ?>
                    <?php } } ?>
                </div>
            <?php endif; ?>


            <?php if ($ctaType === 'link') : 
                if($cta) : 
            ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                        <?= $cta['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($cta_text) : ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#hero-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>

        <div class="hidden">
            <div id="hero-form" class="popup-form-container">
                <?= $form; ?>
            </div>
        </div>
    </div>

<?php endif; ?>