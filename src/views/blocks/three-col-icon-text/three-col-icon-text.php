<?php
/**
 * Three Column Icon and Text Block Template
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
    $background = get_field('background_color') ?: '#172438';
    
    $cta = get_field('cta');
    $cta_type = get_field('cta_type');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $cta_background = get_field('cta_background');
    $cta_text_color = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment') ?: 'center'; 

    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#EBB323'; 
    $heading_alignment = get_field('heading_alignment') ?: 'center'; 
    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#FFFFFF';
    $subheading_alignment = get_field('subheading_alignment') ?: 'center'; 

    $tiles = get_field('column_content');

    $show_line_above = get_field('show_line_above');
    $show_line_below = get_field('show_line_below');

    $layout = get_field('layout');
    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__three-col-icon-text';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?> <?= $layout; ?>" <?= $anchor ?> style="background-color: <?= $background ?>;"> 
        <div class="container-block">
            <?php if ($show_line_above) : ?>
                <hr>
            <?php endif; ?>
            <?php if ($heading) : ?>
                <h4 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h4>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <div class="subtitle" style="color: <?= $subheading_color; ?>">
                    <?= $subheading; ?>
                </div>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php foreach($tiles as $si => $sv) : ?>
                    <div class="tile-item">
                        <div class="<?= $sv['icon_alignment']; ?>">
                            <img src="<?= $sv['icon']['url']; ?>" alt="<?= $sv['icon']['alt']; ?>">
                        </div>
                        <h4 class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                        <div class="desc" style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($cta_type === 'link') : 
                if($cta) : 
            ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($cta_text) : ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#colthree-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
            <?php if ($show_line_below) : ?>
                <hr>
            <?php endif; ?>
        </div>

        <div class="hidden">
            <div id="colthree-form" class="popup-form-container">
                <?= $cta_form ?>
            </div>
        </div>
    </div>

<?php endif; ?>