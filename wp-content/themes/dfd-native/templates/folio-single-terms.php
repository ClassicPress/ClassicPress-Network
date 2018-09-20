<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="folio-dopinfo">

    <time>
        <i class="linecon-clock"></i>
        <?php echo get_the_date(); ?>

    </time>



    <?php $id = get_the_ID();

    $product_terms = wp_get_object_terms($id, 'portfolio_category');
    $count = count($product_terms);
    $i = 0;
    if (!empty($product_terms)) {
        if (!is_wp_error($product_terms)) {
            foreach ($product_terms as $term) {
                $i++;
                echo ' <a href="' . get_term_link($term->slug, 'portfolio_category') . '">' . $term->name . '</a>';
                if ($count != $i) echo ',&nbsp;'; else echo '';
            }
        }
    }
    ?>
</div>