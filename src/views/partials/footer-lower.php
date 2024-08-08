<?php
/**
 * Footer Lower Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

?>
<div class="pf-lower">
    <div class="tb-wr container-block">
        <div class="tb-c-wr va-middle logo-cell left-cell">
            <?php 
                $trgLogo = get_field('trg_logo', 'option'); 
                $trgLink = get_field('recognition_group_link', 'option');

                $eurocom_logo = get_field('eurocom_logo', 'option'); 
                $eurocom_link = get_field('eurocom_link', 'option');
            ?>
            <?php if ($trgLink) : ?>
                <a href="<?php echo $trgLink['url']; ?>" target="<?php echo $trgLink['target']; ?>">
            <?php endif; ?>
                <img src="<?php echo $trgLogo['url']; ?>" alt="<?php echo $trgLogo['alt']; ?>">
            <?php if ($trgLink) : ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="tb-c-wr va-bottom new-logo-cell">
            <?php if ($eurocom_link) : ?>
                <a href="<?php echo $eurocom_link['url']; ?>" target="<?php echo $eurocom_link['target']; ?>">
            <?php endif; ?>
            <?php if ($eurocom_logo) : ?>
                <img src="<?php echo $eurocom_logo['url']; ?>" alt="<?php echo $eurocom_logo['alt']; ?>">
            <?php endif; ?>
            <?php if ($eurocom_link) : ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="tb-c-wr va-middle text-cell">
            <?php the_field('footer_text','option'); ?>
        </div>
    </div>
</div>