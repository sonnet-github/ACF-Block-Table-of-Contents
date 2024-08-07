<?php
/**
 * Footer Lower Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
    $footer_logo = get_field('footer_logo_image', 'options');

?>
<div class="pf-lower container-block">
    <div class="tb-wr">
        <div class="tb-c-wr content-cell">
            <div class="tb-wr">
                <?php if($footer_logo) : ?>
                    <div class="tb-c-wr footer-logo-wrap">
                        <img src="<?= $footer_logo['url'] ?>" alt="<?= $footer_logo['alt'] ?>" />
                    </div>
                <?php endif; ?>
                <div class="tb-c-wr footer-copy-wrap">
                    <?= get_field('footer_main_copy', 'options')  ?>
                </div>
            </div>
        </div>
        <div class="tb-c-wr copyright-cell">
            <div class="tb-wr">
                <div class="tb-c-wr">
                    <?= get_field('copyright_line', 'options') ?>
                </div>
                <div class="tb-c-wr branding-cell">
                    <?= get_field('branding_line', 'options') ?>
                </div>
            </div>
        </div>
    </div>
</div>